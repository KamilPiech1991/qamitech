"""Logowanie do Google Ads i utworzenie pliku google-ads.yaml.

Otwiera przeglądarkę, prosi o zgodę na dostęp do Google Ads i zapisuje
refresh token razem z developer tokenem i ID konta menedżera (MCC).

Przykład:
    .venv/bin/python auth.py --client-secrets client_secret.json --login-customer-id 123-456-7890
"""

import argparse
import getpass
import json
import os
import sys

from gads_common import DEFAULT_CONFIG, clean_id

SCOPE = "https://www.googleapis.com/auth/adwords"


def main():
    parser = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    parser.add_argument("--client-secrets", required=True,
                        help="plik JSON klienta OAuth (typ: aplikacja komputerowa) pobrany z Google Cloud")
    parser.add_argument("--login-customer-id", type=clean_id,
                        help="ID konta menedżera (MCC), przez które masz dostęp do kont klientów")
    parser.add_argument("--developer-token",
                        help="developer token z MCC (Narzędzia → Centrum API). Bez tej opcji skrypt o niego zapyta.")
    parser.add_argument("--output", default=str(DEFAULT_CONFIG), help="gdzie zapisać konfigurację")
    parser.add_argument("--force", action="store_true", help="nadpisz istniejący plik konfiguracji")
    parser.add_argument("--no-browser", action="store_true",
                        help="nie otwieraj przeglądarki automatycznie (wypisz tylko link)")
    args = parser.parse_args()

    if os.path.exists(args.output) and not args.force:
        sys.exit(f"{args.output} już istnieje. Użyj --force, aby go nadpisać.")

    with open(args.client_secrets, encoding="utf-8") as fh:
        secrets = json.load(fh)
    if "installed" not in secrets:
        sys.exit("To nie jest klient typu „Aplikacja komputerowa”. Utwórz taki w Google Cloud (README, krok 3).")
    client_id = secrets["installed"]["client_id"]
    client_secret = secrets["installed"]["client_secret"]

    developer_token = args.developer_token or getpass.getpass("Developer token (nie będzie widoczny): ").strip()
    if not developer_token:
        sys.exit("Developer token jest wymagany.")
    login_customer_id = args.login_customer_id or clean_id(
        input("ID konta MCC (Enter = brak, jeśli logujesz się bezpośrednio na konto reklamowe): ").strip() or "0"
    )

    from google_auth_oauthlib.flow import InstalledAppFlow

    flow = InstalledAppFlow.from_client_secrets_file(args.client_secrets, scopes=[SCOPE])
    print("\nZaloguj się w przeglądarce kontem Google, które ma dostęp do Google Ads…")
    credentials = flow.run_local_server(
        port=0, prompt="consent", access_type="offline", open_browser=not args.no_browser,
        authorization_prompt_message="Jeśli przeglądarka się nie otworzyła, wejdź na: {url}",
        success_message="Gotowe — możesz zamknąć tę kartę i wrócić do terminala.",
    )
    if not credentials.refresh_token:
        sys.exit("Google nie zwróciło refresh tokena. Usuń dostęp aplikacji na myaccount.google.com/permissions i spróbuj ponownie.")

    lines = [
        "# Konfiguracja Google Ads API — NIE commituj tego pliku (jest w .gitignore).",
        f'developer_token: "{developer_token}"',
        f'client_id: "{client_id}"',
        f'client_secret: "{client_secret}"',
        f'refresh_token: "{credentials.refresh_token}"',
        "use_proto_plus: True",
    ]
    if login_customer_id != "0":
        lines.append(f'login_customer_id: "{login_customer_id}"')

    fd = os.open(args.output, os.O_WRONLY | os.O_CREAT | os.O_TRUNC, 0o600)
    with os.fdopen(fd, "w", encoding="utf-8") as fh:
        fh.write("\n".join(lines) + "\n")
    print(f"\nZapisano {args.output}. Sprawdź połączenie: .venv/bin/python accounts.py")


if __name__ == "__main__":
    main()
