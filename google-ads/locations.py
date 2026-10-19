"""Wyszukiwanie ID lokalizacji (geo target) do kierowania kampanii.

Przykład:
    .venv/bin/python locations.py Piaseczno Warszawa "Lesznowola"
"""

import argparse

from gads_common import load_client, print_table, run


def main():
    parser = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    parser.add_argument("names", nargs="+", help="nazwy miejscowości, regionów lub krajów")
    parser.add_argument("--country", default="PL", help="kod kraju (domyślnie PL)")
    parser.add_argument("--config")
    args = parser.parse_args()
    client = load_client(args.config)

    service = client.get_service("GeoTargetConstantService")
    request = client.get_type("SuggestGeoTargetConstantsRequest")
    request.locale = "pl"
    request.country_code = args.country
    request.location_names.names.extend(args.names)

    rows = []
    for suggestion in service.suggest_geo_target_constants(request=request).geo_target_constant_suggestions:
        geo = suggestion.geo_target_constant
        rows.append([geo.id, geo.name, geo.target_type, geo.canonical_name, suggestion.reach or ""])
    print_table(["ID", "Nazwa", "Typ", "Pełna nazwa", "Zasięg"], rows)
    print("\nID wpisz w polu \"locations\" pliku kampanii albo w campaign.py locations.")


if __name__ == "__main__":
    run(main)
