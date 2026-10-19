# Google Ads ⇄ Claude Code — bezpośrednio przez Google Ads API

Zestaw skryptów, dzięki którym Claude Code prowadzi Twoje kampanie Google Ads **bez narzędzi pośredniczących**
(Adspirer, Windsor itp.). Skrypty łączą się wprost z oficjalnym API Google na Twoim komputerze,
Twoimi danymi logowania. Nic nie przechodzi przez zewnętrzną firmę.

```
Ty ──► Claude Code ──► skrypty z tego katalogu ──► Google Ads API ──► Twoje konta (MCC i klienci)
                          (Twój komputer)            (Google)
```

**Co potrafią:**

| Obszar | Możliwości |
|---|---|
| Odczyt | konta pod MCC, kampanie, grupy, słowa (z wynikiem jakości), wyszukiwane hasła, reklamy (siła, zatwierdzenie), dowolne zapytanie GAQL, eksport CSV |
| Kampanie | pauza / włączenie, zmiana nazwy, budżet dzienny, docelowy CPA / ROAS, limit CPC, lokalizacje |
| Grupy i reklamy | pauza / włączenie, stawka max CPC, pauza / włączenie reklam |
| Słowa kluczowe | dodawanie, wykluczenia (kampania / grupa), pauza, stawki, usuwanie |
| Nowe kampanie | kampania w sieci wyszukiwania z pliku JSON: budżet, stawki, lokalizacje, grupy, słowa, wykluczenia, reklamy RSA |

**Bezpieczeństwo:** każda zmiana bez flagi `--apply` jest tylko *sprawdzana* przez Google (tryb `validate_only`).
Nic się nie zmienia, dopóki nie dodasz `--apply`. Nowe kampanie zawsze powstają **wstrzymane**.

---

## Spis treści

1. [Czego potrzebujesz](#1-czego-potrzebujesz)
2. [Developer token](#2-developer-token-google-ads)
3. [Projekt Google Cloud i klient OAuth](#3-projekt-google-cloud-i-klient-oauth)
4. [Instalacja skryptów](#4-instalacja-skryptów)
5. [Logowanie (plik google-ads.yaml)](#5-logowanie--plik-google-adsyaml)
6. [Test połączenia](#6-test-połączenia)
7. [Praca z Claude Code](#7-praca-z-claude-code)
8. [Ściąga poleceń](#8-ściąga-poleceń)
9. [Nowa kampania z pliku JSON](#9-nowa-kampania-z-pliku-json)
10. [Opcjonalnie: oficjalny serwer MCP Google](#10-opcjonalnie-oficjalny-serwer-mcp-google-tylko-odczyt)
11. [Rozwiązywanie problemów](#11-rozwiązywanie-problemów)

---

## 1. Czego potrzebujesz

- **Konto menedżera Google Ads (MCC)** z dostępem do kont, którymi chcesz zarządzać.
- **Projekt Google Cloud** (np. `topstrony`) — tylko do utworzenia klienta OAuth, nic nie kosztuje.
- **Python 3.10 lub nowszy** — sprawdź: `python3 --version`.
  - macOS: `brew install python` · Windows: [python.org/downloads](https://www.python.org/downloads/) (zaznacz *Add to PATH*) · Ubuntu: `sudo apt install python3 python3-venv`
- **Claude Code** na Twoim komputerze (`npm install -g @anthropic-ai/claude-code` albo aplikacja desktop).
- **To repozytorium** u Ciebie lokalnie:
  ```bash
  git clone https://github.com/KamilPiech1991/qamitech.git
  cd qamitech/google-ads
  ```

> Skrypty uruchamiasz **na swoim komputerze**. Sesje Claude Code w chmurze (claude.ai/code) działają
> w tymczasowym kontenerze — tam logowanie do Google Ads by się nie utrzymało.

---

## 2. Developer token Google Ads

1. Zaloguj się na **konto MCC** w [ads.google.com](https://ads.google.com).
2. **Administracja → Centrum API** (w starszym menu: *Narzędzia i ustawienia → Konfiguracja → Centrum API*).
   Centrum API jest dostępne tylko na koncie MCC.
3. Wypełnij formularz (adres e-mail kontaktowy, strona firmy), zaakceptuj warunki — dostaniesz **developer token**.
4. Sprawdź **poziom dostępu** tokena:

| Poziom | Co działa |
|---|---|
| *Konto testowe* (Test Account Access) | **tylko konta testowe** — na prawdziwych kontach błąd `DEVELOPER_TOKEN_NOT_APPROVED` |
| *Podstawowy* (Basic Access) | prawdziwe konta, do 15 000 operacji dziennie — w zupełności wystarczy |
| *Standardowy* | bez dziennego limitu |

Jeśli masz *Konto testowe*, w Centrum API kliknij **Poproś o dostęp podstawowy (Apply for Basic Access)**.
We wniosku opisz użycie zgodnie z prawdą, np.: *„Wewnętrzne narzędzie agencji do raportowania i zarządzania
kampaniami kont klientów podpiętych pod nasze MCC. Bez dostępu dla osób trzecich.”*
Rozpatrzenie trwa zwykle od kilku dni do ok. 2 tygodni.

> Developer token to sekret. Nie wklejaj go do czatu, maili ani do repozytorium.

---

## 3. Projekt Google Cloud i klient OAuth

Wszystko w [console.cloud.google.com](https://console.cloud.google.com), w projekcie `topstrony`
(albo nowym — wybór projektu u góry strony).

### 3a. Włącz Google Ads API
**API i usługi → Biblioteka** → wyszukaj **Google Ads API** → **Włącz**.

### 3b. Ekran zgody OAuth
**Google Auth Platform** (dawniej *API i usługi → Ekran zgody OAuth*) → **Rozpocznij**:
- nazwa aplikacji: np. `Qamitech Google Ads`, e-mail pomocy: Twój,
- odbiorcy: **Zewnętrzni (External)**,
- dane kontaktowe: Twój e-mail → **Utwórz**.

Potem **Odbiorcy (Audience)**:
- dodaj swój adres Google jako **użytkownika testowego**, **albo lepiej**
- kliknij **Opublikuj aplikację (Publish app)** → *W wersji produkcyjnej*.

> W trybie *Testowanie* Google unieważnia refresh token **po 7 dniach** i trzeba logować się od nowa.
> Po opublikowaniu token jest stały. Weryfikacja Google nie jest potrzebna do własnego użytku —
> przy logowaniu zobaczysz tylko ostrzeżenie „Google nie zweryfikował tej aplikacji” → **Zaawansowane → Przejdź do…**.

### 3c. Klient OAuth
**Google Auth Platform → Klienci → Utwórz klienta**:
- typ aplikacji: **Aplikacja komputerowa (Desktop app)**,
- nazwa: np. `Claude Code` → **Utwórz** → **Pobierz JSON**.

Zapisz pobrany plik jako **`google-ads/client_secret.json`** (jest w `.gitignore`, nie trafi do repo).

---

## 4. Instalacja skryptów

**macOS / Linux:**
```bash
cd qamitech/google-ads
./install.sh
```

**Windows (PowerShell):**
```powershell
cd qamitech\google-ads
powershell -ExecutionPolicy Bypass -File install.ps1
```

Instalator tworzy lokalne środowisko `.venv` i instaluje oficjalną bibliotekę Google `google-ads`.
Na Windows w dalszych poleceniach zamiast `.venv/bin/python` używaj `.venv\Scripts\python.exe`.

---

## 5. Logowanie — plik `google-ads.yaml`

```bash
.venv/bin/python auth.py --client-secrets client_secret.json --login-customer-id 123-456-7890
```

- `--login-customer-id` to **ID Twojego konta MCC** (widać je w prawym górnym rogu panelu Google Ads).
- Skrypt zapyta o **developer token** (wpisywanie jest niewidoczne — to normalne).
- Otworzy się przeglądarka → zaloguj się **kontem Google, które ma dostęp do MCC** → zezwól na dostęp do Google Ads.
- Powstanie plik `google-ads.yaml` (uprawnienia tylko dla Ciebie, w `.gitignore`).

Zmiana konta lub tokena: to samo polecenie z `--force`. Wzór pliku: `google-ads.yaml.example`.

---

## 6. Test połączenia

```bash
.venv/bin/python accounts.py                      # konta pod MCC
.venv/bin/python campaign.py list -c 500-241-2688  # kampanie wybranego konta
.venv/bin/python report.py campaigns -c 500-241-2688 --days 30
```

Jeśli najczęściej pracujesz na jednym koncie, ustaw je domyślnie i pomijaj `-c`:
```bash
export GOOGLE_ADS_CUSTOMER_ID=500-241-2688        # Windows: $env:GOOGLE_ADS_CUSTOMER_ID="500-241-2688"
```

---

## 7. Praca z Claude Code

Uruchom Claude Code w katalogu repozytorium:

```bash
cd qamitech
claude
```

W repo jest skill `.claude/skills/google-ads/`, który uczy Claude'a tych skryptów i zasad bezpieczeństwa.
Piszesz zwyczajnie po polsku, np.:

- „Pokaż wyniki wszystkich kampanii na koncie 500-241-2688 z ostatnich 30 dni.”
- „Znajdź wyszukiwane hasła, które kosztowały ponad 10 zł i nie dały konwersji, i zaproponuj wykluczenia.”
- „Które słowa kluczowe mają wynik jakości poniżej 5?”
- „Podnieś budżet kampanii Outsourcing IT do 60 zł dziennie.”
- „Przygotuj kampanię Search na tworzenie stron www dla Piaseczna i Warszawy, budżet 30 zł.”

Jak to przebiega przy zmianach:

1. Claude uruchamia polecenie **bez `--apply`** — Google sprawdza zmianę, nic się nie dzieje.
2. Pokazuje Ci, co dokładnie się zmieni (stara → nowa wartość).
3. Po Twoim „tak” uruchamia to samo z `--apply`.

Claude Code zapyta Cię też o zgodę przed każdym uruchomieniem polecenia — to druga warstwa kontroli.

---

## 8. Ściąga poleceń

Wszystkie polecenia uruchamiasz w `google-ads/`. `-c` = ID konta (z myślnikami lub bez), podawane **po** nazwie podkomendy.
Każdy skrypt ma pomoc: `.venv/bin/python campaign.py --help`, `.venv/bin/python campaign.py budget --help`.

### Raporty (tylko odczyt)
```bash
.venv/bin/python report.py campaigns    -c ID [--days 30 | --from 2026-09-01 --to 2026-09-30]
.venv/bin/python report.py adgroups     -c ID [--campaign CAMPAIGN_ID]
.venv/bin/python report.py keywords     -c ID [--campaign CAMPAIGN_ID] [--ad-group AD_GROUP_ID]
.venv/bin/python report.py search-terms -c ID --no-conversions --min-cost 5     # kandydaci na wykluczenia
.venv/bin/python report.py ads          -c ID                                   # siła reklam, odrzucenia
.venv/bin/python report.py campaigns    -c ID --csv kampanie.csv                # eksport do Excela (separator ;)
.venv/bin/python query.py -c ID "SELECT campaign.name, metrics.clicks FROM campaign WHERE segments.date DURING LAST_7_DAYS"
```

### Kampanie
```bash
.venv/bin/python campaign.py list   -c ID
.venv/bin/python campaign.py pause  CAMPAIGN_ID -c ID [--apply]
.venv/bin/python campaign.py enable CAMPAIGN_ID -c ID [--apply]
.venv/bin/python campaign.py rename CAMPAIGN_ID "Nowa nazwa" -c ID [--apply]
.venv/bin/python campaign.py budget CAMPAIGN_ID 50 -c ID [--apply]                 # budżet dzienny
.venv/bin/python campaign.py bid-target CAMPAIGN_ID --cpa 45 -c ID [--apply]        # Maks. konwersji / Docelowy CPA
.venv/bin/python campaign.py bid-target CAMPAIGN_ID --roas 400 -c ID [--apply]      # 400 = 400%
.venv/bin/python campaign.py bid-target CAMPAIGN_ID --cpc-ceiling 5 -c ID [--apply] # Maks. liczba kliknięć
.venv/bin/python locations.py Piaseczno Warszawa                                    # ID lokalizacji
.venv/bin/python campaign.py locations CAMPAIGN_ID -c ID                            # obecne lokalizacje
.venv/bin/python campaign.py locations CAMPAIGN_ID --add GEO_ID --remove GEO_ID -c ID [--apply]
```

### Grupy reklam i reklamy
```bash
.venv/bin/python adgroup.py list   -c ID [--campaign CAMPAIGN_ID]
.venv/bin/python adgroup.py pause  AD_GROUP_ID -c ID [--apply]
.venv/bin/python adgroup.py bid    AD_GROUP_ID 2,50 -c ID [--apply]
.venv/bin/python adgroup.py ad-pause AD_GROUP_ID AD_ID -c ID [--apply]              # AD_ID z: report.py ads
```

### Słowa kluczowe
Notacja dopasowania jak w Google Ads Editor: `[ścisłe]`, `"do wyrażenia"`, bez znaczników = `--match` (domyślnie PHRASE).
```bash
.venv/bin/python keywords.py add --ad-group AD_GROUP_ID "[serwis komputerowy piaseczno]" '"obsługa it firm"' -c ID [--apply]
.venv/bin/python keywords.py add --ad-group AD_GROUP_ID --file slowa.txt --cpc 3 -c ID [--apply]
.venv/bin/python keywords.py negative --campaign CAMPAIGN_ID praca darmowe kurs --match BROAD -c ID [--apply]
.venv/bin/python keywords.py negatives --campaign CAMPAIGN_ID -c ID
.venv/bin/python keywords.py pause AD_GROUP_ID CRITERION_ID [CRITERION_ID…] -c ID [--apply]   # ID z: report.py keywords
.venv/bin/python keywords.py bid   AD_GROUP_ID CRITERION_ID 4 -c ID [--apply]
.venv/bin/python keywords.py remove AD_GROUP_ID CRITERION_ID -c ID [--apply]                  # nieodwracalne
```

---

## 9. Nowa kampania z pliku JSON

1. Skopiuj wzór: `cp examples/kampania-search.json moja-kampania.json` i dostosuj
   (albo poproś Claude'a: „przygotuj plik kampanii na …”).
2. Sprawdź bez zapisu — skrypt waliduje długości tekstów, a Google sprawdza całą kampanię:
   ```bash
   .venv/bin/python create_search_campaign.py moja-kampania.json -c ID
   ```
3. Utwórz (powstaje **wstrzymana**, w jednym kroku — albo całość, albo nic):
   ```bash
   .venv/bin/python create_search_campaign.py moja-kampania.json -c ID --apply
   ```
4. Obejrzyj kampanię w panelu Google Ads, dodaj rozszerzenia (linki do podstron, objaśnienia, połączenia),
   a potem włącz: `.venv/bin/python campaign.py enable CAMPAIGN_ID -c ID --apply`.

Najważniejsze pola pliku:

| Pole | Znaczenie |
|---|---|
| `name`, `daily_budget` | nazwa i budżet dzienny w walucie konta |
| `bidding.strategy` | `maximize_clicks` (+ opcjonalnie `max_cpc`), `maximize_conversions` (+ opcjonalnie `target_cpa`), `manual_cpc` (wtedy `max_cpc` w każdej grupie) |
| `locations` | ID lokalizacji z `locations.py` (2616 = Polska). Kierowanie: osoby przebywające w lokalizacji |
| `languages` | 1030 = polski |
| `search_partners` | `false` = tylko wyszukiwarka Google (zalecane na start) |
| `default_match` | dopasowanie słów bez znaczników `[ ]` / `" "` |
| `negative_keywords` | wykluczenia kampanii (domyślnie przybliżone) |
| `ad_groups[].keywords` | słowa grupy |
| `ad_groups[].ads[]` | reklamy RSA: `final_url`, `path1`, `path2`, `headlines` (3–15 × maks. 30 zn.), `descriptions` (2–4 × maks. 90 zn.). Przypięcie: `{"text": "…", "pin": "HEADLINE_1"}` |

---

## 10. Opcjonalnie: oficjalny serwer MCP Google (tylko odczyt)

Google udostępnia też własny serwer MCP — [googleads/google-ads-mcp](https://github.com/googleads/google-ads-mcp).
Służy do **odczytu** danych (zapytania i raporty), nie do zmian. Skrypty z tego katalogu w pełni go zastępują,
ale jeśli chcesz go mieć, możesz użyć tego samego klienta OAuth:

```bash
# wymaga gcloud CLI i pipx
gcloud auth application-default login \
  --client-id-file=client_secret.json \
  --scopes=https://www.googleapis.com/auth/adwords,https://www.googleapis.com/auth/cloud-platform

claude mcp add google-ads-mcp -s user \
  -e GOOGLE_PROJECT_ID=topstrony \
  -e GOOGLE_ADS_DEVELOPER_TOKEN=<developer_token> \
  -e GOOGLE_ADS_LOGIN_CUSTOMER_ID=<ID_MCC_bez_myślników> \
  -- pipx run --spec git+https://github.com/googleads/google-ads-mcp.git google-ads-mcp

claude mcp list
```

---

## 11. Rozwiązywanie problemów

| Komunikat | Przyczyna i rozwiązanie |
|---|---|
| `DEVELOPER_TOKEN_NOT_APPROVED` | token ma dostęp tylko do kont testowych → wniosek o Basic Access (krok 2) |
| `DEVELOPER_TOKEN_PROHIBITED` | token z innego projektu Google Cloud niż klient OAuth — jeden token może być powiązany tylko z jednym projektem; użyj klienta OAuth z tego samego projektu |
| `USER_PERMISSION_DENIED` | brak `login_customer_id` (MCC) w `google-ads.yaml` albo konto nie jest pod tym MCC → `auth.py --force --login-customer-id …` |
| `invalid_grant` / `Token has been expired or revoked` | refresh token wygasł (aplikacja OAuth w trybie *Testowanie* — krok 3b) → opublikuj aplikację i `auth.py --force` |
| `NOT_ADS_USER` | zalogowałeś się kontem Google bez dostępu do Google Ads → `auth.py --force` innym kontem |
| `CUSTOMER_NOT_ENABLED` | konto zawieszone lub anulowane |
| `SERVICE_DISABLED` / `Google Ads API has not been used in project` | włącz Google Ads API w projekcie (krok 3a) |
| „Google nie zweryfikował tej aplikacji” | normalne dla własnej aplikacji → *Zaawansowane → Przejdź do…* |
| `Brak biblioteki google-ads` | uruchamiasz systemowy `python` zamiast `.venv/bin/python` albo nie było `./install.sh` |
| Pusty raport | w wybranym okresie nie było wyświetleń; raporty pokazują tylko wiersze z aktywnością (`campaign.py list` pokazuje wszystkie kampanie) |

Każdy błąd API pokazuje `request_id` — przydaje się przy kontakcie z pomocą Google Ads API.

**Czego skrypty nie robią (na razie):** kampanie Performance Max, Display, YouTube i Shopping, rozszerzenia (zasoby),
listy odbiorców, harmonogram reklam. Do odczytu takich danych użyj `query.py`, zmiany wprowadzaj w panelu
albo poproś Claude'a o dopisanie skryptu.
