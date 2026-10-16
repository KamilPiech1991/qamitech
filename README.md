# qamitech
Qamitech website

- `context.md` — kontekst firmy i analiza strony www.qamitech.pl
- `site/` — pliki strony (pojawią się po pierwszym imporcie z FTP)
- `.github/workflows/` — import z FTP i automatyczny deploy
- `docs/cloudflare.md` — instrukcja przeniesienia strony za Cloudflare
- `brand/` — pliki źródłowe logo (poza stroną, nie są wysyłane na serwer)

## Połączenie z serwerem FTP

### 1. Ustaw repozytorium jako prywatne

Pliki PHP strony mogą zawierać hasła (np. SMTP do formularzy, klucz reCAPTCHA).
Settings → General → Danger Zone → **Change visibility → Private**.
Workflow importu odmówi wypchnięcia plików do publicznego repo, dopóki tego nie zrobisz.

### 2. Dodaj dane FTP

Settings → Secrets and variables → Actions:

| Zakładka | Nazwa | Przykład | Opis |
|---|---|---|---|
| Secrets | `FTP_SERVER` | `serwer123456.home.pl` | host FTP z panelu hostingu |
| Secrets | `FTP_USERNAME` | `qamitech` | login FTP |
| Secrets | `FTP_PASSWORD` | — | hasło FTP |
| Variables | `FTP_SERVER_DIR` | `/public_html/` | katalog strony na serwerze, **z ukośnikiem na końcu** |
| Variables | `FTP_PROTOCOL` | `ftps` | opcjonalnie: `ftps` (domyślnie) albo `ftp` |
| Variables | `FTP_PORT` | `21` | opcjonalnie |
| Variables | `FTP_SECURITY` | `strict` | opcjonalnie: `loose`, jeśli certyfikat serwera nie pasuje do nazwy hosta |

Najlepiej załóż w panelu hostingu osobne konto FTP ograniczone do katalogu strony.

### 3. Pobierz aktualne pliki z serwera

Actions → **Import strony z FTP** → Run workflow.
Pliki trafią na gałąź `import/ftp-<numer>`; w podsumowaniu przebiegu jest link do PR.
Przed scaleniem sprawdź listę plików oznaczonych jako „możliwe hasła”.
Pomijane są logi, kopie zapasowe, zrzuty baz (`*.sql`, `*.zip`…), `.env`, `.htpasswd`, `cgi-bin/`, `logs/`, `stats/`.

### 4. Deploy

Każdy push na `main`, który zmienia coś w `site/`, automatycznie wgrywa zmienione pliki na serwer
(workflow **Deploy strony na FTP**). Ręcznie: Actions → Deploy strony na FTP → Run workflow
(domyślnie próba na sucho — pokazuje, co zostałoby wysłane).

- Pierwszy deploy wysyła wszystkie pliki z `site/`; kolejne — tylko zmienione.
- Pliki istniejące wyłącznie na serwerze (np. config z hasłami) nie są usuwane.
- Na serwerze powstaje plik stanu `.ftp-deploy-sync-state.json`; warto zablokować do niego dostęp w `.htaccess`.
- Deploy działa w środowisku `production` — w Settings → Environments możesz dodać wymóg ręcznego zatwierdzenia.
- Gdy strona jest za Cloudflare: dodaj sekrety `CLOUDFLARE_API_TOKEN` i `CLOUDFLARE_ZONE_ID`, a deploy po wysłaniu plików wyczyści cache (szczegóły w `docs/cloudflare.md`).
