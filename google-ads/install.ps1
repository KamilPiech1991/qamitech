# Instalacja skryptów Google Ads (Windows PowerShell): tworzy .venv i instaluje biblioteki.
# Uruchom: powershell -ExecutionPolicy Bypass -File install.ps1
$ErrorActionPreference = "Stop"
Set-Location $PSScriptRoot

$python = Get-Command py -ErrorAction SilentlyContinue
if (-not $python) { $python = Get-Command python -ErrorAction SilentlyContinue }
if (-not $python) {
    Write-Host "Nie znaleziono Pythona. Zainstaluj Python 3.10+ z https://www.python.org/downloads/ (zaznacz 'Add to PATH')."
    exit 1
}

Write-Host "-> Tworze srodowisko .venv"
& $python.Source -m venv .venv
Write-Host "-> Instaluje biblioteki (google-ads, google-auth-oauthlib)"
& .\.venv\Scripts\python.exe -m pip install --quiet --upgrade pip
& .\.venv\Scripts\python.exe -m pip install --quiet -r requirements.txt
Write-Host "OK. Nastepny krok (README.md, krok 5):"
Write-Host "  .\.venv\Scripts\python.exe auth.py --client-secrets client_secret.json --login-customer-id 123-456-7890"
