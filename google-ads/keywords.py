"""Słowa kluczowe i wykluczające.

Notacja dopasowania (jak w Google Ads Editor):
    [usługi it piaseczno]    dopasowanie ścisłe
    "obsługa informatyczna"  dopasowanie do wyrażenia
    outsourcing it           bez znaczników = wartość --match (domyślnie PHRASE)

Przykłady:
    .venv/bin/python keywords.py add --ad-group 155667788 "[serwis komputerowy piaseczno]" "obsługa it firm" -c 123-456-7890
    .venv/bin/python keywords.py add --ad-group 155667788 --file slowa.txt --cpc 3 -c 123-456-7890
    .venv/bin/python keywords.py negative --campaign 2233445566 darmowe praca kurs --match BROAD -c 123-456-7890
    .venv/bin/python keywords.py negatives --campaign 2233445566 -c 123-456-7890
    .venv/bin/python keywords.py pause 155667788 9988776655 -c 123-456-7890 --apply
"""

import argparse
import sys

from gads_common import (
    add_common_args, load_client, mutate, new_operation, parse_keyword, print_table, read_terms,
    require_customer, run, search, set_update_mask, to_micros,
)

MATCH_TYPES = ["EXACT", "PHRASE", "BROAD"]


def parsed_terms(args):
    terms = [parse_keyword(t, args.match) for t in read_terms(args.terms, args.file)]
    for text, match in terms:
        if match not in MATCH_TYPES:
            sys.exit(f"Nieznane dopasowanie {match!r} dla „{text}”.")
        if len(text) > 80 or len(text.split()) > 10:
            sys.exit(f"Za długie słowo kluczowe (maks. 80 znaków i 10 słów): „{text}”.")
    return terms


def show(terms, prefix):
    for text, match in terms:
        label = {"EXACT": f"[{text}]", "PHRASE": f'"{text}"'}.get(match, text)
        print(f"  {prefix} {label}")


def cmd_add(client, cid, args):
    terms = parsed_terms(args)
    ad_group = client.get_service("AdGroupService").ad_group_path(cid, args.ad_group)
    print(f"Dodaję {len(terms)} słów do grupy {args.ad_group}:")
    show(terms, "+")
    ops = []
    for text, match in terms:
        op = new_operation(client)
        crit = op.ad_group_criterion_operation.create
        crit.ad_group = ad_group
        crit.status = client.enums.AdGroupCriterionStatusEnum.ENABLED
        crit.keyword.text = text
        crit.keyword.match_type = client.enums.KeywordMatchTypeEnum[match]
        if args.cpc:
            crit.cpc_bid_micros = args.cpc
        if args.final_url:
            crit.final_urls.append(args.final_url)
        ops.append(op)
    mutate(client, cid, ops, args.apply)


def cmd_negative(client, cid, args):
    terms = parsed_terms(args)
    if bool(args.campaign) == bool(args.ad_group):
        sys.exit("Podaj dokładnie jedno: --campaign ID albo --ad-group ID.")
    level = f"kampanii {args.campaign}" if args.campaign else f"grupy {args.ad_group}"
    print(f"Dodaję {len(terms)} wykluczeń na poziomie {level}:")
    show(terms, "−")
    ops = []
    for text, match in terms:
        op = new_operation(client)
        if args.campaign:
            crit = op.campaign_criterion_operation.create
            crit.campaign = client.get_service("CampaignService").campaign_path(cid, args.campaign)
        else:
            crit = op.ad_group_criterion_operation.create
            crit.ad_group = client.get_service("AdGroupService").ad_group_path(cid, args.ad_group)
        crit.negative = True
        crit.keyword.text = text
        crit.keyword.match_type = client.enums.KeywordMatchTypeEnum[match]
        ops.append(op)
    mutate(client, cid, ops, args.apply)


def cmd_negatives(client, cid, args):
    rows = []
    if args.campaign:
        query = f"""
            SELECT campaign_criterion.criterion_id, campaign_criterion.keyword.text,
                   campaign_criterion.keyword.match_type
            FROM campaign_criterion
            WHERE campaign.id = {args.campaign} AND campaign_criterion.negative = TRUE
              AND campaign_criterion.type = 'KEYWORD'"""
        rows += [["kampania", r.campaign_criterion.criterion_id, r.campaign_criterion.keyword.text,
                  r.campaign_criterion.keyword.match_type.name] for r in search(client, cid, query)]
    query = """
        SELECT ad_group.id, ad_group_criterion.criterion_id, ad_group_criterion.keyword.text,
               ad_group_criterion.keyword.match_type
        FROM ad_group_criterion
        WHERE ad_group_criterion.negative = TRUE AND ad_group_criterion.type = 'KEYWORD'"""
    if args.campaign:
        query += f" AND campaign.id = {args.campaign}"
    if args.ad_group:
        query += f" AND ad_group.id = {args.ad_group}"
    rows += [[f"grupa {r.ad_group.id}", r.ad_group_criterion.criterion_id, r.ad_group_criterion.keyword.text,
              r.ad_group_criterion.keyword.match_type.name] for r in search(client, cid, query)]
    print_table(["Poziom", "ID", "Wykluczenie", "Dopasowanie"], rows)


def criterion_path(client, cid, ad_group_id, criterion_id):
    return client.get_service("AdGroupCriterionService").ad_group_criterion_path(cid, ad_group_id, criterion_id)


def cmd_status(client, cid, args):
    new = "PAUSED" if args.command == "pause" else "ENABLED"
    ops = []
    for criterion_id in args.criterion_ids:
        op = new_operation(client)
        crit = op.ad_group_criterion_operation.update
        crit.resource_name = criterion_path(client, cid, args.ad_group_id, criterion_id)
        crit.status = client.enums.AdGroupCriterionStatusEnum[new]
        set_update_mask(client, op.ad_group_criterion_operation, crit)
        ops.append(op)
    print(f"Słowa {', '.join(map(str, args.criterion_ids))} w grupie {args.ad_group_id} → {new}")
    mutate(client, cid, ops, args.apply)


def cmd_bid(client, cid, args):
    op = new_operation(client)
    crit = op.ad_group_criterion_operation.update
    crit.resource_name = criterion_path(client, cid, args.ad_group_id, args.criterion_id)
    crit.cpc_bid_micros = args.amount
    set_update_mask(client, op.ad_group_criterion_operation, crit)
    print(f"Stawka słowa {args.criterion_id} → {args.amount / 1_000_000:.2f}")
    mutate(client, cid, [op], args.apply)


def cmd_remove(client, cid, args):
    ops = []
    for criterion_id in args.criterion_ids:
        op = new_operation(client)
        if args.campaign_level:
            op.campaign_criterion_operation.remove = client.get_service(
                "CampaignCriterionService").campaign_criterion_path(cid, args.parent_id, criterion_id)
        else:
            op.ad_group_criterion_operation.remove = criterion_path(client, cid, args.parent_id, criterion_id)
        ops.append(op)
    where = "kampanii" if args.campaign_level else "grupy"
    print(f"USUWAM (nieodwracalne) {len(ops)} słów/wykluczeń z {where} {args.parent_id}: "
          f"{', '.join(map(str, args.criterion_ids))}")
    mutate(client, cid, ops, args.apply)


def main():
    parser = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    sub = parser.add_subparsers(dest="command", required=True)

    def term_args(p):
        p.add_argument("terms", nargs="*", help="słowa kluczowe (notacja [ ] / \" \")")
        p.add_argument("--file", help="plik z jednym słowem w linii")
        p.add_argument("--match", choices=MATCH_TYPES, default="PHRASE",
                       help="dopasowanie słów bez znaczników (domyślnie PHRASE)")

    p = sub.add_parser("add", help="dodaj słowa kluczowe do grupy reklam")
    p.add_argument("--ad-group", type=int, required=True)
    term_args(p)
    p.add_argument("--cpc", type=to_micros, help="indywidualna stawka max CPC")
    p.add_argument("--final-url", help="osobny URL docelowy dla tych słów")
    add_common_args(p, mutate=True)
    p.set_defaults(func=cmd_add)

    p = sub.add_parser("negative", help="dodaj wykluczające słowa kluczowe")
    p.add_argument("--campaign", type=int)
    p.add_argument("--ad-group", type=int)
    term_args(p)
    add_common_args(p, mutate=True)
    p.set_defaults(func=cmd_negative)

    p = sub.add_parser("negatives", help="pokaż wykluczenia kampanii / grup")
    p.add_argument("--campaign", type=int)
    p.add_argument("--ad-group", type=int)
    add_common_args(p)
    p.set_defaults(func=cmd_negatives)

    for name, help_text in [("pause", "wstrzymaj słowa"), ("enable", "włącz słowa")]:
        p = sub.add_parser(name, help=help_text + " (ID grupy i słów z: report.py keywords)")
        p.add_argument("ad_group_id", type=int)
        p.add_argument("criterion_ids", type=int, nargs="+")
        add_common_args(p, mutate=True)
        p.set_defaults(func=cmd_status)

    p = sub.add_parser("bid", help="ustaw stawkę max CPC pojedynczego słowa")
    p.add_argument("ad_group_id", type=int)
    p.add_argument("criterion_id", type=int)
    p.add_argument("amount", type=to_micros)
    add_common_args(p, mutate=True)
    p.set_defaults(func=cmd_bid)

    p = sub.add_parser("remove", help="usuń słowa lub wykluczenia (nieodwracalne)")
    p.add_argument("parent_id", type=int, help="ID grupy reklam (albo kampanii z --campaign-level)")
    p.add_argument("criterion_ids", type=int, nargs="+")
    p.add_argument("--campaign-level", action="store_true", help="usuń wykluczenia z poziomu kampanii")
    add_common_args(p, mutate=True)
    p.set_defaults(func=cmd_remove)

    args = parser.parse_args()
    client = load_client(args.config)
    args.func(client, require_customer(args), args)


if __name__ == "__main__":
    run(main)
