# qamitech
Qamitech website

- `context.md` — kontekst firmy i analiza strony www.qamitech.pl
- `site/` — pliki strony (pojawią się po pierwszym imporcie z FTP)
- `.github/workflows/` — import z FTP i automatyczny deploy
- `google-ads/` — skrypty do prowadzenia kampanii Google Ads z Claude Code bezpośrednio przez Google Ads API (instrukcja: [google-ads/README.md](google-ads/README.md))

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

- Pliki wysyła `lftp` (to samo narzędzie co import), więc działa z serwerami FTPS wymagającymi ponownego użycia sesji TLS.
- Pierwszy deploy wysyła wszystkie pliki z `site/`; kolejne — tylko zmienione od ostatniego wdrożenia.
  Commit ostatniego deployu zapisuje się na serwerze w pliku `.deploy-sha`. Ręcznie można wymusić pełne wysłanie (opcja „Wyślij wszystkie pliki”).
- Po wysłaniu workflow porównuje rozmiary plików na serwerze z repozytorium; przy niezgodności ponawia wysyłkę, a potem zgłasza błąd.
- Pliki istniejące wyłącznie na serwerze (np. config z hasłami) nie są usuwane. Pliki usunięte z repozytorium też zostają na serwerze.
- Deploy działa w środowisku `production` — w Settings → Environments możesz dodać wymóg ręcznego zatwierdzenia.

## Wydajność strony (PageSpeed)

- **CSS:** strona ładuje `assets/css/vendor.min.css` i `main.min.css`, budowane z `vendor.css` / `main.css`.
  Po każdej zmianie w `vendor.css` lub `main.css` uruchom build i podbij `?v=` w `site/include/header.php`:
  ```bash
  cd tools/css && npm install && npm run build
  ```
  `custom.css` nie wymaga builda — edytuj go bezpośrednio (też podbij `?v=`).
  Build usuwa z `vendor.css` nieużywane style Font Awesome i klas `.material-icons.<nazwa>`
  (ikony Material działają przez ligatury: `<i class="material-icons">phone</i>`). Gdyby w stopce wróciły
  ikony social z Font Awesome, usuń `fa` z `DEAD_SELECTOR` w `tools/css/build.mjs`.
- **JS motywu** (`vendor.js`, `components.js`) ładuje się po pierwszym wyrenderowaniu strony — patrz komentarz w `site/include/footer.php`.
- **Animacje przy przewijaniu** — `site/assets/js/scroll-animations.js` (GSAP + ScrollTrigger z `vendor.js`). Ukrywa tylko elementy leżące jeszcze pod ekranem, więc treść nie czeka na JS; przy „ogranicz ruch” w systemie animacji nie ma.
- **Hero:** blok z `<h1>` nie ma animacji wejścia (`data-arts-os-animation`), żeby był widoczny od razu. Nie dodawaj jej z powrotem.
- **Obrazki ładowane leniwie** (`data-src`) mają w `src` przezroczysty GIF w `data:` — nie wpisuj tam `#`, bo przeglądarka pobiera wtedy całą stronę jeszcze raz.
- **Fonty:** Noir Pro w WOFF2 ograniczonym do znaków łacińskich (`*-latin.woff2`) z `font-display: swap`.
- **`.htaccess`:** kompresja gzip i cache przeglądarki (CSS/JS/obrazki 1 miesiąc, fonty 1 rok).

## Realizacje (case study)

- Lista `site/realizacje/index.php` i podstrony `site/realizacje/<slug>.php` biorą treści z `site/realizacje/data.php` (kolejność w tablicy = kolejność na liście).
- Szablon podstrony: `site/part/case-study.php`. Zrzuty: `site/assets/img/realizacje/<slug>/` (`hero.webp` 1200×750, `shot-N.webp` 1200×750, `mobile.webp` 390×844, `thumb.webp` 860×600).
- Nowa realizacja: dopisz wpis w `data.php`, dodaj folder ze zrzutami i plik `<slug>.php` (3 linie, jak pozostałe), a adres dopisz do `sitemap.xml`.
- `'page' => false` — realizacja tylko na liście, bez podstrony i bez linku (np. strona klienta przestała działać).
