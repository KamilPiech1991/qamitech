# Kennelo (nazwa robocza) – prototyp aplikacji webowej dla hodowców i właścicieli psów

Prototyp odpowiadający zakresem aplikacji Paw Manager (analiza: `../docs/analiza-paw-manager-i-plan.md`).
Jedna baza kodu (React + TypeScript + Vite) przygotowana pod PWA i opakowanie w Android/iOS (Capacitor).

## Uruchomienie
```bash
npm install
npm run dev       # http://localhost:5173
npm run build     # tsc + vite build → dist/
npm run preview   # podgląd builda
```
Na ekranie startowym wybierz moduł (Właściciel / Hodowca) lub kliknij **„Załaduj dane demonstracyjne”**.

## Zakres
Psy i metryki · zdrowie z przypomnieniami · rozród (skojarzenia, progesteron, USG, RTG) i **kalendarz ciąży** · krycia reproduktora · mioty, szczenięta, wagi, analiza miotu, checklista opieki, notatki · **Paw ID** (karta + kod QR + import przez skan/wklejenie) · cyfrowa wyprawka · wystawy, championaty, statystyki · finanse (budżet, kategorie, historia, statystyki, wykres) · raporty do PDF (druk) · przypomnienia · plan FREE/PRO z limitami · backup JSON · dwa moduły (Owner/Breeder).

## Funkcje, których konkurent nie ma (nasze wyróżniki)
- **Kalendarz cieczek** z prognozą następnej cieczki i okna płodnego (profil suki → Rozród; terminy także na Start).
- **Rodowód 3 pokolenia + współczynnik inbredu (COI)** liczony z własnej bazy psów (profil psa → Rodowód).
- **Przychody i rentowność miotu** – zaliczki, sprzedaż, krycia; wynik miotu i prognoza (Finanse → Przychody, miot → Finanse).
- **Dokumenty do PDF** wypełniane danymi: umowa sprzedaży, protokół przekazania, karta miotu, karta zdrowia (Dokumenty).
- **Dziennik porodu** – start, kolejne szczenięta, notatki, wizyta weterynarza; statystyki czasu porodu (miot → Poród).
- **Zespół hodowli** – zaproszenia z rolami właściciel / edytor / podgląd (Ustawienia).
- **Strona dla nabywcy** szczenięcia (link publiczny `#/portal/:id`): wagi, profilaktyka, karma, charakter, odliczanie do odbioru.
- **Wyszukiwarka globalna** (psy, szczenięta, mioty, wystawy, zdrowie, wydatki, przypomnienia) i **tryb ciemny**.
- Przycisk „+” z arkuszem szybkich akcji (waga, zdrowie, wydatek, przypomnienie, nowy pies) na desktopie i mobile.

## Wygląd
Wariant A z makiet („Ciepła karta”) w palecie pastelowej zieleni: `--primary #2E7D5B`, tła `#DFF5E8` / `#C8EFD9`, akcent `#F2B84B`.
Ikony Lucide, animacje wejścia (fadeUp/pop), kafle z efektem hover, tryb ciemny przełączany w pasku bocznym i w Ustawieniach.

## Struktura
- `src/app/types.ts` – model danych i słowniki (kategorie, klasy wystaw, checklista…)
- `src/app/store.tsx` – store (React context + reducer) z zapisem do `localStorage`, limity planu
- `src/app/pregnancy.ts` – logika kalendarza ciąży i treści tygodni
- `src/app/pawid.ts` – kodowanie/dekodowanie paczki Paw ID (prefiks `KNL1:`)
- `src/app/heat.ts` – statystyki cieczek i prognoza następnej cieczki / okna płodnego
- `src/app/pedigree.ts` – budowa rodowodu i współczynnik inbredu (wzór Wrighta)
- `src/app/seed.ts` – dane demonstracyjne
- `src/components/` – UI kit, układ (sidebar + dolna nawigacja), formularz psa
- `src/pages/` – ekrany modułów

Dane trzymane są lokalnie w przeglądarce. Synchronizacja, konta, push i płatności – zgodnie z planem w `docs/`.
