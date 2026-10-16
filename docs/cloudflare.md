# Przeniesienie qamitech.pl na Cloudflare — instrukcja krok po kroku

> Przygotowano: 16.10.2026. Dotyczy strony www.qamitech.pl (PHP, hosting z FTP, deploy z GitHuba).
> Nazwy przycisków w panelu Cloudflare czasem się zmieniają — jeśli czegoś nie widzisz, wpisz nazwę opcji w wyszukiwarkę u góry panelu.

## Który wariant?

| | **A. Cloudflare przed obecnym hostingiem (zalecany)** | B. Cała strona na Cloudflare Pages |
|---|---|---|
| Co się zmienia | DNS przechodzi do Cloudflare; ruch idzie przez CDN Cloudflare do obecnego serwera | Strona przestaje działać na hostingu, serwuje ją Cloudflare |
| PHP (formularze, szablony) | działa bez zmian | **nie działa** — Pages obsługuje tylko pliki statyczne i JavaScript |
| Praca do wykonania | ~1 h konfiguracji, bez zmian w kodzie | przepisanie stron na statyczny HTML, formularze na Pages Functions + zewnętrzna usługa e-mail, przekierowania adresów `.php` |
| Deploy z GitHuba | bez zmian (FTP) + automatyczne czyszczenie cache | nowy mechanizm (integracja Pages z GitHubem) |
| Korzyści | SSL, CDN (szybsze ładowanie), ochrona przed atakami, darmowy plan | jak w A + brak kosztów hostingu |

**Ta instrukcja opisuje wariant A.** Wariant B jest opisany na końcu — mogę go przygotować jako osobny projekt.

---

## Co przygotować przed startem

- [ ] Dostęp do panelu **rejestratora domeny** qamitech.pl (tam zmienia się serwery DNS — często ten sam panel co hosting, np. home.pl, nazwa.pl, cyber_Folks, OVH).
- [ ] Dostęp do panelu **hostingu** (sprawdzenie certyfikatu SSL i rekordów DNS).
- [ ] Zrzut obecnej strefy DNS — w panelu rejestratora/hostingu skopiuj lub wyeksportuj **wszystkie** rekordy (A, AAAA, CNAME, MX, TXT, SRV). To zabezpieczenie na wypadek, gdyby skan Cloudflare czegoś nie znalazł.
- [ ] Zrób przeniesienie w spokojnym momencie (np. wieczór w tygodniu). Strona działa przez cały czas, ale poczta i DNS potrzebują kilku godzin, żeby wszędzie się odświeżyć.

## Krok 1. Załóż konto i dodaj domenę

1. Wejdź na https://dash.cloudflare.com i załóż konto (najlepiej na firmowy e-mail, z włączonym logowaniem dwuskładnikowym).
2. Na stronie głównej konta wybierz **Onboard a domain** / **Add a domain**.
3. Wpisz `qamitech.pl` (bez `www`).
4. Zostaw **szybki skan rekordów DNS** (Quick scan).
5. **AI crawlers / boty AI** — jeśli kreator zapyta, czy blokować boty AI, wybierz opcję, która ich **nie blokuje** (*Do not block / Allow*). Blokada zniweczyłaby pracę nad widocznością w ChatGPT, Perplexity, Claude i Google AI (GEO/AEO).
6. Wybierz plan **Free** — w zupełności wystarczy.

## Krok 2. Sprawdź rekordy DNS (najważniejszy krok)

Cloudflare pokaże listę zaimportowanych rekordów. Porównaj ją z zrzutem z panelu hostingu i uzupełnij braki.

| Rekord | Przykład | Proxy (pomarańczowa chmurka) |
|---|---|---|
| `A` / `AAAA` dla `qamitech.pl` (lub `@`) | adres IP serwera WWW | **Proxied** (pomarańczowa) |
| `A` lub `CNAME` dla `www` | IP serwera lub `qamitech.pl` | **Proxied** (pomarańczowa) |
| `MX` (poczta) | np. `mx.hosting.pl` | zawsze **DNS only** — MX nie da się proxować |
| `A`/`CNAME` dla `mail`, `smtp`, `imap`, `pop`, `webmail`, `autodiscover` | serwer poczty | **DNS only** (szara) |
| `A`/`CNAME` dla `ftp` | serwer FTP | **DNS only** (szara) — Cloudflare przepuszcza tylko ruch WWW, FTP przez pomarańczową chmurkę nie zadziała |
| `A`/`CNAME` dla `cpanel`, `panel`, `directadmin` itp. | panel hostingu | **DNS only** (szara) |
| `TXT` — SPF (`v=spf1 …`), DKIM (`…._domainkey`), DMARC (`_dmarc`) | ochrona poczty | (TXT nie mają proxy) — **muszą być przeniesione 1:1**, inaczej maile z formularzy mogą trafiać do spamu |
| `TXT` — `google-site-verification=…` | weryfikacja Search Console | przenieś 1:1 |

> ⚠️ Rekordy poczty muszą być identyczne jak u obecnego dostawcy. Brak rekordu MX = brak poczty na `@qamitech.pl`.

## Krok 3. Zmień serwery DNS u rejestratora

1. Cloudflare pokaże dwa adresy serwerów nazw, np. `xxx.ns.cloudflare.com` i `yyy.ns.cloudflare.com`.
2. **Jeśli w domenie jest włączony DNSSEC — najpierw go wyłącz** w panelu rejestratora (inaczej po zmianie domena przestanie działać). Włączysz go ponownie w Cloudflare w kroku 7.
3. W panelu rejestratora domeny zmień serwery DNS (*serwery nazw / nameservers / delegacja*) na te dwa adresy z Cloudflare. Usuń pozostałe.
4. Wróć do Cloudflare i kliknij **Check nameservers**. Aktywacja trwa zwykle od kilkunastu minut do kilku godzin (maks. 24–48 h). Cloudflare wyśle e-mail, gdy domena będzie aktywna.

W tym czasie strona działa normalnie — część odwiedzających trafia jeszcze przez stary DNS, część już przez Cloudflare.

## Krok 4. Ustaw SSL — tryb **Full (strict)**

Strona w `.htaccess` sama przekierowuje na HTTPS. Przy trybie **Flexible** Cloudflare łączy się z serwerem przez HTTP, serwer przekierowuje na HTTPS i powstaje **pętla przekierowań** (strona przestaje działać). Dlatego:

1. W panelu hostingu upewnij się, że dla `qamitech.pl` i `www.qamitech.pl` jest **aktywny certyfikat SSL** (np. darmowy Let's Encrypt).
2. W Cloudflare: **SSL/TLS → Overview → Configure** → wybierz **Full (strict)**.
3. **SSL/TLS → Edge Certificates**:
   - **Always Use HTTPS** — włącz,
   - **Automatic HTTPS Rewrites** — włącz,
   - **Minimum TLS Version** — TLS 1.2,
   - **HSTS** — na razie **nie włączaj**; włącz po 1–2 tygodniach stabilnego działania.

> Jeśli hosting nie ma certyfikatu: w **SSL/TLS → Origin Server** wygeneruj *Origin Certificate* i zainstaluj go w panelu hostingu, a potem ustaw Full (strict).

## Krok 5. Ustawienia, które chronią SEO i widoczność w AI

| Gdzie | Ustawienie | Wartość | Dlaczego |
|---|---|---|---|
| **AI Crawl Control** (lub Security → Bots) | blokowanie botów AI | **wyłączone / Allow** dla botów wyszukiwania i asystentów (OAI-SearchBot, ChatGPT-User, PerplexityBot, Claude-SearchBot) | inaczej ChatGPT/Perplexity nie zobaczą strony |
| Security → Bots | **Block AI bots** | **Off** | j.w. |
| Security → Bots | **Managed robots.txt** (*Instruct AI bot traffic with robots.txt*) | **Off** | Cloudflare dopisałby własne reguły blokujące GPTBot/ClaudeBot przed naszym `robots.txt` |
| Security → Bots | **Bot Fight Mode** | **Off** (na początek) | potrafi utrudniać dostęp nowym, niezweryfikowanym botom AI |
| Speed → Optimization | **Rocket Loader** | **Off** | psuje skrypty motywu (animacje, przejścia stron) |
| Scrape Shield / Security settings | **Email Address Obfuscation** | **Off** | zamienia adresy e-mail w kodzie na skrypt — AI i część czytników ich wtedy nie widzi |

Po zmianie sprawdź https://www.qamitech.pl/robots.txt — musi wyglądać jak plik z repozytorium (`site/robots.txt`), bez bloku „Cloudflare Managed content”.

## Krok 6. Połącz deploy z GitHuba z Cloudflare (czyszczenie cache)

Cloudflare przechowuje kopie CSS, JS i obrazków. Bez czyszczenia cache zmiany wdrożone z GitHuba mogą być widoczne dopiero po kilku godzinach. Workflow **Deploy strony na FTP** czyści cache automatycznie, jeśli dodasz dwa sekrety.

1. **Token API:** Cloudflare → ikona profilu → **My Profile → API Tokens → Create Token → Create Custom Token**:
   - nazwa: `github-deploy-qamitech`,
   - uprawnienia: **Zone → Cache Purge → Purge**,
   - zakres: **Include → Specific zone → qamitech.pl**,
   - zapisz token (pokazuje się tylko raz).
2. **Zone ID:** Cloudflare → domena qamitech.pl → **Overview** → prawa kolumna → **Zone ID** (skopiuj).
3. GitHub → repozytorium → **Settings → Secrets and variables → Actions → Secrets**:
   - `CLOUDFLARE_API_TOKEN` = token z pkt 1,
   - `CLOUDFLARE_ZONE_ID` = Zone ID z pkt 2.
4. **Sprawdź sekret `FTP_SERVER`.** Jeśli to `qamitech.pl` albo `www.qamitech.pl`, zmień go na **nazwę serwera z panelu hostingu** (np. `serwer123456.home.pl`) albo na `ftp.qamitech.pl` z szarą chmurką (DNS only). Przez pomarańczową chmurkę FTP nie działa i deploy przestanie się łączyć.

Bez sekretów Cloudflare deploy działa jak dotąd — krok czyszczenia cache jest po prostu pomijany.

## Krok 7. Po aktywacji — lista kontrolna

- [ ] https://www.qamitech.pl i https://qamitech.pl otwierają się bez błędów; `qamitech.pl` przekierowuje na `www`.
- [ ] Brak pętli przekierowań (jeśli jest — patrz krok 4, tryb SSL).
- [ ] Kłódka w przeglądarce, certyfikat ważny.
- [ ] Formularz na stronie **Kontakt** i formularz „Zostaw numer” na stronie głównej — wyślij próbne wiadomości i sprawdź, że dotarły (także do spamu).
- [ ] Poczta `@qamitech.pl` odbiera i wysyła (wyślij maila z zewnętrznej skrzynki i odpowiedz).
- [ ] https://www.qamitech.pl/robots.txt, `/sitemap.xml`, `/llms.txt` — zgodne z repozytorium.
- [ ] Ręczny deploy próbny: GitHub → Actions → **Deploy strony na FTP** → Run workflow (z zaznaczoną próbą na sucho) — połączenie z FTP działa.
- [ ] **DNSSEC:** Cloudflare → DNS → Settings → **Enable DNSSEC** → skopiuj rekord DS i dodaj go u rejestratora.
- [ ] **Google Search Console:** dodaj usługę typu **Domena** (`qamitech.pl`) — rekord TXT doda się w Cloudflare jednym kliknięciem; wyślij `https://www.qamitech.pl/sitemap.xml`.
- [ ] Po 1–2 tygodniach: włącz **HSTS** (SSL/TLS → Edge Certificates), max-age 6 miesięcy, bez preload na start.

## Jeśli coś pójdzie nie tak (powrót)

- **Pętla przekierowań / błąd 525–526:** tryb SSL — ustaw Full (strict) i sprawdź certyfikat na hostingu; awaryjnie Full (bez strict).
- **Strona nie działa, a trzeba szybko wrócić:** w Cloudflare przy rekordach `@` i `www` przełącz chmurkę na **DNS only** (szara) — ruch idzie wtedy prosto na hosting, bez CDN.
- **Pełny powrót:** u rejestratora przywróć poprzednie serwery DNS (zapisz je przed krokiem 3).
- **Nie działa poczta:** porównaj rekordy MX, SPF, DKIM, DMARC z zrzutem z kroku „Co przygotować”.
- **Deploy nie łączy się z FTP:** sekret `FTP_SERVER` wskazuje adres za pomarańczową chmurką — patrz krok 6, pkt 4.
- **Hosting widzi adresy IP Cloudflare zamiast odwiedzających** (statystyki, logi): w panelu hostingu włącz obsługę Cloudflare / „real IP”, jeśli jest dostępna. Formularzy to nie dotyczy.

---

## Wariant B — cała strona na Cloudflare Pages (na przyszłość)

Wymaga zmian w kodzie, bo Cloudflare Pages nie wykonuje PHP:

1. **Strony → statyczny HTML.** Podczas builda (GitHub Actions lub build Cloudflare Pages) PHP generuje gotowe pliki HTML wszystkich podstron; adresy `.php` dostają przekierowania 301 w pliku `_redirects` (lub serwujemy HTML pod tymi samymi ścieżkami).
2. **Formularze → Pages Functions** (JavaScript) + zewnętrzna usługa wysyłki e-maili (np. Resend, Postmark, SendGrid — konto i klucz API).
3. **Repozytorium → Cloudflare Pages:** Workers & Pages → Create → Pages → *Connect to Git* → `KamilPiech1991/qamitech`, katalog wyjściowy z wygenerowanym HTML.
4. **Domena:** w projekcie Pages → Custom domains → `www.qamitech.pl` i `qamitech.pl`.
5. Hosting zostaje tylko dla poczty (albo poczta też przechodzi do innego dostawcy).

Szacunkowo: 1–2 dni pracy + testy. Warto rozważyć po ustabilizowaniu wariantu A.
