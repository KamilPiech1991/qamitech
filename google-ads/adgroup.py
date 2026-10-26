"""Grupy reklam: lista, pauza/wznowienie, stawka max CPC, reklamy (pauza/wznowienie).

Przykłady:
    .venv/bin/python adgroup.py list -c 123-456-7890 --campaign 2233445566
    .venv/bin/python adgroup.py pause 155667788 -c 123-456-7890 --apply
    .venv/bin/python adgroup.py bid 155667788 2,50 -c 123-456-7890
    .venv/bin/python adgroup.py ad-pause 155667788 700112233 -c 123-456-7890
"""

import argparse
import sys

from gads_common import (
    add_common_args, load_client, money, mutate, new_operation, print_table, require_customer, run,
    search, set_update_mask, to_micros,
)


def get_ad_group(client, cid, ad_group_id):
    query = f"""
        SELECT ad_group.resource_name, ad_group.name, ad_group.status, ad_group.cpc_bid_micros, campaign.name
        FROM ad_group WHERE ad_group.id = {int(ad_group_id)}"""
    rows = list(search(client, cid, query))
    if not rows:
        sys.exit(f"Nie znaleziono grupy reklam {ad_group_id}.")
    return rows[0]


def cmd_list(client, cid, args):
    where = "ad_group.status != 'REMOVED'"
    if args.campaign:
        where += f" AND campaign.id = {args.campaign}"
    query = f"""
        SELECT campaign.id, campaign.name, ad_group.id, ad_group.name, ad_group.status, ad_group.cpc_bid_micros
        FROM ad_group WHERE {where} ORDER BY campaign.name, ad_group.name"""
    rows = [
        [r.campaign.id, r.campaign.name, r.ad_group.id, r.ad_group.name, r.ad_group.status.name,
         money(r.ad_group.cpc_bid_micros)]
        for r in search(client, cid, query)
    ]
    print_table(["ID kampanii", "Kampania", "ID grupy", "Grupa", "Status", "Max CPC"], rows)


def cmd_status(client, cid, args):
    row = get_ad_group(client, cid, args.ad_group_id)
    new = "PAUSED" if args.command == "pause" else "ENABLED"
    print(f"Grupa „{row.ad_group.name}” ({row.campaign.name}): {row.ad_group.status.name} → {new}")
    op = new_operation(client)
    ad_group = op.ad_group_operation.update
    ad_group.resource_name = row.ad_group.resource_name
    ad_group.status = client.enums.AdGroupStatusEnum[new]
    set_update_mask(client, op.ad_group_operation, ad_group)
    mutate(client, cid, [op], args.apply)


def cmd_bid(client, cid, args):
    row = get_ad_group(client, cid, args.ad_group_id)
    print(f"Max CPC grupy „{row.ad_group.name}”: {money(row.ad_group.cpc_bid_micros)} → {money(args.amount)}")
    op = new_operation(client)
    ad_group = op.ad_group_operation.update
    ad_group.resource_name = row.ad_group.resource_name
    ad_group.cpc_bid_micros = args.amount
    set_update_mask(client, op.ad_group_operation, ad_group)
    mutate(client, cid, [op], args.apply)


def cmd_ad_status(client, cid, args):
    new = "PAUSED" if args.command == "ad-pause" else "ENABLED"
    op = new_operation(client)
    ad = op.ad_group_ad_operation.update
    ad.resource_name = client.get_service("AdGroupAdService").ad_group_ad_path(cid, args.ad_group_id, args.ad_id)
    ad.status = client.enums.AdGroupAdStatusEnum[new]
    set_update_mask(client, op.ad_group_ad_operation, ad)
    print(f"Reklama {args.ad_id} w grupie {args.ad_group_id} → {new}")
    mutate(client, cid, [op], args.apply)


def main():
    parser = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    sub = parser.add_subparsers(dest="command", required=True)

    p = sub.add_parser("list", help="lista grup reklam")
    add_common_args(p)
    p.add_argument("--campaign", type=int, help="tylko grupy tej kampanii")
    p.set_defaults(func=cmd_list)

    for name, help_text in [("pause", "wstrzymaj grupę"), ("enable", "włącz grupę")]:
        p = sub.add_parser(name, help=help_text)
        p.add_argument("ad_group_id", type=int)
        add_common_args(p, mutate=True)
        p.set_defaults(func=cmd_status)

    p = sub.add_parser("bid", help="ustaw domyślną stawkę max CPC grupy")
    p.add_argument("ad_group_id", type=int)
    p.add_argument("amount", type=to_micros)
    add_common_args(p, mutate=True)
    p.set_defaults(func=cmd_bid)

    for name, help_text in [("ad-pause", "wstrzymaj reklamę"), ("ad-enable", "włącz reklamę")]:
        p = sub.add_parser(name, help=help_text + " (ID z: report.py ads)")
        p.add_argument("ad_group_id", type=int)
        p.add_argument("ad_id", type=int)
        add_common_args(p, mutate=True)
        p.set_defaults(func=cmd_ad_status)

    args = parser.parse_args()
    client = load_client(args.config)
    args.func(client, require_customer(args), args)


if __name__ == "__main__":
    run(main)
