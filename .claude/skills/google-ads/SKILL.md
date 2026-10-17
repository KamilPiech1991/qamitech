---
name: google-ads
description: Prowadzenie kampanii Google Ads skryptami z katalogu google-ads/ (bezpośrednio przez Google Ads API, bez narzędzi pośredniczących). Używaj, gdy użytkownik prosi o raport, analizę, zmianę budżetu, stawek, statusu, słów kluczowych, wykluczeń albo o nową kampanię w Google Ads.
---

# Google Ads przez skrypty API

Skrypty są w `google-ads/`. Uruchamiaj je z tego katalogu Pythonem z `.venv`:

```bash
cd google-ads && .venv/bin/python <skrypt>.py ...      # Windows: .venv\Scripts\python.exe
```

Jeśli brak `.venv` → `./install.sh`. Jeśli brak `google-ads.yaml` → poproś użytkownika, żeby sam uruchomił
`auth.py` (README.md, krok 5). Nigdy nie proś o wklejenie tokenów do czatu i nie czytaj ani nie wypisuj zawartości `google-ads.yaml`.

## Zasady bezpieczeństwa (obowiązkowe)

1. Każda zmiana najpierw BEZ `--apply` (tryb próbny — API sprawdza, nic nie zmienia).
2. Pokaż użytkownikowi, co dokładnie się zmieni (konto, kampania, stara → nowa wartość) i poczekaj na wyraźne „tak”.
3. Dopiero wtedy to samo polecenie z `--apply`. Jedna zgoda = jedna opisana zmiana.
4. Nowe kampanie powstają wstrzymane. Włączenie (`campaign.py enable`) to osobna zmiana do zatwierdzenia.
5. `keywords.py remove` jest nieodwracalne — preferuj `pause`.
6. Przy zmianie budżetu o więcej niż 50% albo budżetu wspólnego — wyraźnie to zaznacz.
7. Zawsze podawaj konto `-c` (po nazwie podkomendy). Gdy nie wiesz, które — `accounts.py`.

## Mapa skryptów

| Cel | Polecenie |
|---|---|
| Konta pod MCC | `accounts.py` |
| Kampanie (ID, status, budżet) | `campaign.py list -c ID` |
| Wyniki kampanii / grup / słów / haseł / reklam | `report.py campaigns\|adgroups\|keywords\|search-terms\|ads -c ID [--days 30] [--campaign ID] [--csv plik]` |
| Hasła z kosztem i bez konwersji | `report.py search-terms -c ID --no-conversions --min-cost 5` |
| Pauza / włączenie kampanii | `campaign.py pause\|enable CAMPAIGN_ID -c ID` |
| Budżet dzienny | `campaign.py budget CAMPAIGN_ID 50 -c ID` |
| Docelowy CPA / ROAS / limit CPC | `campaign.py bid-target CAMPAIGN_ID --cpa 45 \| --roas 400 \| --cpc-ceiling 5 -c ID` |
| Lokalizacje | `locations.py Piaseczno` → `campaign.py locations CAMPAIGN_ID --add GEO_ID -c ID` |
| Grupy reklam, stawka grupy, pauza reklamy | `adgroup.py list\|pause\|enable\|bid\|ad-pause\|ad-enable` |
| Słowa kluczowe | `keywords.py add --ad-group ID "[ścisłe]" '"do wyrażenia"' -c ID` |
| Wykluczenia | `keywords.py negative --campaign ID słowo1 słowo2 --match BROAD -c ID` |
| Pauza słów | `keywords.py pause AD_GROUP_ID CRITERION_ID... -c ID` |
| Nowa kampania Search | napisz JSON wg `examples/kampania-search.json` → `create_search_campaign.py plik.json -c ID` |
| Dowolny odczyt | `query.py -c ID "SELECT ... FROM ... WHERE ..."` (GAQL) |

## Typowe analizy

- **Przegląd konta:** `report.py campaigns` → najdroższe kampanie → `report.py keywords --campaign X` → `report.py search-terms --campaign X --no-conversions`.
- **Wykluczenia:** z `search-terms --no-conversions` wybierz hasła niezwiązane z ofertą, zaproponuj listę, po zgodzie `keywords.py negative`.
- **Reklamy:** `report.py ads` — szukaj `POOR`/`AVERAGE` w kolumnie „Siła” i odrzuconych (`DISAPPROVED`).
- Kontekst firmy Qamitech (oferta, USP, ton, adresy podstron) jest w `context.md` — używaj go przy pisaniu reklam i słów.

## Limity tekstów RSA

Nagłówki: 3–15, maks. 30 znaków. Teksty: 2–4, maks. 90 znaków. Ścieżki path1/path2: maks. 15 znaków.
`create_search_campaign.py` sprawdza to przed wysłaniem.
