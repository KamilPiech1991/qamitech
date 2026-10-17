"""Dowolne zapytanie GAQL (Google Ads Query Language) — tylko odczyt.

Kolumny to pola z SELECT. Kwoty *_micros są przeliczane na walutę konta.
Pola i zasoby: https://developers.google.com/google-ads/api/fields/latest/overview

Przykłady:
    .venv/bin/python query.py -c 123-456-7890 "SELECT campaign.name, metrics.clicks FROM campaign WHERE segments.date DURING LAST_7_DAYS"
    .venv/bin/python query.py -c 123-456-7890 --file zapytanie.sql --csv wynik.csv
"""

import argparse
import enum
import re
import sys

from gads_common import MICROS, add_common_args, load_client, print_table, require_customer, run, search


def fields_from(query):
    match = re.search(r"select\s+(.*?)\s+from\s", query, re.IGNORECASE | re.DOTALL)
    if not match:
        sys.exit("Zapytanie musi mieć postać SELECT … FROM …")
    return [f.strip() for f in match.group(1).split(",") if f.strip()]


def value_at(row, path):
    value = row
    for part in path.split("."):
        value = getattr(value, part if hasattr(value, part) else part + "_")
    if isinstance(value, enum.Enum):
        return value.name
    if path.endswith("_micros") and isinstance(value, int):
        return f"{value / MICROS:.2f}"
    if isinstance(value, float):
        return f"{value:.4g}"
    if hasattr(value, "__iter__") and not isinstance(value, str):
        return " | ".join(str(getattr(v, "text", v)) for v in value)
    return value


def main():
    parser = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    parser.add_argument("query", nargs="?", help="zapytanie GAQL")
    parser.add_argument("--file", help="plik z zapytaniem")
    parser.add_argument("--csv", help="zapisz wynik do CSV")
    add_common_args(parser)
    args = parser.parse_args()

    query = open(args.file, encoding="utf-8").read() if args.file else args.query
    if not query:
        sys.exit("Podaj zapytanie albo --file.")
    client = load_client(args.config)
    fields = fields_from(query)
    rows = [[value_at(r, f) for f in fields] for r in search(client, require_customer(args), query)]
    print_table(fields, rows, args.csv)


if __name__ == "__main__":
    run(main)
