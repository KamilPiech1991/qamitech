"""Wspólne funkcje dla skryptów Google Ads: klient API, ID kont, kwoty, tabele, zmiany."""

import argparse
import csv
import datetime as dt
import os
import re
import sys
from pathlib import Path

try:
    from google.ads.googleads.client import GoogleAdsClient
    from google.ads.googleads.errors import GoogleAdsException
except ImportError:
    sys.exit(
        "Brak biblioteki google-ads. Uruchom ./install.sh (albo: pip install -r requirements.txt)\n"
        "i używaj Pythona z katalogu .venv, np. .venv/bin/python report.py campaigns"
    )

HERE = Path(__file__).resolve().parent
DEFAULT_CONFIG = HERE / "google-ads.yaml"
MICROS = 1_000_000


# --- Klient i argumenty -------------------------------------------------------

def load_client(config_path=None):
    path = Path(config_path or os.environ.get("GOOGLE_ADS_CONFIGURATION_FILE_PATH") or DEFAULT_CONFIG)
    if not path.exists():
        sys.exit(
            f"Nie znaleziono pliku konfiguracji: {path}\n"
            "Utwórz go poleceniem: .venv/bin/python auth.py --client-secrets client_secret.json\n"
            "(szczegóły w README.md, krok 5)."
        )
    return GoogleAdsClient.load_from_storage(str(path))


def clean_id(value):
    """'123-456-7890' -> '1234567890'."""
    digits = re.sub(r"[\s-]", "", str(value))
    if not digits.isdigit():
        raise argparse.ArgumentTypeError(f"niepoprawne ID: {value!r}")
    return digits


def base_parser(description, mutate=False):
    parser = argparse.ArgumentParser(description=description)
    add_common_args(parser, mutate)
    return parser


def add_common_args(parser, mutate=False):
    parser.add_argument(
        "-c", "--customer", type=clean_id, default=os.environ.get("GOOGLE_ADS_CUSTOMER_ID"),
        help="ID konta Google Ads (z myślnikami lub bez). Domyślnie zmienna GOOGLE_ADS_CUSTOMER_ID.",
    )
    parser.add_argument("--config", help="ścieżka do google-ads.yaml (domyślnie obok skryptów)")
    if mutate:
        parser.add_argument(
            "--apply", action="store_true",
            help="naprawdę zapisz zmiany. Bez tej flagi API tylko sprawdza poprawność (nic nie zmienia).",
        )


def require_customer(args):
    if args.customer:
        return clean_id(args.customer)
    sys.exit("Podaj konto: -c 123-456-7890 (albo ustaw zmienną GOOGLE_ADS_CUSTOMER_ID).")


def run(main):
    """Uruchamia main() i czytelnie wypisuje błędy API."""
    try:
        main()
    except GoogleAdsException as ex:
        print(f"\nBłąd Google Ads API (request_id: {ex.request_id})", file=sys.stderr)
        for error in ex.failure.errors:
            print(f"  - {error.message}", file=sys.stderr)
            if error.location:
                path = ".".join(el.field_name for el in error.location.field_path_elements)
                if path:
                    print(f"    pole: {path}", file=sys.stderr)
        sys.exit(1)
    except KeyboardInterrupt:
        sys.exit(130)


# --- Kwoty i daty -------------------------------------------------------------

def to_micros(value):
    """'50', '50,5', 3.2 -> mikrojednostki zaokrąglone do 0,01 (wymóg API dla budżetów)."""
    amount = float(str(value).replace(",", ".").replace(" ", ""))
    if amount < 0:
        raise argparse.ArgumentTypeError("kwota nie może być ujemna")
    return int(round(amount * 100)) * 10_000


def money(micros):
    return f"{(micros or 0) / MICROS:,.2f}".replace(",", " ")


def add_date_args(parser, default_days=30):
    parser.add_argument("--from", dest="date_from", type=dt.date.fromisoformat,
                        help="data początkowa RRRR-MM-DD")
    parser.add_argument("--to", dest="date_to", type=dt.date.fromisoformat,
                        help="data końcowa RRRR-MM-DD (domyślnie wczoraj)")
    parser.add_argument("--days", type=int, default=default_days,
                        help=f"ostatnie N dni, gdy brak --from (domyślnie {default_days})")


def date_clause(args):
    end = args.date_to or dt.date.today() - dt.timedelta(days=1)
    start = args.date_from or end - dt.timedelta(days=args.days - 1)
    if start > end:
        sys.exit("Data początkowa jest późniejsza niż końcowa.")
    print(f"Okres: {start} – {end}\n")
    return f"segments.date BETWEEN '{start}' AND '{end}'"


# --- Zapytania i tabele -------------------------------------------------------

def search(client, customer_id, query):
    service = client.get_service("GoogleAdsService")
    for batch in service.search_stream(customer_id=customer_id, query=query):
        yield from batch.results


def print_table(headers, rows, csv_path=None):
    rows = [["" if v is None else str(v) for v in row] for row in rows]
    if csv_path:
        with open(csv_path, "w", newline="", encoding="utf-8-sig") as fh:
            writer = csv.writer(fh, delimiter=";")
            writer.writerow(headers)
            writer.writerows(rows)
        print(f"Zapisano {len(rows)} wierszy do {csv_path}")
        return
    if not rows:
        print("(brak danych)")
        return
    widths = [max(len(h), *(len(r[i]) for r in rows)) for i, h in enumerate(headers)]
    numeric = [all(_is_number(r[i]) for r in rows) for i in range(len(headers))]

    def fmt(row):
        return "  ".join(c.rjust(w) if n else c.ljust(w) for c, w, n in zip(row, widths, numeric))

    print(fmt(headers))
    print("  ".join("-" * w for w in widths))
    for row in rows:
        print(fmt(row))
    print(f"\n{len(rows)} wierszy")


def _is_number(text):
    return bool(re.fullmatch(r"-?[\d ]+([.,]\d+)?%?", text)) or text in ("", "-")


# --- Słowa kluczowe ------------------------------------------------------------

def parse_keyword(raw, default_match="PHRASE"):
    """Notacja jak w Google Ads Editor: [dokładne], "do wyrażenia", reszta = default_match.

    Przyjmuje też słownik {"text": ..., "match": ...}.
    """
    if isinstance(raw, dict):
        return raw["text"].strip(), raw.get("match", default_match).upper()
    text = raw.strip()
    if text.startswith("[") and text.endswith("]"):
        return text[1:-1].strip(), "EXACT"
    if len(text) > 1 and text[0] == text[-1] == '"':
        return text[1:-1].strip(), "PHRASE"
    return text, default_match.upper()


def read_terms(terms, file_path):
    items = list(terms or [])
    if file_path:
        with open(file_path, encoding="utf-8") as fh:
            items += [line for line in fh.read().splitlines() if line.strip() and not line.startswith("#")]
    if not items:
        sys.exit("Podaj słowa kluczowe jako argumenty albo plik przez --file.")
    return items


# --- Zmiany (mutate) ----------------------------------------------------------

def new_operation(client):
    return client.get_type("MutateOperation")


def set_update_mask(client, operation_field, resource):
    from google.api_core import protobuf_helpers

    client.copy_from(operation_field.update_mask, protobuf_helpers.field_mask(None, resource._pb))


def mutate(client, customer_id, operations, apply):
    """Wysyła wszystkie operacje w jednym, atomowym żądaniu.

    Bez apply używa validate_only: API sprawdza zmiany, ale niczego nie zapisuje.
    """
    service = client.get_service("GoogleAdsService")
    request = client.get_type("MutateGoogleAdsRequest")
    request.customer_id = customer_id
    request.mutate_operations.extend(operations)
    request.validate_only = not apply
    response = service.mutate(request=request)

    if not apply:
        print(
            f"\nTRYB PRÓBNY: API sprawdziło {len(operations)} operacji i je zaakceptowało. "
            "Nic nie zostało zmienione.\nAby wykonać zmiany, uruchom to samo polecenie z flagą --apply."
        )
        return []

    names = []
    for result in response.mutate_operation_responses:
        kind = result._pb.WhichOneof("response")
        if kind:
            names.append(getattr(result, kind).resource_name)
    print(f"\nZAPISANO: {len(names)} zmian.")
    for name in names:
        print(f"  {name}")
    return names
