export type Sex = 'male' | 'female';
export type Module = 'owner' | 'breeder';
export type Plan = 'free' | 'pro';

export interface Dog {
  id: string;
  name: string; // imię domowe
  pedigreeName: string;
  breed: string;
  sex: Sex;
  birthDate: string;
  color?: string;
  weightKg?: number;
  neutered?: boolean;
  fatherName?: string;
  motherName?: string;
  pedigreeNo?: string;
  regNo?: string;
  chip?: string;
  kennelName?: string;
  photo?: string;
  notes?: string;
  pawId?: string;
  fatherId?: string;
  motherId?: string;
  createdAt: string;
}

export interface Heat {
  id: string;
  dogId: string;
  startDate: string;
  endDate?: string;
  notes?: string;
}

export interface Income {
  id: string;
  date: string;
  amount: number;
  category: string;
  description?: string;
  dogId?: string;
  litterId?: string;
  puppyId?: string;
}

export interface BirthEvent {
  id: string;
  time: string;
  kind: 'start' | 'puppy' | 'note' | 'vet' | 'end';
  puppyName?: string;
  note?: string;
}

export interface Member {
  id: string;
  name: string;
  email: string;
  role: 'owner' | 'editor' | 'viewer';
  status: 'active' | 'invited';
}

export type HealthKind = 'vaccination' | 'deworming' | 'parasite' | 'procedure' | 'exam';
export const HEALTH_LABEL: Record<HealthKind, string> = {
  vaccination: 'Szczepienie',
  deworming: 'Odrobaczenie',
  parasite: 'Profilaktyka pasożytnicza',
  procedure: 'Wizyta / zabieg',
  exam: 'Badanie',
};

export interface HealthRecord {
  id: string;
  dogId?: string;
  puppyId?: string;
  kind: HealthKind;
  date: string;
  name: string;
  nextDate?: string;
  vet?: string;
  result?: string;
  notes?: string;
}

export interface MatingEvent { date: string; type: 'natural' | 'insemination'; tie?: boolean }
export interface DatedValue { date: string; value: string }

export interface Breeding {
  id: string;
  femaleId: string;
  maleId?: string;
  maleName: string;
  maleKennel?: string;
  heatStartDate?: string;
  matings: MatingEvent[];
  usg: DatedValue[];
  progesterone: DatedValue[];
  rtg: DatedValue[];
  litterId?: string;
  notes?: string;
}

export interface StudMating {
  id: string;
  maleId: string;
  femaleName: string;
  ownerFirst: string;
  ownerLast: string;
  place: 'kennel' | 'external';
  type: 'natural' | 'insemination';
  tie?: boolean;
  dates: string[];
  puppiesCount?: number;
  notes?: string;
}

export interface LitterPack {
  foodBrand?: string;
  foodName?: string;
  portion?: string;
  mealsPerDay?: number;
  feedingHours?: string;
  supplements?: string;
  grooming?: string;
  firstDays?: string;
  accustomed: string[];
}

export interface Litter {
  id: string;
  name: string;
  motherId?: string;
  motherName: string;
  fatherId?: string;
  fatherName: string;
  birthDate: string;
  breedingId?: string;
  notes: string[];
  checklist: Record<string, boolean>;
  pack: LitterPack;
  birthDiary: BirthEvent[];
  createdAt: string;
}

export interface PuppyOwner {
  name: string;
  address?: string;
  email?: string;
  phone?: string;
}

export interface Puppy {
  id: string;
  litterId: string;
  name: string;
  sex: Sex;
  birthDateTime: string;
  color?: string;
  birthWeightG?: number;
  birthStatus: 'alive' | 'stillborn' | 'died';
  markerColor: string;
  pedigreeNo?: string;
  chip?: string;
  pawId: string;
  price?: number;
  privateNotes?: string;
  owners: PuppyOwner[];
  handoverDate?: string;
  character: string[];
  aboutText?: string;
}

export interface Weight {
  id: string;
  dogId?: string;
  puppyId?: string;
  date: string; // ISO datetime
  grams: number;
}

export interface Show {
  id: string;
  dogId: string;
  country: string;
  city: string;
  rank: string;
  date: string;
  dogClass: string;
  catalogNo?: string;
  place?: string;
  grade?: string;
  judge?: string;
  titles?: string;
  certificates?: string;
  notes?: string;
}

export interface Championship {
  id: string;
  dogId: string;
  country: string;
  title: string;
}

export interface Expense {
  id: string;
  date: string;
  amount: number;
  scope: 'kennel' | 'show';
  category: string;
  type?: string;
  description?: string;
  dogId?: string;
  showId?: string;
  litterId?: string;
}

export interface Reminder {
  id: string;
  title: string;
  date: string;
  dogId?: string;
  done: boolean;
  notes?: string;
}

export interface Profile {
  module: Module;
  plan: Plan;
  kennelName: string;
  kennelNo?: string;
  breederName: string;
  email?: string;
  onboarded: boolean;
  darkMode?: boolean;
}

export interface AppState {
  profile: Profile;
  dogs: Dog[];
  health: HealthRecord[];
  breedings: Breeding[];
  studMatings: StudMating[];
  litters: Litter[];
  puppies: Puppy[];
  weights: Weight[];
  shows: Show[];
  championships: Championship[];
  expenses: Expense[];
  reminders: Reminder[];
  heats: Heat[];
  incomes: Income[];
  members: Member[];
}

export const INCOME_CATEGORIES = ['Sprzedaż szczenięcia', 'Zaliczka za szczenię', 'Krycie (opłata)', 'Nagroda / wystawa', 'Inne'];
export const HEAT_DEFAULT_INTERVAL_DAYS = 180;

export const FREE_LIMITS = { females: 2, males: 2, shows: 5, championships: 6, chartMonths: 4 };

export const EXPENSE_CATEGORIES: Record<string, string[]> = {
  'Karma i żywienie': ['Karma sucha', 'Karma mokra', 'Przysmaki', 'Inne'],
  'Suplementy': ['Witaminy', 'Suplementy na stawy', 'Inne'],
  'Grooming i higiena': ['Kosmetyki', 'Groomer', 'Inne'],
  'Usługa weterynaryjna': ['Szczepienie', 'Odrobaczenie', 'Badanie', 'Zabieg', 'Wizyta kontrolna', 'Inne'],
  'Sprzęt i akcesoria': ['Smycz/obroża', 'Legowisko', 'Zabawki', 'Klatka', 'Inne'],
  'Opłaty/Zgłoszenia': ['Składka klubowa', 'Rodowody', 'Rejestracja', 'Inne'],
  'Rozród i miot': ['Krycie', 'Inseminacja', 'USG/RTG', 'Wyprawki', 'Chipowanie', 'Inne'],
  'Inne': ['Inne'],
};
export const SHOW_EXPENSE_TYPES = ['Zgłoszenia psów', 'Paliwo / dojazd', 'Nocleg', 'Wyżywienie na miejscu', 'Handler', 'Inne'];
export const SHOW_RANKS = ['Wystawa Krajowa', 'Wystawa Międzynarodowa', 'Wystawa Klubowa', 'Wystawa Championów', 'Wystawa Europejska', 'Wystawa Światowa'];
export const SHOW_CLASSES = ['Klasa baby', 'Klasa szczeniąt', 'Klasa młodzieży', 'Klasa pośrednia', 'Klasa otwarta', 'Klasa użytkowa', 'Klasa championów', 'Klasa weteranów'];
export const SHOW_GRADES = ['Doskonała', 'Bardzo dobra', 'Dobra', 'Dostateczna', 'Wybitnie obiecujący', 'Obiecujący', 'Dyskwalifikacja'];
export const SHOW_TITLES = ['BOB', 'BOS', 'BOG', 'BIS', 'Zwycięzca Młodzieży', 'Zwycięzca Rasy', 'Najlepszy Junior', 'Najlepsze Baby', 'Najlepsze Szczenię', 'Najlepszy Weteran'];
export const SHOW_CERTS = ['CWC', 'Res. CWC', 'CACIB', 'Res. CACIB', 'CAJC', 'CAC', 'Res. CAC'];
export const CHARACTER_TAGS = ['Spokojny', 'Energiczny', 'Ciekawski', 'Odważny', 'Ostrożny', 'Towarzyski', 'Przytulaśny', 'Niezależny', 'Wrażliwy', 'Pewny siebie', 'Lubi zabawę', 'Łakomczuch', 'Lubi ludzi', 'Obserwator'];
export const ACCUSTOMED_ITEMS = ['Dzieci', 'Inne psy', 'Koty', 'Klatka kennelowa', 'Jazda samochodem', 'Zostawanie samemu', 'Smycz / obroża', 'Zabiegi pielęgnacyjne', 'Domowe dźwięki'];
export const MARKER_COLORS = ['#16a34a', '#2563eb', '#dc2626', '#f59e0b', '#7c3aed', '#0891b2', '#ec4899', '#111827', '#f97316', '#84cc16'];
export const COUNTRIES = ['Polska', 'Niemcy', 'Czechy', 'Słowacja', 'Litwa', 'Łotwa', 'Estonia', 'Ukraina', 'Węgry', 'Rumunia', 'Austria', 'Włochy', 'Francja', 'Hiszpania', 'Holandia', 'Belgia', 'Dania', 'Szwecja', 'Norwegia', 'Finlandia', 'Wielka Brytania', 'Irlandia', 'Chorwacja', 'Słowenia', 'Serbia', 'Inny'];

export const LITTER_CHECKLIST: { group: string; items: { key: string; title: string; desc: string }[] }[] = [
  { group: 'Profilaktyka i dokumentacja', items: [
    { key: 'deworm1', title: 'Pierwsze odrobaczenie', desc: 'Profilaktyka przeciwpasożytnicza (ok. 2. tydzień).' },
    { key: 'deworm2', title: 'Drugie odrobaczenie', desc: 'Zaznacz po wykonaniu drugiego odrobaczenia szczeniąt.' },
    { key: 'deworm3', title: 'Trzecie odrobaczenie', desc: 'Zaznacz po wykonaniu trzeciego odrobaczenia szczeniąt.' },
    { key: 'vacc1', title: 'Pierwsze szczepienie', desc: 'Szczepienie wykonane po konsultacji z lekarzem weterynarii.' },
    { key: 'vacc2', title: 'Drugie szczepienie', desc: 'Zaznacz po wykonaniu drugiego szczepienia szczeniąt.' },
    { key: 'vacc3', title: 'Trzecie szczepienie', desc: 'Zaznacz po wykonaniu trzeciego szczepienia szczeniąt.' },
    { key: 'chip', title: 'Chipowanie', desc: 'Wszystkie szczenięta zaczipowane, numery zapisane w metrykach.' },
    { key: 'review', title: 'Przegląd miotu', desc: 'Przegląd miotu przez kierownika sekcji / oddział.' },
    { key: 'pedigrees', title: 'Wniosek o metryki / rodowody', desc: 'Dokumentacja miotu złożona w oddziale.' },
    { key: 'contracts', title: 'Umowy z nabywcami', desc: 'Umowy sprzedaży przygotowane dla każdego szczenięcia.' },
  ]},
  { group: 'Opieka i rozwój', items: [
    { key: 'bw', title: 'Wagi urodzeniowe', desc: 'Zapisane wagi urodzeniowe wszystkich szczeniąt.' },
    { key: 'vet', title: 'Wizyta kontrolna u weterynarza', desc: 'Kontrola suki i szczeniąt po porodzie.' },
    { key: 'solid', title: 'Pierwszy pokarm stały', desc: 'Rozpoczęcie dokarmiania (ok. 3.–4. tydzień).' },
    { key: 'wean', title: 'Odstawienie od matki', desc: 'Szczenięta w pełni na pokarmie stałym.' },
    { key: 'social', title: 'Socjalizacja', desc: 'Dźwięki, ludzie, nowe bodźce, pierwsze wyjścia.' },
    { key: 'pack', title: 'Cyfrowa wyprawka gotowa', desc: 'Informacje dla nowych właścicieli przygotowane.' },
    { key: 'handover', title: 'Przekazanie szczeniąt', desc: 'Wszystkie szczenięta przekazane nowym właścicielom.' },
  ]},
];
