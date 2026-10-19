import type { AppState } from './types';
import { addDays, today, uid } from './format';

export function emptyState(): AppState {
  return {
    profile: { module: 'breeder', plan: 'free', kennelName: '', breederName: '', onboarded: false },
    dogs: [], health: [], breedings: [], studMatings: [], litters: [], puppies: [], weights: [], shows: [], championships: [], expenses: [], reminders: [],
  };
}

export function demoState(): AppState {
  const t = today();
  const s = emptyState();
  s.profile = { module: 'breeder', plan: 'free', kennelName: 'Hodowla z Zielonego Wzgórza', kennelNo: 'PL6455678', breederName: 'Michał', email: 'michal@example.com', onboarded: true };
  const bubek = { id: uid(), name: 'Bubek', pedigreeName: 'Bubi Dolina Krzemowa FCI', breed: 'Basset Hound', sex: 'male' as const, birthDate: '2021-12-10', color: 'Łaciaty', weightKg: 17, neutered: false, fatherName: 'Grinch z Bordeaux', motherName: 'Fiona Królestwo Rusałek', pedigreeNo: '637378383', regNo: '8873663', chip: '6363737e', createdAt: t };
  const diana = { id: uid(), name: 'Diana', pedigreeName: 'Diana zza Miedzy', breed: 'Basset Hound', sex: 'female' as const, birthDate: '2022-05-03', color: 'Tricolor', weightKg: 21, fatherName: 'Rocky z San Francisco', motherName: 'Daisy from Royal Castle', pedigreeNo: '65566', chip: '25668', createdAt: t };
  const rocky = { id: uid(), name: 'Rocky', pedigreeName: 'Rocky z San Francisco', breed: 'Chart Szkocki Deerhound', sex: 'male' as const, birthDate: '2024-06-07', color: 'Pręgowany', weightKg: 38, createdAt: t };
  s.dogs = [bubek, diana, rocky];
  s.health = [
    { id: uid(), dogId: bubek.id, kind: 'vaccination', date: addDays(t, -200), nextDate: addDays(t, 165), name: 'Nobivac DHPPi + L', vet: 'lek. wet. Anna Kowal' },
    { id: uid(), dogId: bubek.id, kind: 'vaccination', date: addDays(t, -340), nextDate: addDays(t, 25), name: 'Wścieklizna (Rabisin)' },
    { id: uid(), dogId: bubek.id, kind: 'deworming', date: addDays(t, -60), nextDate: addDays(t, 30), name: 'Drontal Plus' },
    { id: uid(), dogId: diana.id, kind: 'vaccination', date: addDays(t, -100), nextDate: addDays(t, 265), name: 'Nobivac DHPPi + L' },
    { id: uid(), dogId: diana.id, kind: 'parasite', date: addDays(t, -20), nextDate: addDays(t, 10), name: 'Bravecto (kleszcze/pchły)' },
    { id: uid(), dogId: diana.id, kind: 'exam', date: addDays(t, -150), name: 'Badanie krwi – morfologia', result: 'W normie' },
    { id: uid(), dogId: rocky.id, kind: 'procedure', date: addDays(t, -45), name: 'Czyszczenie zębów', vet: 'Klinika Reksio' },
  ];
  const breedingId = uid();
  const matingDate = addDays(t, -20);
  s.breedings = [{ id: breedingId, femaleId: diana.id, maleId: rocky.id, maleName: 'Rocky (Rodzinny Zwierzyniec)', heatStartDate: addDays(t, -31), matings: [{ date: matingDate, type: 'natural', tie: true }, { date: addDays(t, -18), type: 'natural', tie: true }], usg: [], progesterone: [{ date: addDays(t, -22), value: '5,8 ng/ml' }], rtg: [], notes: '' }];
  s.studMatings = [{ id: uid(), maleId: bubek.id, femaleName: 'Luna z Birmingham', ownerFirst: 'John', ownerLast: 'Kowalsky', place: 'external', type: 'insemination', dates: [addDays(t, -98)], puppiesCount: 6 }];
  const litterId = uid();
  const lb = addDays(t, -40);
  s.litters = [{ id: litterId, name: 'Miot D', motherId: diana.id, motherName: 'Diana zza Miedzy', fatherId: bubek.id, fatherName: 'Bubi Dolina Krzemowa FCI', birthDate: lb, notes: ['Poród naturalny, bez komplikacji. 4 szczenięta.'], checklist: { deworm1: true, vacc1: true, bw: true, vet: true, solid: true }, pack: { foodBrand: 'Royal Canin', foodName: 'Mini Puppy', portion: '75 g', mealsPerDay: 4, feedingHours: '7, 11, 15, 19', supplements: 'Olej z łososia 1 łyżeczka dziennie', grooming: 'Czesanie 2× w tygodniu, pazury co 2 tygodnie', firstDays: 'Pierwsze dni pozwól szczeniakowi odpocząć, wprowadzaj nowe bodźce stopniowo.', accustomed: ['Dzieci', 'Klatka kennelowa', 'Jazda samochodem', 'Smycz / obroża', 'Domowe dźwięki'] }, createdAt: t }];
  const pups = [
    { name: 'Blue Boy', sex: 'male' as const, color: 'Pręgus', bw: 250, marker: '#2563eb', start: 250, gain: 22 },
    { name: 'Red Boy', sex: 'male' as const, color: 'Tricolor', bw: 262, marker: '#dc2626', start: 262, gain: 27 },
    { name: 'Turkusik', sex: 'male' as const, color: 'Łaciaty', bw: 240, marker: '#0891b2', start: 240, gain: 20 },
    { name: 'Fioletowy', sex: 'female' as const, color: 'Tricolor', bw: 231, marker: '#7c3aed', start: 231, gain: 21 },
  ];
  pups.forEach((p, i) => {
    const pid = uid();
    s.puppies.push({ id: pid, litterId, name: p.name, sex: p.sex, birthDateTime: `${lb}T${String(3 + i).padStart(2, '0')}:00`, color: p.color, birthWeightG: p.bw, birthStatus: 'alive', markerColor: p.marker, pawId: `KNL-P-${String(i + 1).padStart(3, '0')}`, pedigreeNo: i === 0 ? '65566' : undefined, chip: i === 0 ? '25668' : undefined, owners: i === 1 ? [{ name: 'Jan Kowalski', address: 'Piłsudskiego 123, 12-345 Warszawa', email: 'jan.k123@example.com', phone: '123456789' }] : [], price: i === 1 ? 4500 : undefined, character: i === 0 ? ['Energiczny', 'Ciekawski', 'Towarzyski', 'Łakomczuch'] : [], aboutText: i === 0 ? 'Wulkan energii :) Zalecam co najmniej 1 dłuższy spacer dziennie.' : undefined });
    for (let d = 0; d <= 40; d += 5) s.weights.push({ id: uid(), puppyId: pid, date: `${addDays(lb, d)}T18:00`, grams: Math.round(p.start + p.gain * d * (1 + (i % 2) * 0.05)) });
    if (i < 2) s.health.push({ id: uid(), puppyId: pid, kind: 'deworming', date: addDays(lb, 14), name: 'Drontal Puppy' }, { id: uid(), puppyId: pid, kind: 'deworming', date: addDays(lb, 28), name: 'Drontal Puppy' });
    if (i === 0) s.health.push({ id: uid(), puppyId: pid, kind: 'vaccination', date: addDays(lb, 42), name: 'Nobivac Puppy DP' });
  });
  const showSatu = uid(), showWaw = uid();
  s.shows = [
    { id: showSatu, dogId: diana.id, country: 'Rumunia', city: 'Satu Mare', rank: 'Wystawa Międzynarodowa', date: addDays(t, -190), dogClass: 'Klasa otwarta', catalogNo: '237', place: '1', grade: 'Doskonała', judge: 'Leszek Salamon', titles: 'BOB', certificates: 'Res. CACIB' },
    { id: showWaw, dogId: diana.id, country: 'Polska', city: 'Warszawa', rank: 'Wystawa Krajowa', date: addDays(t, -37), dogClass: 'Klasa otwarta', place: '1', grade: 'Doskonała', judge: 'Maria Nowak', titles: 'Zwycięzca Rasy', certificates: 'CWC' },
    { id: uid(), dogId: bubek.id, country: 'Polska', city: 'Poznań', rank: 'Wystawa Championów', date: addDays(t, -400), dogClass: 'Klasa championów', place: '2', grade: 'Doskonała', judge: 'Jan Wiśniewski', certificates: 'Res. CWC' },
  ];
  s.championships = [{ id: uid(), dogId: bubek.id, country: 'Polska', title: 'Champion' }, { id: uid(), dogId: bubek.id, country: 'Litwa', title: 'Champion' }, { id: uid(), dogId: diana.id, country: 'Polska', title: 'Junior Champion' }];
  const ex = (m: number, amount: number, category: string, type: string, scope: 'kennel' | 'show' = 'kennel', dogId?: string, description?: string, showId?: string) => ({ id: uid(), date: addDays(t, -m), amount, scope, category, type, dogId, description, showId });
  s.expenses = [
    ex(3, 95, 'Usługa weterynaryjna', 'Szczepienie', 'kennel', bubek.id), ex(12, 180, 'Karma i żywienie', 'Karma sucha', 'kennel', undefined, 'Royal Canin 15 kg'), ex(20, 55, 'Suplementy', 'Witaminy'),
    ex(37, 180, 'Opłaty/Zgłoszenia', 'Zgłoszenia psów', 'show', diana.id, undefined, showWaw), ex(37, 520, 'Opłaty/Zgłoszenia', 'Paliwo / dojazd', 'show', diana.id, undefined, showWaw), ex(37, 80, 'Opłaty/Zgłoszenia', 'Wyżywienie na miejscu', 'show', diana.id, undefined, showWaw),
    ex(48, 320, 'Rozród i miot', 'USG/RTG', 'kennel', diana.id), ex(75, 175, 'Karma i żywienie', 'Karma sucha'), ex(100, 156, 'Grooming i higiena', 'Groomer', 'kennel', rocky.id), ex(130, 115, 'Sprzęt i akcesoria', 'Legowisko'), ex(190, 1350, 'Opłaty/Zgłoszenia', 'Nocleg', 'show', diana.id, undefined, showSatu), ex(190, 400, 'Opłaty/Zgłoszenia', 'Zgłoszenia psów', 'show', diana.id, undefined, showSatu), ex(190, 900, 'Opłaty/Zgłoszenia', 'Paliwo / dojazd', 'show', diana.id, undefined, showSatu),
  ];
  s.reminders = [
    { id: uid(), title: 'Klubowa terenówka – weekend', date: addDays(t, 5), done: false, notes: 'W sobotę i niedzielę w Kiełku.' },
    { id: uid(), title: 'USG Diana – potwierdzenie ciąży', date: addDays(matingDate, 26), dogId: diana.id, done: false },
    { id: uid(), title: 'Drugie odrobaczenie szczeniąt (Miot D)', date: addDays(lb, 42), done: false },
  ];
  return s;
}
