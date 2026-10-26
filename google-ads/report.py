"""Raporty skuteczności: kampanie, grupy reklam, słowa kluczowe, wyszukiwane hasła, reklamy.

Przykłady:
    .venv/bin/python report.py campaigns -c 123-456-7890
    .venv/bin/python report.py keywords -c 123-456-7890 --days 90 --campaign 2233445566
    .venv/bin/python report.py search-terms -c 123-456-7890 --no-conversions --min-cost 5
    .venv/bin/python report.py ads -c 123-456-7890 --csv reklamy.csv
"""

import argparse

from gads_common import (
    MICROS, add_common_args, add_date_args, date_clause, load_client, money, print_table,
    require_customer, run, search,
)

METRICS = """metrics.impressions, metrics.clicks, metrics.ctr, metrics.average_cpc,
             metrics.cost_micros, metrics.conversions, metrics.conversions_value"""
METRIC_HEADERS = ["Wyśw.", "Kliki", "CTR", "Śr. CPC", "Koszt", "Konw.", "Koszt/konw.", "Wart. konw."]


def metric_cells(m):
    cost_per_conv = money(m.cost_micros / m.conversions) if m.conversions else "-"
    return [
        m.impressions, m.clicks, f"{m.ctr * 100:.2f}%", money(m.average_cpc), money(m.cost_micros),
        f"{m.conversions:.2f}", cost_per_conv, f"{m.conversions_value:.2f}",
    ]


def filters(args, extra=()):
    parts = [date_clause(args), *extra]
    if args.campaign:
        parts.append(f"campaign.id = {args.campaign}")
    if getattr(args, "ad_group", None):
        parts.append(f"ad_group.id = {args.ad_group}")
    if args.min_cost:
        parts.append(f"metrics.cost_micros >= {int(args.min_cost * MICROS)}")
    return " AND ".join(parts)


def limit(args):
    return f"LIMIT {args.limit}" if args.limit else ""


def campaigns(client, cid, args):
    query = f"""
        SELECT campaign.id, campaign.name, campaign.status, campaign.advertising_channel_type,
               campaign.bidding_strategy_type, campaign_budget.amount_micros, {METRICS}
        FROM campaign
        WHERE {filters(args, ["campaign.status != 'REMOVED'"])}
        ORDER BY metrics.cost_micros DESC {limit(args)}"""
    rows = [
        [r.campaign.id, r.campaign.name, r.campaign.status.name, r.campaign.advertising_channel_type.name,
         r.campaign.bidding_strategy_type.name, money(r.campaign_budget.amount_micros), *metric_cells(r.metrics)]
        for r in search(client, cid, query)
    ]
    headers = ["ID", "Kampania", "Status", "Typ", "Stawki", "Budżet/dz.", *METRIC_HEADERS]
    totals(rows, headers, args)


def adgroups(client, cid, args):
    query = f"""
        SELECT campaign.name, ad_group.id, ad_group.name, ad_group.status, ad_group.cpc_bid_micros, {METRICS}
        FROM ad_group
        WHERE {filters(args, ["ad_group.status != 'REMOVED'"])}
        ORDER BY metrics.cost_micros DESC {limit(args)}"""
    rows = [
        [r.campaign.name, r.ad_group.id, r.ad_group.name, r.ad_group.status.name,
         money(r.ad_group.cpc_bid_micros), *metric_cells(r.metrics)]
        for r in search(client, cid, query)
    ]
    totals(rows, ["Kampania", "ID grupy", "Grupa", "Status", "Max CPC", *METRIC_HEADERS], args)


def keywords(client, cid, args):
    query = f"""
        SELECT campaign.name, ad_group.id, ad_group.name, ad_group_criterion.criterion_id,
               ad_group_criterion.keyword.text, ad_group_criterion.keyword.match_type,
               ad_group_criterion.status, ad_group_criterion.quality_info.quality_score, {METRICS}
        FROM keyword_view
        WHERE {filters(args, ["ad_group_criterion.status != 'REMOVED'"])}
        ORDER BY metrics.cost_micros DESC {limit(args)}"""
    rows = []
    for r in search(client, cid, query):
        k = r.ad_group_criterion
        rows.append([
            r.campaign.name, r.ad_group.id, k.criterion_id, k.keyword.text, k.keyword.match_type.name,
            k.status.name, k.quality_info.quality_score or "-", *metric_cells(r.metrics),
        ])
    totals(rows, ["Kampania", "ID grupy", "ID słowa", "Słowo kluczowe", "Dopas.", "Status", "QS",
                  *METRIC_HEADERS], args)


def search_terms(client, cid, args):
    extra = ["metrics.conversions = 0", "metrics.cost_micros > 0"] if args.no_conversions else []
    query = f"""
        SELECT search_term_view.search_term, search_term_view.status, campaign.id, campaign.name,
               ad_group.id, ad_group.name, {METRICS}
        FROM search_term_view
        WHERE {filters(args, extra)}
        ORDER BY metrics.cost_micros DESC {limit(args)}"""
    rows = [
        [r.search_term_view.search_term, r.search_term_view.status.name, r.campaign.id, r.ad_group.id,
         r.ad_group.name, *metric_cells(r.metrics)]
        for r in search(client, cid, query)
    ]
    totals(rows, ["Wyszukiwane hasło", "Status", "ID kampanii", "ID grupy", "Grupa", *METRIC_HEADERS], args)


def ads(client, cid, args):
    query = f"""
        SELECT campaign.name, ad_group.id, ad_group.name, ad_group_ad.ad.id, ad_group_ad.ad.type,
               ad_group_ad.status, ad_group_ad.ad_strength, ad_group_ad.policy_summary.approval_status,
               ad_group_ad.ad.final_urls, ad_group_ad.ad.responsive_search_ad.headlines, {METRICS}
        FROM ad_group_ad
        WHERE {filters(args, ["ad_group_ad.status != 'REMOVED'"])}
        ORDER BY metrics.cost_micros DESC {limit(args)}"""
    rows = []
    for r in search(client, cid, query):
        ad = r.ad_group_ad.ad
        headlines = " | ".join(h.text for h in ad.responsive_search_ad.headlines[:3])
        rows.append([
            r.ad_group.name, ad.id, ad.type_.name, r.ad_group_ad.status.name, r.ad_group_ad.ad_strength.name,
            r.ad_group_ad.policy_summary.approval_status.name, headlines, ad.final_urls[0] if ad.final_urls else "",
            *metric_cells(r.metrics),
        ])
    totals(rows, ["Grupa", "ID reklamy", "Typ", "Status", "Siła", "Zatwierdzenie", "Nagłówki (3 pierwsze)",
                  "URL", *METRIC_HEADERS], args)


def totals(rows, headers, args):
    print_table(headers, rows, args.csv)
    if rows and not args.csv:
        def col(name):
            return headers.index(name)

        def num(value):
            return float(str(value).replace(" ", "").replace(",", ".").rstrip("%"))

        cost = sum(num(r[col("Koszt")]) for r in rows)
        clicks = sum(int(r[col("Kliki")]) for r in rows)
        conv = sum(num(r[col("Konw.")]) for r in rows)
        cpa = f"{cost / conv:.2f}" if conv else "-"
        print(f"RAZEM: koszt {cost:.2f}, kliknięcia {clicks}, konwersje {conv:.2f}, koszt/konw. {cpa}")


REPORTS = {
    "campaigns": (campaigns, "kampanie"),
    "adgroups": (adgroups, "grupy reklam"),
    "keywords": (keywords, "słowa kluczowe z wynikiem jakości"),
    "search-terms": (search_terms, "wyszukiwane hasła (źródło wykluczeń i nowych słów)"),
    "ads": (ads, "reklamy z siłą reklamy i statusem zatwierdzenia"),
}


def main():
    parser = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    sub = parser.add_subparsers(dest="report", required=True)
    for name, (_, help_text) in REPORTS.items():
        p = sub.add_parser(name, help=help_text)
        add_common_args(p)
        add_date_args(p)
        p.add_argument("--campaign", type=int, help="tylko ta kampania (ID)")
        p.add_argument("--min-cost", type=float, help="pokaż tylko wiersze z kosztem co najmniej X")
        p.add_argument("--limit", type=int, help="maksymalna liczba wierszy")
        p.add_argument("--csv", help="zapisz do pliku CSV (separator ;) zamiast wypisywać")
        if name != "campaigns":
            p.add_argument("--ad-group", type=int, help="tylko ta grupa reklam (ID)")
        if name == "search-terms":
            p.add_argument("--no-conversions", action="store_true",
                           help="tylko hasła z kosztem i bez konwersji (kandydaci na wykluczenia)")
    args = parser.parse_args()
    client = load_client(args.config)
    REPORTS[args.report][0](client, require_customer(args), args)


if __name__ == "__main__":
    run(main)
