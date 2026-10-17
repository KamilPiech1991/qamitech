"""Zarządzanie kampaniami: lista, pauza/wznowienie, nazwa, budżet, stawki, lokalizacje.

Każda zmiana bez --apply jest tylko sprawdzana przez API (nic się nie zmienia).

Przykłady:
    .venv/bin/python campaign.py list -c 123-456-7890
    .venv/bin/python campaign.py pause 2233445566 -c 123-456-7890 --apply
    .venv/bin/python campaign.py budget 2233445566 80 -c 123-456-7890
    .venv/bin/python campaign.py bid-target 2233445566 --cpa 45 -c 123-456-7890
    .venv/bin/python campaign.py locations 2233445566 --add 1011615 --remove 2616 -c 123-456-7890
"""

import argparse
import sys

from gads_common import (
    add_common_args, load_client, money, mutate, new_operation, print_table, require_customer, run,
    search, set_update_mask, to_micros,
)


def get_campaign(client, cid, campaign_id):
    query = f"""
        SELECT campaign.resource_name, campaign.id, campaign.name, campaign.status,
               campaign.bidding_strategy_type, campaign.bidding_strategy,
               campaign.maximize_conversions.target_cpa_micros, campaign.target_cpa.target_cpa_micros,
               campaign.maximize_conversion_value.target_roas, campaign.target_roas.target_roas,
               campaign.target_spend.cpc_bid_ceiling_micros,
               campaign_budget.resource_name, campaign_budget.amount_micros,
               campaign_budget.explicitly_shared, campaign_budget.reference_count
        FROM campaign WHERE campaign.id = {int(campaign_id)}"""
    rows = list(search(client, cid, query))
    if not rows:
        sys.exit(f"Nie znaleziono kampanii {campaign_id} na koncie {cid}.")
    return rows[0]


def cmd_list(client, cid, args):
    status = "" if args.all else "WHERE campaign.status != 'REMOVED'"
    query = f"""
        SELECT campaign.id, campaign.name, campaign.status, campaign.primary_status,
               campaign.advertising_channel_type, campaign.bidding_strategy_type,
               campaign_budget.amount_micros, campaign_budget.explicitly_shared
        FROM campaign {status} ORDER BY campaign.status, campaign.name"""
    rows = [
        [r.campaign.id, r.campaign.name, r.campaign.status.name, r.campaign.primary_status.name,
         r.campaign.advertising_channel_type.name, r.campaign.bidding_strategy_type.name,
         money(r.campaign_budget.amount_micros) + (" (wspólny)" if r.campaign_budget.explicitly_shared else "")]
        for r in search(client, cid, query)
    ]
    print_table(["ID", "Kampania", "Status", "Stan emisji", "Typ", "Stawki", "Budżet/dz."], rows)


def cmd_status(client, cid, args):
    row = get_campaign(client, cid, args.campaign_id)
    new = "PAUSED" if args.command == "pause" else "ENABLED"
    print(f"Kampania „{row.campaign.name}”: {row.campaign.status.name} → {new}")
    op = new_operation(client)
    campaign = op.campaign_operation.update
    campaign.resource_name = row.campaign.resource_name
    campaign.status = client.enums.CampaignStatusEnum[new]
    set_update_mask(client, op.campaign_operation, campaign)
    mutate(client, cid, [op], args.apply)


def cmd_rename(client, cid, args):
    row = get_campaign(client, cid, args.campaign_id)
    print(f"Nazwa: „{row.campaign.name}” → „{args.name}”")
    op = new_operation(client)
    campaign = op.campaign_operation.update
    campaign.resource_name = row.campaign.resource_name
    campaign.name = args.name
    set_update_mask(client, op.campaign_operation, campaign)
    mutate(client, cid, [op], args.apply)


def cmd_budget(client, cid, args):
    row = get_campaign(client, cid, args.campaign_id)
    budget = row.campaign_budget
    if budget.explicitly_shared:
        print(f"UWAGA: to budżet wspólny dla {budget.reference_count} kampanii — zmiana obejmie wszystkie.")
    print(f"Budżet dzienny „{row.campaign.name}”: {money(budget.amount_micros)} → {money(args.amount)}")
    op = new_operation(client)
    new_budget = op.campaign_budget_operation.update
    new_budget.resource_name = budget.resource_name
    new_budget.amount_micros = args.amount
    set_update_mask(client, op.campaign_budget_operation, new_budget)
    mutate(client, cid, [op], args.apply)


def cmd_bid_target(client, cid, args):
    row = get_campaign(client, cid, args.campaign_id)
    c = row.campaign
    strategy = c.bidding_strategy_type.name
    if c.bidding_strategy:
        sys.exit(f"Kampania używa portfelowej strategii stawek ({c.bidding_strategy}) — zmień ją w panelu Google Ads.")

    op = new_operation(client)
    campaign = op.campaign_operation.update
    campaign.resource_name = c.resource_name
    if args.cpa is not None and strategy == "MAXIMIZE_CONVERSIONS":
        old, campaign.maximize_conversions.target_cpa_micros = c.maximize_conversions.target_cpa_micros, args.cpa
        print(f"Docelowy CPA (Maks. liczba konwersji): {money(old)} → {money(args.cpa)}")
    elif args.cpa is not None and strategy == "TARGET_CPA":
        old, campaign.target_cpa.target_cpa_micros = c.target_cpa.target_cpa_micros, args.cpa
        print(f"Docelowy CPA: {money(old)} → {money(args.cpa)}")
    elif args.roas is not None and strategy == "MAXIMIZE_CONVERSION_VALUE":
        old, campaign.maximize_conversion_value.target_roas = c.maximize_conversion_value.target_roas, args.roas
        print(f"Docelowy ROAS (Maks. wartość konwersji): {old:.0%} → {args.roas:.0%}")
    elif args.roas is not None and strategy == "TARGET_ROAS":
        old, campaign.target_roas.target_roas = c.target_roas.target_roas, args.roas
        print(f"Docelowy ROAS: {old:.0%} → {args.roas:.0%}")
    elif args.cpc_ceiling is not None and strategy == "TARGET_SPEND":
        old, campaign.target_spend.cpc_bid_ceiling_micros = c.target_spend.cpc_bid_ceiling_micros, args.cpc_ceiling
        print(f"Limit stawki CPC (Maks. liczba kliknięć): {money(old)} → {money(args.cpc_ceiling)}")
    else:
        sys.exit(
            f"Kampania ma strategię {strategy}. Obsługiwane: --cpa dla MAXIMIZE_CONVERSIONS/TARGET_CPA, "
            "--roas dla MAXIMIZE_CONVERSION_VALUE/TARGET_ROAS, --cpc-ceiling dla TARGET_SPEND (Maks. kliknięć)."
        )
    set_update_mask(client, op.campaign_operation, campaign)
    mutate(client, cid, [op], args.apply)


def cmd_locations(client, cid, args):
    row = get_campaign(client, cid, args.campaign_id)
    query = f"""
        SELECT campaign_criterion.resource_name, campaign_criterion.location.geo_target_constant,
               campaign_criterion.negative
        FROM campaign_criterion
        WHERE campaign.id = {int(args.campaign_id)} AND campaign_criterion.type = 'LOCATION'"""
    current = {
        r.campaign_criterion.location.geo_target_constant.split("/")[-1]: r.campaign_criterion
        for r in search(client, cid, query)
    }
    print(f"Lokalizacje kampanii „{row.campaign.name}”: "
          + (", ".join(f"{k}{' (wykluczona)' if v.negative else ''}" for k, v in current.items()) or "brak (cały świat)"))
    if not args.add and not args.remove and not args.exclude:
        return

    ops = []
    for geo_id, negative in [(g, False) for g in args.add] + [(g, True) for g in args.exclude]:
        if geo_id in current:
            print(f"  {geo_id} już jest ustawiona — pomijam")
            continue
        op = new_operation(client)
        crit = op.campaign_criterion_operation.create
        crit.campaign = row.campaign.resource_name
        crit.location.geo_target_constant = f"geoTargetConstants/{geo_id}"
        crit.negative = negative
        ops.append(op)
        print(f"  + {'wyklucz' if negative else 'dodaj'} {geo_id}")
    for geo_id in args.remove:
        if geo_id not in current:
            print(f"  {geo_id} nie jest ustawiona — pomijam")
            continue
        op = new_operation(client)
        op.campaign_criterion_operation.remove = current[geo_id].resource_name
        ops.append(op)
        print(f"  - usuń {geo_id}")
    if ops:
        mutate(client, cid, ops, args.apply)


def main():
    parser = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    sub = parser.add_subparsers(dest="command", required=True)

    p = sub.add_parser("list", help="lista kampanii z ID, statusem i budżetem")
    add_common_args(p)
    p.add_argument("--all", action="store_true", help="pokaż też usunięte")
    p.set_defaults(func=cmd_list)

    for name, help_text in [("pause", "wstrzymaj kampanię"), ("enable", "włącz kampanię")]:
        p = sub.add_parser(name, help=help_text)
        p.add_argument("campaign_id", type=int)
        add_common_args(p, mutate=True)
        p.set_defaults(func=cmd_status)

    p = sub.add_parser("rename", help="zmień nazwę kampanii")
    p.add_argument("campaign_id", type=int)
    p.add_argument("name")
    add_common_args(p, mutate=True)
    p.set_defaults(func=cmd_rename)

    p = sub.add_parser("budget", help="ustaw budżet dzienny (w walucie konta)")
    p.add_argument("campaign_id", type=int)
    p.add_argument("amount", type=to_micros, help="np. 50 albo 49,90")
    add_common_args(p, mutate=True)
    p.set_defaults(func=cmd_budget)

    p = sub.add_parser("bid-target", help="zmień docelowy CPA / ROAS / limit CPC w obecnej strategii")
    p.add_argument("campaign_id", type=int)
    group = p.add_mutually_exclusive_group(required=True)
    group.add_argument("--cpa", type=to_micros, help="docelowy koszt konwersji, np. 45")
    group.add_argument("--roas", type=lambda v: float(v.replace(",", ".").rstrip("%")) / 100,
                       help="docelowy ROAS w procentach, np. 400")
    group.add_argument("--cpc-ceiling", type=to_micros, help="maks. stawka CPC dla strategii Maks. liczba kliknięć")
    add_common_args(p, mutate=True)
    p.set_defaults(func=cmd_bid_target)

    p = sub.add_parser("locations", help="pokaż / dodaj / usuń / wyklucz lokalizacje (ID z locations.py)")
    p.add_argument("campaign_id", type=int)
    p.add_argument("--add", nargs="+", default=[], metavar="GEO_ID")
    p.add_argument("--remove", nargs="+", default=[], metavar="GEO_ID")
    p.add_argument("--exclude", nargs="+", default=[], metavar="GEO_ID")
    add_common_args(p, mutate=True)
    p.set_defaults(func=cmd_locations)

    args = parser.parse_args()
    client = load_client(args.config)
    args.func(client, require_customer(args), args)


if __name__ == "__main__":
    run(main)
