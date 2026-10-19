# Paw Manager – pełna analiza konkurencyjna i plan budowy własnej aplikacji (mobile + web)

> **Data analizy:** 19.10.2026
> **Źródła:** paw-manager.com (strona główna PL/EN + 7 podstron „Poradnik hodowcy”), regulamin, polityka prywatności, panel webowy app.paw-manager.com (kod HTML), wpis w Google Play (com.pawmanager.app), Capterra, KRS (bizraport), ok. 40 makiet ekranów aplikacji opublikowanych na stronie. Facebook (@PawManagerPL) niedostępny do automatycznego odczytu – dane z wyników wyszukiwania.
> **Zasada:** fakty pochodzą ze źródeł. Wnioski i interpretacje są oznaczone jako **[wniosek]**.
> **Nazwa robocza naszego produktu:** **Kennelo** (do zmiany – patrz sekcja 17).

---

## 0. Streszczenie (TL;DR)

1. **Paw Manager** to młody (spółka z o.o. zarejestrowana 11.06.2026, kapitał 5 000 zł, jeden udziałowiec/prezes) polski produkt dla hodowców i właścicieli psów. Android (500+ pobrań, ostatnia aktualizacja 16.09.2026) + **panel webowy app.paw-manager.com** (Next.js) z synchronizacją „te same dane na telefonie i komputerze”. **Brak wersji iOS.**
2. Produkt jest **już dość kompletny funkcjonalnie**: psy, zdrowie, rozród z kalendarzem ciąży, krycia reproduktora, mioty, szczenięta z wagami i checklistą, Paw ID (karta + QR transferu szczenięcia), cyfrowa wyprawka, wystawy/championaty, finanse, raporty PDF, przypomnienia, backup w chmurze (Firebase). Dwa moduły: **Właściciel** i **Hodowca**. Plan FREE z limitami i PRO (99 zł/rok lub 13,99 zł/mies.).
3. Ich słabe punkty **[wniosek]**: brak iOS, brak współdzielenia hodowli między osobami, brak rodowodów/drzewa genealogicznego, tylko wydatki (bez przychodów i rentowności miotu), brak dokumentów/umów, brak publicznej strony hodowli, mała skala (68 obserwujących na FB, 0 recenzji na Capterra), małe zasoby (1 osoba w KRS), marketing oparty na SEO blogowym.
4. **Jak być przed nimi:** uruchomić w jednym cyklu **Web + Android + iOS z jednej bazy kodu**, dodać to, czego oni nie mają (współpraca w hodowli, rodowody/drzewo i COI, przychody i rentowność miotu, umowy i dokumenty PDF, portal nabywcy szczenięcia, powiadomienia push, EN/DE, asystent AI), i wejść z agresywniejszym planem FREE.
5. **Co już jest zrobione:** w katalogu `app/` powstał działający **prototyp aplikacji webowej** (React + TypeScript + Vite, dane lokalne w przeglądarce) pokrywający wszystkie moduły Paw Managera: psy, zdrowie, rozród + kalendarz ciąży, krycia, mioty, szczenięta, wagi, analiza miotu, checklista, Paw ID z QR, wyprawka, wystawy, championaty, finanse, raporty do PDF, przypomnienia, plan FREE/PRO, backup JSON, dwa moduły. Ta sama baza kodu jest przygotowana pod opakowanie w aplikację mobilną (Capacitor) – patrz sekcje 11–12 i 16.

---

## 1. Profil konkurenta

| | |
|---|---|
| **Produkt** | Paw Manager – „aplikacja dla hodowców psów i właścicieli” / „dziennik Twojego psa” |
| **Firma** | PAW MANAGER SP. Z O.O., KRS 0001236985, NIP 1251810702, REGON 544991860 |
| **Rejestracja** | 11.06.2026, kapitał zakładowy 5 000 PLN, PKD 62.01.Z |
| **Zarząd / udziałowcy** | Dariusz Misiak – prezes zarządu, 99 % udziałów (jednoosobowo) |
| **Adres** | ul. Spacerowa 90A, 05-270 Marki |
| **Kontakt** | kontakt@paw-manager.pl, contact@paw-manager.com, +48 510 116 232 |
| **Domeny** | paw-manager.com (WordPress + Elementor + AIOSEO, motyw Neve), paw-manager.pl (przekierowanie), app.paw-manager.com (Next.js) |
| **Platformy** | Android (Google Play, id `com.pawmanager.app`, kategoria Styl życia, „500+” pobrań, zakupy w aplikacji), Web (panel). iOS: **brak** |
| **Wersja / aktualizacje** | ostatnia aktualizacja 16.09.2026 („drobne błędy i stabilność”); strona WWW opublikowana 18.04.2026, poradnik 14–17.09.2026 |
| **Języki** | polski, angielski (Capterra); strona ma wersję EN z cenami w EUR |
| **Social** | Facebook @PawManagerPL – 68 obserwujących; posty w grupach hodowlanych; rekomendacja hodowli Kadachi FCI |
| **Opinie** | Capterra: 0 recenzji; Google Play: brak widocznej oceny (za mało ocen) |
| **Data Safety (Play)** | zbiera: lokalizacja; dane szyfrowane w tranzycie; można żądać usunięcia |

**[wniosek]** To projekt jednoosobowy/mikrozespół na bardzo wczesnym etapie (ok. 4 miesiące od rejestracji spółki, ok. pół roku obecności w sieci). Produkt ma dużą szerokość funkcji, ale małą skalę i małą „poduszkę” zasobową – okno na wyprzedzenie jest teraz.

---

## 2. Pozycjonowanie, grupa docelowa i komunikacja

**Hasła:** „Asystent w opiece nad Twoim pupilem”, „Zarządzaj hodowlą i psami. Rozwijaj pasję.”, „Porządek zamiast chaosu”, „Zdrowie pod kontrolą”, „Finanse bez zgadywania”, „Wystawy i tytuły pod ręką”, „Pełna historia psa w jednej aplikacji”.

**Dwie persony (dwa moduły w aplikacji i panelu):**
- **Właściciel** – dane psa, zdrowie, finanse, codzienna opieka, odbiór Paw ID od hodowcy.
- **Hodowca** (główna persona, cały marketing) – psy, mioty, rozród, szczenięta, finanse, hodowla, wystawy, raporty.

**Komunikacja/marketing:**
- Strona główna = jedna długa landing page z makietami telefonów i cennikiem; CTA wyłącznie „Pobierz z Google Play”.
- **SEO content**: 7 artykułów poradnikowych pod frazy: „ciąża suki tydzień po tygodniu”, „miot szczeniąt”, „dokumentacja hodowli psów”, „wyniki wystaw psów”, „krycie psa ewidencja kryć”, „odbiór szczeniaka od hodowcy”, „wydatki hodowli psów”. Każdy artykuł to opis funkcji wpleciony w poradnik + CTA.
- Ton: ciepły, „psiarski”, fiolet jako kolor marki, zdjęcia psów, makiety ekranów.
- Trust: „Darmowa na zawsze, bez karty”, „dane lokalnie + kopia w chmurze”, RODO.

**[wniosek]** Ich kanał akwizycji to SEO + grupy FB hodowców. Nie widać płatnych kampanii ani programu poleceń. Łatwo ich przebić treścią (więcej tematów, kalkulatory online, narzędzia SEO) i obecnością na iOS.

---

## 3. Model biznesowy i cennik

| Plan | Cena PL | Cena EN | Zakres |
|---|---|---|---|
| **FREE** | 0 zł, bez limitu czasu, bez karty | 0 | do **2 suk** i **2 psów**, do **5 wystaw**, do **6 championatów**, wykres wydatków tylko **4 z 6 miesięcy** |
| **PRO** | **99 zł/rok** (8,25 zł/mies.) lub **13,99 zł/mies.** | **45 EUR/rok** lub **4,99 EUR/mies.** | bez limitów psów/miotów/wystaw/championatów, pełny wykres, „wszystkie obecne i przyszłe funkcje”, (EN) także: nielimitowane powiadomienia i wydatki, kalendarz ciąży, wagi szczeniąt, zdrowie, Paw ID i QR, cyfrowa wyprawka, synchronizacja w chmurze |

- Płatności wyłącznie przez **Google Play** (subskrypcja auto-odnawialna). Regulamin wspomina o „trybie gościa” (offline, osobna baza) i o wersji „rozszerzonej dla zarejestrowanych”.
- **[wniosek]** Rozbieżność PL/EN sugeruje, że w PL moduły hodowlane są dostępne w FREE (limity ilościowe), a w EN gating jest szerszy – cennik wciąż „w ruchu”. Niska cena (99 zł/rok) = produkt „impulsowy”; nasza strategia cenowa powinna celować w podobny poziom z silniejszym FREE (np. 3 psy + 1 miot) i planem „Hodowla PRO” z funkcjami zespołowymi.

---

## 4. Architektura informacji aplikacji mobilnej (odtworzona z makiet)

**Dolna nawigacja (5 pozycji):** Start · Finanse · **Szybki dostęp** (środkowy, wyróżniony przycisk z łapą) · Raporty · Ustawienia.

**Start (Dashboard):** nagłówek „HODOWLA / nazwa hodowli / numer hodowli / WNI”, przycisk Wyloguj, powitanie „Michał, co porabiasz? Psy śpią czy wariują?”, zdjęcie, karta **Powiadomienia** (najbliższe wydarzenia), **Twoje psy** (kafle: Moje suki = 1, Moje psy = 1), kafel **Kariera**, dalej kafle modułów.

**Szybki dostęp (menu modułów):** Moje psy, Moje mioty, Rozród, Kariera, Zdrowie, Finanse, Raporty, Kalendarz, Przypomnienia, Kopie zapasowe, Zdjęcia, Statystyki (ikony kategorii ze strony: Zdrowie, Wystawy, Finanse, Rozród, Raporty, Kalendarz, Przypomnienia, Kopie zapasowe, Zdjęcia, Statystyki).

**Hierarchia ekranów (nawigacja wgłąb):**
```
Moje psy (widok pełny / kompaktowy) → Pies
   ├─ Metryka (dane podstawowe / rodzice / identyfikacja)
   ├─ Zdrowie (szczepienia, odrobaczenia, profilaktyka, zabiegi, badania)
   ├─ Krycia (reproduktor) → Dodaj krycie
   ├─ Rozród (suka) → Skojarzenia → Kalendarz ciąży
   ├─ Kariera → Wystawy / Championaty / Statystyki → Dodaj wystawę → Koszty wystawy
   ├─ Dieta / Waga
   └─ Oś czasu (pełna historia zdrowia, rozrodu, diety, wystaw i miotów)
Moje mioty → Metryka miotu
   ├─ Twoje szczenięta (karty) → Metryka szczenięcia / Wagi / Karta Paw ID
   │      ├─ Cena i notatki (prywatne)
   │      └─ Dane właściciela (1–2 właścicieli, data przekazania)
   ├─ Odrobaczenia i szczepienia (per szczenię, kopiowanie na cały miot)
   ├─ Opieka nad miotem (checklista 17 etapów, % ukończenia)
   ├─ Notatki do miotu
   ├─ Analiza miotu (liczby, najcięższe/najlżejsze, zmiany, wykres zbiorczy)
   └─ Cyfrowa wyprawka (wspólne dla miotu + indywidualne)
Finanse → Budżet hodowli / Dodaj wydatek / Historia wydatków / Statystyki finansowe
Raporty → lista raportów (PDF)
Ustawienia → konto, moduł (Owner/Breeder), subskrypcja, kopie zapasowe, usuń konto
```

Panel webowy: ekran wyboru modułu (Właściciel / Hodowca) → logowanie → te same dane co w aplikacji.

---

## 5. Szczegółowy inwentarz funkcji (ekran po ekranie, z polami)

### 5.1 Konto, tryby i moduły
- Logowanie e-mail (Firebase Authentication), **tryb gościa** (osobna lokalna baza, limity), konto zarejestrowane, PRO.
- Wybór modułu **Właściciel / Hodowca** przed logowaniem; zmiana w ustawieniach.
- Usuwanie konta z poziomu aplikacji (wymóg Google Play) + strona delete-account.

### 5.2 Moje psy / Metryka psa
- Lista: zdjęcie, imię domowe, (nazwa rodowodowa), rasa, wiek „4 lata, 9 miesięcy i 4 dni”, skróty: Zdrowie · Krycia · Kariera · Dieta, kafel „Oś czasu”. Przełącznik **Widok pełny / Widok kompaktowy**. FAB „+” i przycisk skanera QR.
- Metryka – **Dane podstawowe:** Rasa, Data urodzenia, Umaszczenie, Waga, Płeć, Kastrowany. **Rodzice:** Ojciec, Matka. **Identyfikacja:** Nr rodowodu, Numer rejestracji oddziałowej, Nr chip. Z poradnika dodatkowo: nazwa rodowodowa, dane hodowli.

### 5.3 Zdrowie
- Kategorie: **Szczepienia**, **Odrobaczenia**, **Profilaktyka pasożytnicza** (np. Bravecto), **Wizyty i zabiegi**, **Badania i wyniki badań**; przy każdym: nazwa/preparat, data, następny termin → automatyczne przypomnienie, lekarz, wynik, notatki.

### 5.4 Rozród (suka) – „Skojarzenia”
- Karta skojarzenia: „Skojarzenie z [reproduktor] (hodowla)”, Data rozpoczęcia cieczki, sekcja **Krycia** (Rodzaj krycia: naturalne / inseminacja, Data krycia, Czy było zakleszczenie; „Dodaj kolejne krycie”), sekcje rozwijane **Badania USG**, **Progesteron**, **Badania RTG**; przyciski Usuń / Edytuj; kafel „Kalendarz ciąży – termin porodu i rozwój dzień po dniu”.

### 5.5 Kalendarz ciąży (kluczowa funkcja SEO)
- **Podstawa obliczeń:** zapisane skojarzenie (Krycie: data, Reproduktor) + „Zmień datę krycia”.
- Karta: „21. dzień ciąży / 3. tydzień”, pasek postępu Krycie → 63. dzień, **Przewidywany termin porodu** (= krycie + 62 dni, „63. dzień od pierwszego krycia”), „Do terminu pozostało N dni”.
- **Najważniejsze terminy:** Orientacyjny czas na USG: dni 25–30; Orientacyjny czas na RTG: od 45. dnia; Początek obserwacji porodu: 58. dzień; Orientacyjny przedział porodu: 58.–68. dzień.
- **Tygodnie 1–9** – każdy z kartami: „Rozwój szczeniąt”, „Co dzieje się z suką?”, „Wskazówki dla hodowcy” (np. tydz. 2 „Wędrówka zarodków, dni 8–14”, tydz. 9 „Poród jest coraz bliżej, dni 57–68”).
- **Oś ciąży** (timeline): Krycie (1. dzień) → Zalecany czas na USG (25.) → RTG (45.) → Początek obserwacji porodu (58.) → Przewidywany termin porodu (63.). Można **zaznaczyć wykonane badanie i zapisać datę**.

### 5.6 Krycia (pies reproduktor)
- Lista „Historia kryć”: Suka, Właściciel, Liczba szczeniąt, Rodzaj krycia, Czy było zakleszczenie, Miejsce krycia (w hodowli / zewnętrzne), Data krycia 1, Data krycia 2.
- Formularz „Dodaj krycie”: Miejsce krycia*, Imię suki*, Imię właściciela*, Nazwisko właściciela*, Liczba szczeniąt, Rodzaj krycia*, Data krycia (wiele), notatki.

### 5.7 Mioty
- Lista „Moje mioty”: oznaczenie (D, B, C, P…), Ojciec, Matka, Liczba szczeniąt; FAB „+”.
- **Metryka miotu:** nagłówek, „Twoje szczenięta”, karty szczeniąt z kolorowym paskiem = **kolor znacznika** (obróżki), płeć, data i godzina ur., ostatnia waga + zmiana („225 g ↑ +10 g”), przyciski **Metryka / Wagi / Karta Paw ID**, rozwijane **Cena i notatki** oraz **Dane właściciela** (imię i nazwisko, adres, e-mail, telefon, data przekazania; „+ Właściciel 2”, Usuń, Edytuj).
- **Odrobaczenia i szczepienia** szczeniąt: wpisy per szczenię („Blue Boy – liczba wpisów: 1”), kopiowanie wpisu do pozostałych szczeniąt.
- **Opieka nad miotem**: checklista „9 z 17 etapów ukończonych, 52 %”, grupy np. „Profilaktyka i dokumentacja”: Pierwsze/Drugie/Trzecie odrobaczenie, Pierwsze/Drugie/Trzecie szczepienie, Chipowanie, Przegląd miotu… (17 pozycji łącznie).
- **Notatki do miotu** (licznik).
- **Analiza miotu**: „Miot w liczbach” (szczenięta / psy / suki), „Najcięższe i najlżejsze szczenię” (ostatni pomiar), „Szczenięta bez pomiaru masy: 2”, „Zmiana od poprzedniego pomiaru” (największy wzrost +19 g), **Wykres wag szczeniąt** (wiele linii w kolorach znaczników, legenda przełączająca widoczność).

### 5.8 Metryka szczenięcia i wagi
- Dane podstawowe: Imię, Data urodzenia (z godziną), Płeć, Umaszczenie, Waga ur. (g), Status urodzenia (Żywy…). Rodzice: Ojciec, Matka. Dane identyfikacyjne: Numer rodowodu, Numer czip, Kolor znacznika.
- **Pomiary wagi**: wykres „Historia pomiarów”, lista (246 g · 2026-07-29 · 03:00), „Pokaż więcej”, FAB „+”, menu „⋮” edycja/usuń.

### 5.9 Paw ID (USP konkurenta)
- **Karta Paw ID** (fioletowa karta): Karta szczeniaka, Imię, Nazwa miotu, Rasa, Data i godzina ur., Płeć, Umaszczenie, Waga ur., Ojciec, Matka, Numer rodowodu, Numer chipa, Szczepienia (nazwa + data), Odrobaczenia (nazwa + data), **PAW ID „PAW-P-001”**, Kolor znacznika. „Dotknij kartę, aby wyświetlić kod QR”.
- **Kod QR**: „Zeskanuj w aplikacji Paw Manager właściciela szczeniaka. Kod przeniesie dane szczeniaka, historię wag, szczepienia, odrobaczenia oraz cyfrową wyprawkę do aplikacji nowego właściciela. Chip: … Powered by Paw Manager”.
- Po stronie właściciela: skan → import danych + rodzice + historia → nadanie **imienia domowego** → dalsza dokumentacja jako własny pies. **Nie przekazuje:** ceny, prywatnych notatek, danych właścicieli.
- **[wniosek]** QR koduje dane bezpośrednio albo token do backendu – przy ilości danych (wagi, wyprawka) to prawdopodobnie **token/link do Firebase**, nie pełny payload. W prototypie zakodowaliśmy pełny payload (działa offline); produkcyjnie zalecany token + pobranie z backendu (mniejszy QR, możliwość unieważnienia, RODO).

### 5.10 Cyfrowa wyprawka
- **Informacje wspólne dla miotu:** Żywienie (Producent karmy, Nazwa karmy, Porcja, Liczba posiłków dziennie 2/3/4/5, Godziny karmienia), Suplementacja, Pielęgnacja, Pierwsze dni w nowym domu („Z czym szczenięta są już oswojone?”: Dzieci, Inne psy, Koty, Klatka kennelowa, Jazda samochodem, Zostawanie samemu, Smycz/obroża, Zabiegi pielęgnacyjne, Domowe dźwięki).
- **Informacje o szczeniętach** (indywidualne): **Charakter** – tagi: Spokojny, Energiczny, Ciekawski, Odważny, Ostrożny, Towarzyski, Przytulaśny, Niezależny, Wrażliwy, Pewny siebie, Lubi zabawę, Łakomczuch, Lubi ludzi, Obserwator; „Kilka słów o tym szczenięciu” (tekst).

### 5.11 Kariera (wystawy i championaty)
- Ekran „Kariera [nazwa psa]”: banner, zakładki **Championaty / Wystawy**, filtry Rok / Miesiąc.
- Karta wystawy: Kraj, Miejscowość, Ranga (np. Wystawa Międzynarodowa, Wystawa Championów), Nr katalogowy, Data, Klasa, Lokata, Ocena, Sędzia, Tytuły (BOB), Certyfikaty (Res. CACIB), **Łączny koszt**, przyciski **„Opublikuj na Facebooku”** i **„Koszty wystawy”**.
- Formularz „Dodaj wystawę”: Dane podstawowe (Kraj*, Miejscowość*, Ranga wystawy*, Data wystawy*), Szczegóły (Klasa*…), Certyfikaty, tytuły zależne od kategorii wiekowej psa.
- Championaty: kafle z flagą kraju + tytuł (Litwa Champion, Polska Champion, International Champion, Junior Int. Champion), „+ Dodaj championat”.
- Statystyki: Wystawy / Certyfikaty / Titles (liczniki).

### 5.12 Finanse
- **Budżet hodowli:** banner, „Suma wprowadzonych wydatków 6 530,00 zł – Wydatki na hodowlę + wystawy · PLN”, kafle „Wydatki na wystawy” i „Wydatki na hodowlę” (bieżący miesiąc), Szybkie akcje (Dodaj wydatek na hodowlę / Historia), **Statystyki finansowe** (zakładki Poprzedni miesiąc / Ostatnie 6 miesięcy / Bieżący rok: Największy wydatek, Licznik wpisów, Najwięcej wydajesz na [kategoria] – % całości, Średnio miesięcznie wydajesz na psy), **wykres słupkowy 6 miesięcy** z przełącznikiem „Bez kosztów wystaw / Uwzględniaj koszty wystaw”, „Ostatnie dodane wydatki”.
- **Dodaj wydatek:** Kategoria (Karma i żywienie, Suplementy, Grooming i higiena, Usługa weterynaryjna, Sprzęt i akcesoria, Opłaty/Zgłoszenia, Inne), Typ wydatku (np. Karma sucha), Data*, Kwota, Opis.
- **Historia wydatków:** „Wydatki na wystawy” grupowane per wystawa (Polska • Warszawa, 2026-09-12 • Suma 780 zł • Pozycji: 3 → Paliwo/dojazd, Wyżywienie na miejscu, Zgłoszenia psów), „Wydatki na hodowlę” grupowane rok → miesiąc → pozycje; filtry Rok/Miesiąc.
- **Brak przychodów** w UI (polityka prywatności wspomina „wydatki, przychody, budżet” – **[wniosek]** planowane lub szczątkowe).

### 5.13 Raporty
- Ekran „Raporty”: banner, sekcje **Psy i mioty** (Spis psów – raport z bazy psów; Spis miotów; Szczenięta – lista szczeniąt w hodowli), **Zdrowie** (Szczepienia: psów / suk / zbiorczy psów i suk; Profilaktyka pasożytnicza: psów / suk / zbiorczy; Zabiegi – wizyty, zabiegi i zestawienia PDF; Badania i wyniki badań), każdy z przyciskiem **PDF**.
- Przykład PDF „RAPORT SZCZENIĄT”: nagłówek z nazwą i numerem hodowli, logo, data; per miot (ojciec, matka, liczba) i per szczenię: płeć, data, umaszczenie, waga ur., rodowód, chip, matka/ojciec + tabela pomiarów wagi.

### 5.14 Przypomnienia, kalendarz, powiadomienia
- „Automatyczne przypomnienia” o szczepieniach/odrobaczeniach/badaniach (z pola „następny termin”), kafel Powiadomienia na Start, osobne moduły Kalendarz i Przypomnienia w Szybkim dostępie. Push: niepotwierdzone w źródłach.

### 5.15 Dane, backup, bezpieczeństwo (z polityki prywatności i regulaminu)
- Dane zapisywane **lokalnie w szyfrowanej bazie**, osobna baza na użytkownika i dla gościa.
- **Kopie zapasowe w Firebase Storage** (prywatna przestrzeń, Firebase Security Rules), automatyczne + ręczne przywracanie.
- Firebase Authentication (e-mail), Google Cloud; transfer poza EOG (SCC).
- Zdjęcia psów (moduł „Zdjęcia”).

### 5.16 Panel webowy (app.paw-manager.com)
- Next.js (App Router), Tailwind, ikony lucide, fonty Geist; motyw fioletowy (#6F4DBF…#7048E8). Ekran wyboru modułu → logowanie. Wszystkie inne trasy za logowaniem (mapa witryny zwróciła 1 URL).
- **[wniosek]** To nowy element (Capterra: „dostępna na Androidzie oraz w wersji przeglądarkowej, z synchronizacją”). Konkurent już „ma web”, więc samo zrobienie web nie wystarczy – przewagą musi być iOS + funkcje + jakość.

---

## 6. Model danych konkurenta (odtworzony)

| Encja | Kluczowe pola |
|---|---|
| **Hodowla/Profil** | nazwa hodowli, numer hodowli, WNI, imię użytkownika, e-mail, moduł (owner/breeder), plan |
| **Pies** | imię domowe, nazwa rodowodowa, rasa, płeć, data ur., umaszczenie, waga, kastrowany, ojciec, matka, nr rodowodu, nr rejestracji oddziałowej, nr chip, hodowla, zdjęcie |
| **Wpis zdrowotny** | typ (szczepienie / odrobaczenie / profilaktyka / zabieg / badanie), nazwa, data, następny termin, lekarz, wynik, notatki; relacja pies lub szczenię |
| **Skojarzenie (suka)** | reproduktor, data cieczki, krycia[] (data, rodzaj, zakleszczenie), progesteron[], USG[], RTG[], miot |
| **Krycie (reproduktor)** | suka, właściciel (imię, nazwisko), miejsce, rodzaj, zakleszczenie, daty[], liczba szczeniąt |
| **Miot** | oznaczenie, data ur., matka, ojciec, liczba szczeniąt, checklista[17], notatki[], wyprawka wspólna |
| **Szczenię** | imię, płeć, data+godzina ur., umaszczenie, waga ur., status ur., kolor znacznika, nr rodowodu, nr chip, Paw ID, cena, notatki prywatne, właściciele[≤2], data przekazania, charakter[], opis |
| **Pomiar wagi** | data+godzina, gramy; relacja szczenię (lub pies) |
| **Wystawa** | pies, kraj, miejscowość, ranga, data, nr katalogowy, klasa, lokata, ocena, sędzia, tytuły, certyfikaty, koszty[] |
| **Championat** | pies, kraj, tytuł |
| **Wydatek** | data, kwota, zakres (hodowla / wystawa), kategoria, typ, opis, pies, wystawa |
| **Przypomnienie** | tytuł, data, pies, status |
| **Backup** | plik w Firebase Storage per użytkownik |

---

## 7. Stack technologiczny konkurenta – co wiemy i czego nie

| Warstwa | Fakty | [wniosek] |
|---|---|---|
| Mobile | Android, Google Play Billing, zrzuty z systemowym UI Androida | Technologia nieznana (brak APK w katalogach zewnętrznych). Styl UI (karty, FAB, dolna nawigacja z wyróżnionym środkiem) pasuje zarówno do Flutter, jak i natywnego Androida. Brak iOS po pół roku sugeruje kod natywny Android lub brak zasobów na publikację w App Store |
| Dane | lokalna szyfrowana baza; osobna baza gościa | SQLite/Room + SQLCipher lub Realm; model local-first |
| Chmura | Firebase Auth, Firebase Storage (backupy), GCP | backup = plik zrzutu bazy; sync web↔mobile prawdopodobnie przez Firestore/Storage dodany później |
| Web | Next.js, Tailwind, lucide, Geist | panel SPA/SSR na Vercel lub podobnym |
| WWW | WordPress 7.1 + Elementor 4 + AIOSEO | standardowy landing |

---

## 8. Ocena: mocne strony, słabe strony, luki

**Mocne strony Paw Managera**
- Szeroki, spójny zakres dla hodowcy (od krycia po przekazanie szczenięcia) – „one stop shop”.
- Paw ID + cyfrowa wyprawka – wyróżnik emocjonalny i wiralowy (nowy właściciel instaluje aplikację).
- Kalendarz ciąży z treścią merytoryczną (dobre SEO i wartość praktyczna).
- Dobre teksty poradnikowe, trust (RODO, lokalne dane), niski próg wejścia (FREE bez karty).
- Dwa moduły (Owner/Breeder) – pokrycie całego rynku psiarzy.

**Słabe strony / luki [wniosek]**
1. **Brak iOS** – w Polsce ~25–30 % smartfonów, a wśród hodowców wystawowych/premium odsetek iPhone'ów jest wyższy.
2. **Jednoosobowe konto hodowli** – brak współdzielenia z partnerem/rodziną/współwłaścicielem psa.
3. **Brak rodowodów/drzewa genealogicznego, COI (inbreeding), planowania skojarzeń.**
4. **Finanse tylko kosztowe** – brak przychodów ze sprzedaży szczeniąt/kryć, brak rentowności miotu, brak eksportu do księgowości.
5. **Brak dokumentów** – umowa sprzedaży szczenięcia, protokół przekazania, karta miotu do oddziału ZKwP – generowanie PDF z danych byłoby naturalne.
6. **Brak publicznej strony hodowli / ogłoszeń „szczenięta dostępne”** i portalu dla nabywców (poza Paw ID).
7. **Brak kalendarza cieczek i przewidywania kolejnej cieczki**, brak dziennika porodu (godziny, kolejność, komplikacje).
8. **Brak norm wagowych per rasa** / porównania przyrostów z krzywą referencyjną.
9. Brak wielojęzyczności poza PL/EN; brak integracji (ZKwP, FCI, kalendarz Google, eksport CSV).
10. Mała skala i zasoby: 500+ pobrań, 68 obserwujących, 1 osoba w KRS, 0 recenzji – ograniczone tempo rozwoju.
11. UX: bardzo długie ekrany z wieloma sekcjami rozwijanymi; brak trybu ciemnego (nie widać), brak wyszukiwarki.
12. Marketingowo: tylko Google Play w CTA, brak App Store, brak referencji/ocen, brak programu poleceń.

---

## 9. Strategia „być przed nimi”

**Zasada 1 – parytet funkcji w 1. wydaniu** (wszystko z sekcji 5, bez wyjątku) – żeby nikt nie miał powodu zostać u nich.
**Zasada 2 – trzy platformy od dnia 1:** Web (PWA) + Android + iOS z jednej bazy kodu. Konkurent nie ma iOS – to natychmiastowy, obiektywny argument sprzedażowy.
**Zasada 3 – 6 wyróżników, których oni nie mają:**

| # | Wyróżnik | Dlaczego wygrywa |
|---|---|---|
| 1 | **Hodowla wieloosobowa** (role: właściciel, współpracownik, weterynarz tylko-odczyt) | hodowle prowadzą rodziny/współwłaściciele; blokada migracji do konkurenta |
| 2 | **Rodowód i drzewo genealogiczne + COI** + planowanie skojarzeń (symulacja miotu) | realna wartość hodowlana, wysoka retencja |
| 3 | **Przychody i rentowność miotu** (sprzedaż szczeniąt, krycia, zaliczki), eksport CSV/księgowość | „ile naprawdę zarabia hodowla” |
| 4 | **Dokumenty PDF**: umowa sprzedaży, protokół odbioru, karta miotu, karta szczepień, oferta szczenięcia | oszczędza godziny pracy przy każdym miocie |
| 5 | **Portal nabywcy** (link/QR → strona szczenięcia z aktualizacjami wagi, zdjęciami, odliczaniem do odbioru) + Paw ID | wirusowość: każdy nabywca = nowy użytkownik |
| 6 | **Asystent AI** (Claude): opis szczenięcia do ogłoszenia, odpowiedzi „kiedy USG?”, analiza przyrostów vs rasa, OCR książeczki zdrowia / wyników badań | efekt „wow”, trudne do skopiowania szybko |

**Plus:** push-notyfikacje, kalendarz cieczek i przewidywanie, dziennik porodu, normy wagowe ras, PL/EN/DE/CZ, tryb ciemny, wyszukiwarka, import z arkusza/CSV i **import z Paw ID** (ich kod QR – jeśli odczytywalny – można zaimportować, obniżając koszt przejścia).

**Cennik (propozycja):** FREE – 3 psy, 1 aktywny miot, wszystkie moduły, raporty z znakiem wodnym; **PRO 89 zł/rok lub 12,99 zł/mies.** (lekko pod konkurencją) – bez limitów, PDF, sync, portal nabywcy; **Hodowla+ 149 zł/rok** – wielu użytkowników, drzewo/COI, AI, strona hodowli. Pierwszy rok: PRO za 1 zł dla hodowli migrujących z innych aplikacji (import).

**Go-to-market:** App Store + Google Play + web; SEO (zrobić 20 artykułów na frazy, które oni dopiero zajmują + kalkulatory online: termin porodu, wiek psa, dawkowanie); grupy FB, kluby ras, współpraca z oddziałami ZKwP i lekarzami rozrodu; program poleceń „hodowca → nabywca”.

---

## 10. Ryzyka prawne i etyczne klonowania

- **Nie kopiować** nazwy, logo, grafik, tekstów, makiet ani nazwy „Paw ID” (budować własny branding; regulamin PM zastrzega prawa do interfejsu i grafik). Funkcjonalność i układ typu „lista → karta → zakładki” nie podlegają ochronie, ale 1:1 kopiowanie wyglądu to ryzyko nieuczciwej konkurencji.
- Własne teksty merytoryczne (kalendarz ciąży, checklisty) – w prototypie napisane od nowa.
- RODO: dane nabywców szczeniąt, lekarzy, lokalizacja – minimalizacja, region EU, DPA z dostawcą.
- Zastrzeżenie medyczne i finansowe w regulaminie (jak u konkurenta).

---

## 11. Rekomendowana architektura i stack

### 11.1 Wybór technologii

| Opcja | Plusy | Minusy | Werdykt |
|---|---|---|---|
| **A. React + TypeScript (PWA) + Capacitor** (Android/iOS) | jedna baza kodu web+mobile, zespół webowy (Qamitech) od razu produktywny, szybki time-to-market, pełny dostęp do natywnych API przez pluginy (kamera/QR, push, IAP), prototyp już istnieje | UI nie w 100 % natywne (dobrze zrobiony PWA jest nieodróżnialny dla tej klasy aplikacji) | **Rekomendowana** |
| B. Flutter | wydajne natywne UI na 3 platformy | nowy język (Dart), web Fluttera słabszy pod SEO i dostępność, prototyp do przepisania | alternatywa, jeśli zespół zna Dart |
| C. React Native (Expo) + osobny web | dobre UI mobilne | dwie bazy kodu (RN web jest ograniczony), wolniej | nie |

### 11.2 Architektura docelowa
```
[Web PWA / Android / iOS – ten sam kod React+TS]
   │ local-first: IndexedDB (Dexie) – pełna praca offline
   │ sync engine: kolejka zmian (outbox) + znaczniki czasu, rozwiązywanie konfliktów „ostatni wygrywa” per pole
   ▼
[Supabase (EU, Frankfurt)]  Postgres + RLS (izolacja per hodowla) · Auth (e-mail, Google, Apple) · Storage (zdjęcia, PDF, backupy) · Realtime · Edge Functions
   ├─ Paw ID: tabela transferów (token QR → paczka danych, jednorazowy, wygasający)
   ├─ Portal nabywcy: publiczne, podpisane linki do strony szczenięcia
   ├─ Push: FCM (Android/web) + APNs (iOS) przez Capacitor Push
   ├─ Płatności: RevenueCat (Google Play Billing + App Store) + Stripe (web); webhook → tabela subskrypcji
   ├─ PDF: generowanie po stronie klienta (pdfmake/react-pdf) lub Edge Function (puppeteer) dla raportów zbiorczych
   ├─ AI: Edge Function → Claude API (opisy, analiza wag, OCR dokumentów)
   └─ Obserwowalność: Sentry (błędy), PostHog (analityka produktowa), Umami (www)
```
**Dlaczego Supabase, a nie Firebase:** relacyjny model (hodowla ↔ psy ↔ mioty ↔ szczenięta) z RLS, SQL do raportów, region UE (RODO), brak vendor lock-in (zwykły Postgres), tańsze przy wzroście. Alternatywa: własny backend (NestJS + Postgres) – więcej pracy, uzasadnione dopiero przy skali.

### 11.3 Struktura kodu (monorepo)
```
app/          – prototyp web (istnieje): React + TS + Vite
  src/app/    – typy, store, logika ciąży, Paw ID, formatowanie
  src/pages/  – ekrany modułów
  src/components/ – UI kit
mobile/       – Capacitor (android/, ios/) – wrapper nad app/dist   [faza 3]
supabase/     – migracje SQL, polityki RLS, Edge Functions          [faza 2]
docs/         – ten dokument, specyfikacje
```

---

## 12. Plan wdrożenia (fazy, zakres, szacunki)

Szacunki w roboczodniach (rd) dla zespołu: 1 lead full-stack + 1 frontend + 0,5 UI/UX + 0,3 QA; „+hodowca konsultant” (1 dzień/tydzień).

| Faza | Zakres | Czas | rd |
|---|---|---|---|
| **0. Discovery i brand** | nazwa, logo, paleta, 3–5 wywiadów z hodowcami, backlog, makiety kluczowych ekranów w Figmie | 2 tyg. | 10 |
| **1. Prototyp web – GOTOWY** | wszystkie moduły konkurenta w wersji lokalnej (ten PR) | – | wykonane |
| **2. Produkt web 1.0** | Dexie (IndexedDB) zamiast localStorage, zdjęcia, wyszukiwarka, tryb ciemny, i18n (PL/EN), testy (Vitest + Playwright), dostępność, PWA (offline, instalacja), PDF (pdfmake) | 4 tyg. | 35 |
| **3. Backend i konta** | Supabase: schemat, RLS, Auth (e-mail/Google/Apple), sync offline-first, backup/restore, Paw ID przez token, usuwanie konta, panel admina | 5 tyg. | 45 |
| **4. Mobile (Android + iOS)** | Capacitor, skaner QR (ML Kit), push (FCM/APNs), IAP (RevenueCat), deep-linki, splash/ikony, przygotowanie sklepów (Data Safety, prywatność), TestFlight/Internal testing | 4 tyg. | 30 |
| **5. Beta zamknięta** | 20–30 hodowców, telemetria, poprawki, treści poradnikowe (SEO), landing page, polityka/regulamin | 4 tyg. | 25 |
| **6. Launch 1.0** | sklepy + web, kampania w grupach, program poleceń, wsparcie | 2 tyg. | 10 |
| **7. Wyróżniki (1.1–1.3)** | hodowla wieloosobowa → dokumenty PDF → przychody/rentowność → portal nabywcy → drzewo/COI → AI | 3 × 4 tyg. | 90 |

**Razem do launchu 1.0:** ok. 21 tygodni kalendarzowych (możliwe 14–16 przy 2 deweloperach równolegle), ok. 155 rd. Wyróżniki: kolejne 12 tygodni.

**Kamienie milowe:** M1 (koniec fazy 2) – web do pokazania klientom; M2 (faza 3) – konta i sync; M3 (faza 4) – build w TestFlight i Play Internal; M4 – beta; M5 – launch.

---

## 13. Backlog (epiki, MoSCoW)

**Must (parytet):** konta i moduły · psy i metryka · zdrowie + przypomnienia · rozród + kalendarz ciąży · krycia reproduktora · mioty, szczenięta, wagi, analiza, checklista · Paw ID + QR + import · cyfrowa wyprawka · wystawy i championaty · finanse (wydatki, statystyki, historia) · raporty PDF · backup/restore · plan FREE/PRO + płatności · zdjęcia · web + Android + iOS.
**Should (wyróżniki 1.1):** push · wielu użytkowników w hodowli · dokumenty PDF (umowa, protokół, karta miotu) · przychody i rentowność · kalendarz cieczek · dziennik porodu · i18n EN.
**Could (1.2–1.3):** drzewo genealogiczne + COI · portal nabywcy · normy wag ras · AI asystent · integracja kalendarza Google · import CSV/Paw ID · tryb ciemny · DE/CZ.
**Won't (na teraz):** marketplace szczeniąt, czat, sklep, wiele gatunków (koty) – do oceny po roku.

**Przykładowe user stories (format Gherkin skrócony):**
- *Jako hodowca* dodaję krycie suki i od razu widzę kalendarz ciąży z terminami USG/RTG/porodu, a w dniu 25 dostaję push „czas na USG”.
- *Jako hodowca* ważę cały miot jednym formularzem (jedna data, N wag) i widzę, które szczenię ma najmniejszy przyrost.
- *Jako hodowca* generuję kartę Paw ID; nabywca skanuje ją w swojej aplikacji (iOS/Android/web) i otrzymuje historię, a ja zachowuję dane sprzedaży.
- *Jako współwłaściciel* mam dostęp do tej samej hodowli z własnym kontem i widzę, kto co zmienił.
- *Jako właściciel* otrzymuję przypomnienie o szczepieniu 7 dni wcześniej i mogę dodać je do kalendarza telefonu.

---

## 14. Wymagania niefunkcjonalne

- **Offline-first**: pełna praca bez sieci; synchronizacja w tle; konflikt = ostatnia zmiana per pole + log.
- **RODO**: region EU, DPA, eksport danych (JSON/CSV), usunięcie konta z poziomu aplikacji w ≤ 30 dni, minimalizacja danych nabywców, szyfrowanie w tranzycie i w spoczynku.
- **Bezpieczeństwo**: RLS per hodowla, tokeny Paw ID jednorazowe/wygasające, rate-limit na Edge Functions, 2FA opcjonalnie.
- **Wydajność**: start < 2 s na średnim Androidzie, listy do 1 000 psów/10 000 wpisów bez spowolnień (wirtualizacja), bundle < 400 kB gz (code-splitting Recharts/QR).
- **Dostępność**: WCAG 2.1 AA, kontrast, nawigacja klawiaturą (web), dynamiczny rozmiar czcionki (mobile).
- **i18n**: PL domyślnie, EN od 1.1; formaty dat/walut per locale.
- **Jakość**: testy jednostkowe logiki (ciąża, limity, Paw ID), E2E Playwright na kluczowych ścieżkach, CI w GitHub Actions, dystrybucja przez Fastlane/EAS-like skrypty.

---

## 15. Status prototypu webowego (katalog `app/`)

**Uruchomienie:**
```bash
cd app && npm install && npm run dev      # http://localhost:5173
npm run build && npm run preview          # build produkcyjny
```
Na ekranie startowym kliknij „Załaduj dane demonstracyjne (hodowla)”, aby zobaczyć aplikację z przykładową hodowlą (3 psy, miot z 4 szczeniętami i wagami, ciąża w toku, wystawy, finanse, przypomnienia).

**Zaimplementowane ekrany:** wybór modułu i onboarding · Start (powiadomienia, liczniki, trwające ciąże, szybki dostęp) · Moje psy (widok pełny/kompaktowy, filtry, limity FREE) · Profil psa: Metryka, Zdrowie (5 kategorii, następny termin), Rozród (skojarzenia: krycia, progesteron, USG, RTG) / Krycia (reproduktor), Kariera (wystawy z certyfikatami i tytułami, championaty, statystyki, koszty wystawy), Waga (wykres), Oś czasu · Kalendarz ciąży (dzień/tydzień, termin, USG/RTG/obserwacja/przedział porodu, 9 tygodni treści, oś ciąży, oznaczanie badań) · Mioty → Metryka miotu: szczenięta (kolory znaczników, ostatnia waga i zmiana), ważenie całego miotu, wpis zdrowotny dla wszystkich, Analiza miotu (liczby, najcięższe/najlżejsze, przyrosty, wykres zbiorczy), Opieka nad miotem (17 etapów, %), notatki, Cyfrowa wyprawka · Szczenię: metryka, wagi, zdrowie, właściciele (do 2) + cena/notatki prywatne + data przekazania, **Karta Paw ID z kodem QR** (toggle karta/QR, kopiowanie kodu, druk), informacje indywidualne (charakter, opis) · Finanse: budżet, dodawanie wydatków (hodowla/wystawa, kategorie i typy), wykres 6 mies. z limitem FREE i przełącznikiem kosztów wystaw, historia grupowana (wystawy; rok → miesiąc), statystyki · Raporty (13 zestawień, druk/PDF) · Przypomnienia · Skanuj Paw ID (kamera przez BarcodeDetector lub wklejenie kodu → import psa z historią) · Ustawienia (profil, moduł, plan FREE/PRO demo, backup JSON eksport/import, dane demo, kasowanie).

**Wyróżniki wdrożone w prototypie (wykorzystanie luk konkurenta z sekcji 8):**

| Luka u Paw Manager | Co mamy w prototypie | Gdzie |
|---|---|---|
| Brak kalendarza cieczek | Rejestr cieczek, średni odstęp i długość, prognoza następnej cieczki (±14 dni) i okna płodnego (9–15 dzień), terminy na Start | Profil suki → Rozród |
| Brak rodowodu i COI | Rodzice wybierani z własnej bazy, rodowód 3 pokolenia, współczynnik inbredu (Wright, 5 pokoleń) z listą wspólnych przodków | Profil psa → Rodowód |
| Tylko wydatki, brak rentowności | Przychody (zaliczka, sprzedaż, krycie, inne), wynik hodowli, rentowność i prognoza miotu, koszty przypięte do miotu | Finanse → Przychody; Miot → Finanse |
| Brak dokumentów | Umowa sprzedaży, protokół przekazania, karta miotu, karta zdrowia – wypełniane danymi, do PDF | Dokumenty |
| Brak dziennika porodu | Oś zdarzeń porodu (start, szczenię, notatka, wet, koniec), czas porodu, średni odstęp | Miot → Poród |
| Jedno konto na hodowlę | Zespół hodowli: zaproszenia, role właściciel / edytor / podgląd | Ustawienia |
| Brak portalu nabywcy | Publiczna strona szczenięcia (wagi, profilaktyka, karma, charakter, odliczanie do odbioru), kopiowanie linku i druk | Szczenię → Strona dla nabywcy |
| Brak wyszukiwarki | Wyszukiwarka globalna po wszystkich kolekcjach | Pasek boczny / `/szukaj` |
| Brak trybu ciemnego | Tryb ciemny (przełącznik w pasku i Ustawieniach) | — |

**Wygląd:** wariant A z makiet („Ciepła karta”) w zieleni (kolor główny `#32BF46`, hover `#28A33A`, tekst na jasnym tle `#1F8A30`, tła `#E4F8E8` / `#C9F0D1`, akcent `#F2B84B`), ikony Lucide, animacje wejścia i hover, przycisk „+” z arkuszem szybkich akcji, tryb ciemny. Makiety obu wariantów: kanwa projektowa (wariant A przebarwiony na zieleń).

**Świadome uproszczenia prototypu (do fazy 2–3):** dane w localStorage jednej przeglądarki (brak kont i synchronizacji), PDF przez okno drukowania przeglądarki, QR koduje pełne dane (produkcyjnie: token), brak zdjęć szczeniąt, brak push, brak wielojęzyczności, nazwa i kolorystyka robocze.

---

## 16. Co dalej (najbliższe kroki)

1. Decyzje z sekcji 17 (nazwa, budżet, stack backendu, iOS).
2. Faza 0: brand + 3–5 rozmów z hodowcami (walidacja wyróżników i cennika).
3. Faza 2: migracja prototypu na Dexie + PWA + i18n + testy.
4. Równolegle: landing page i 10 artykułów SEO na frazy konkurenta (zanim ugruntują pozycje).

---

## 17. Pytania do Ciebie (potrzebne do dalszych prac)

1. **Nazwa i marka** – „Kennelo” to placeholder. Propozycje: **Sfora**, **Łapka**, **Pawly**, **Breedly**, a z „pies/dog” w nazwie **Dogstry** i **Psia Księga** (patrz sekcja 18). Masz nazwę/domenę?
2. **Kto buduje** – Qamitech wewnętrznie (zespół webowy → rekomendacja React + Capacitor) czy zlecenie zewnętrzne (wtedy Flutter też w grze)?
3. **Budżet i termin** – czy plan ~21 tygodni do 1.0 (ok. 155 roboczodni) jest akceptowalny, czy celujemy w „wąskie 1.0” w 10–12 tygodni (bez iOS lub bez wyróżników)?
4. **iOS od startu** – potwierdzasz? (wymaga Apple Developer Program 99 USD/rok i Maca do buildów lub usługi chmurowej).
5. **Backend** – Supabase (szybko, UE, tanio) czy własny backend (NestJS/PHP) utrzymywany przez Qamitech?
6. **Rynek** – tylko Polska na start, czy od razu EN (jak konkurent) i np. DE/CZ?
7. **Cennik** – akceptujesz propozycję FREE/PRO/Hodowla+ z sekcji 9, czy wolisz prostszy model jak u konkurenta?
8. **Priorytet wyróżników** – które 2–3 z sekcji 9 wchodzą do 1.0, a które do 1.1?
9. **Dostęp do hodowców** – masz kontakt do 3–5 hodowców do wywiadów i bety?
10. Czy prototyp ma zostać w tym repozytorium (`qamitech/app`), czy zakładamy osobne repo produktu?

---

## 18. Propozycje nazwy aplikacji

| Nazwa | Dlaczego | Uwagi |
|---|---|---|
| **Kennelo** (obecna robocza) | „kennel” + miękka końcówka, międzynarodowa, łatwa do wymówienia po polsku i angielsku | Neutralna, bez skojarzenia z Polską; sprawdzić domeny .pl/.com i znak w UPRP/EUIPO |
| **Sfora** | Krótkie polskie słowo („stado psów”), jedna wyraźna marka, pasuje do funkcji zespołu hodowli i wielu psów | Mocno polskie – na rynki EN potrzebny podtytuł („Sfora – breeder app”); sprawdzić kolizje z firmami o tej nazwie |
| **Łapka** / **Lapka** | Ciepłe, przyjazne, zgodne z „pastelowym” wyglądem; naturalnie łączy właścicieli i hodowców; łatwa ikona (łapa) | Wersja bez ogonka (Lapka) do domeny i sklepów; sprawdzić, czy nie koliduje z istniejącymi markami zoologicznymi |

| **Pawly** (międzynarodowa) | „paw” + przyjazna końcówka „-ly”; krótkie, łatwe do wymówienia w każdym języku, ikona łapy, dobrze brzmi w sklepach | Popularny schemat nazw – duże ryzyko kolizji z istniejącymi aplikacjami dla zwierząt; koniecznie sprawdzić znak towarowy i domenę .com/.app |
| **Breedly** (międzynarodowa) | „breed” + „-ly”: mówi wprost „hodowla”, pozycjonuje produkt jako narzędzie profesjonalne, a nie zabawkę | Mniej ciepła dla samych właścicieli psów; przy module Owner potrzebny podtytuł („Breedly – psy, mioty, zdrowie”) |
| **Pawfolio** (międzynarodowa) | „paw” + „portfolio”: dokumentacja psa od rodowodu po karty zdrowia i Paw ID – spójne z naszymi wyróżnikami (dokumenty, rodowód, portal nabywcy) | Dłuższa i trudniejsza do zapisania ze słuchu; w Polsce wymaga krótkiego objaśnienia |

Rekomendacja: jeśli start tylko w Polsce – **Sfora** (najmocniejsza marka); jeśli od początku rynek EN – **Kennelo** lub **Pawly** (po weryfikacji znaków towarowych). Przed decyzją: sprawdzić dostępność domen (.pl, .com, .app), nazw w Google Play / App Store i baz znaków towarowych.

### 18.1. Nazwy z „pies” lub „dog” (sprawdzone w wyszukiwarce, 19.10.2026)

Szybki przegląd sieci, sklepów i Instagrama pod kątem istniejących aplikacji dla psów. To nie jest badanie znaków towarowych.

**Polskie (pies):**

| Nazwa | Znaczenie i zalety | Co znaleziono | Ocena |
|---|---|---|---|
| **Psia Księga** | „Księga” kojarzy się z księgą hodowlaną i rodowodem; poważna, ale ciepła | Tylko książka z 1976 r., brak aplikacji | Mocna na rynek PL; domena bez polskich znaków (psiaksiega.pl) |
| **Psiarnia** | Potocznie „miejsce z wieloma psami”, czyli hodowla; krótka i zapamiętywalna | Album muzyczny i paczka do Minecrafta, brak aplikacji | Ryzyko: w slangu to też określenie policji, bywa nacechowana negatywnie |

**Angielskie i międzynarodowe (dog):**

| Nazwa | Znaczenie i zalety | Co znaleziono | Ocena |
|---|---|---|---|
| **Dogstry** | „dog” + „ancestry/registry”, czyli psi rodowód i rejestr; pasuje do naszego wyróżnika (rodowód + COI) | Mała marka akcesoriów „Dogstry New York” i spółka nieruchomości, brak aplikacji | **Rekomendowana nazwa międzynarodowa** |
| **Doggly** | „dog” + „-ly”, przyjazna i lekka, dobra dla modułu właściciela | Brak aplikacji o tej nazwie, ale rynek „doggy” jest zatłoczony | Słabsza odróżnialność |
| **DogNest** | „dog” + „nest” (gniazdo), czyli miot i hodowla | Hotele dla psów, legowiska, projekt web3 | Średnie ryzyko kolizji |
| **Doggery** | Stare angielskie słowo na psiarnię lub hodowlę | Sklepy z przysmakami i salony groomerskie | Słowo ogólne, trudne do zastrzeżenia |

**Odrzucone, bo są zajęte przez aplikacje lub marki z branży:**

| Nazwa | Kto jej używa |
|---|---|
| DogDesk | Aplikacja dla trenerów psów w Wielkiej Brytanii (dogdesk.app) |
| PsiPlan | Polska aplikacja dla właścicieli psów w budowie (Instagram @_psiplan), bezpośredni konkurent |
| DogLog | Popularna aplikacja do śledzenia opieki nad psem (Google Play, App Store) |
| Dogfolio | Brytyjska aplikacja „dokumenty psa w jednym miejscu” (dogfolio.co.uk); osłabia też wcześniejszą propozycję Pawfolio |
| Dogbase | Oprogramowanie do zarządzania psami służbowymi i hodowlami (dogbase.co) |
| Canivo | Marka karmy dla psów |
| Psia Karta | Ogólne określenie używane w wielu aplikacjach i ofertach, nie do zastrzeżenia |

**Rekomendacja:** jedna marka na wszystkie rynki to **Dogstry** z polskim hasłem, np. „Dogstry – psia księga Twojej hodowli”. Jeśli zostajemy tylko w Polsce, najlepsza jest **Psia Księga**. Przed decyzją: domeny (.com, .app, .pl), Google Play i App Store, bazy EUIPO i UPRP.

