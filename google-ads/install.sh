#!/usr/bin/env bash
# Instalacja skryptów Google Ads (macOS / Linux): tworzy .venv i instaluje biblioteki.
set -euo pipefail
cd "$(dirname "$0")"

PYTHON="${PYTHON:-python3}"
if ! command -v "$PYTHON" >/dev/null 2>&1; then
  echo "Nie znaleziono python3. Zainstaluj Pythona 3.10+ (macOS: brew install python, Ubuntu: sudo apt install python3 python3-venv)."
  exit 1
fi
if ! "$PYTHON" -c 'import sys; sys.exit(0 if sys.version_info >= (3, 10) else 1)'; then
  echo "Potrzebny Python 3.10 lub nowszy, a masz: $("$PYTHON" --version)"
  exit 1
fi

echo "→ Tworzę środowisko .venv"
"$PYTHON" -m venv .venv
echo "→ Instaluję biblioteki (google-ads, google-auth-oauthlib)"
.venv/bin/python -m pip install --quiet --upgrade pip
.venv/bin/python -m pip install --quiet -r requirements.txt
echo "✓ Zainstalowano: $(.venv/bin/python -m pip show google-ads | grep ^Version)"

if [ -f google-ads.yaml ]; then
  echo "✓ Plik google-ads.yaml już istnieje. Test: .venv/bin/python accounts.py"
else
  cat <<'EOF'

Następny krok: zaloguj się do Google Ads (README.md, krok 5):

  .venv/bin/python auth.py --client-secrets client_secret.json --login-customer-id 123-456-7890

EOF
fi
