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

## Struktura
- `src/app/types.ts` – model danych i słowniki (kategorie, klasy wystaw, checklista…)
- `src/app/store.tsx` – store (React context + reducer) z zapisem do `localStorage`, limity planu
- `src/app/pregnancy.ts` – logika kalendarza ciąży i treści tygodni
- `src/app/pawid.ts` – kodowanie/dekodowanie paczki Paw ID (prefiks `KNL1:`)
- `src/app/seed.ts` – dane demonstracyjne
- `src/components/` – UI kit, układ (sidebar + dolna nawigacja), formularz psa
- `src/pages/` – ekrany modułów

Dane trzymane są lokalnie w przeglądarce. Synchronizacja, konta, push i płatności – zgodnie z planem w `docs/`.
