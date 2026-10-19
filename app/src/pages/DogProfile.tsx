import { useMemo, useState } from 'react';
import { Link, useNavigate, useParams, useSearchParams } from 'react-router-dom';
import { LineChart, Line, XAxis, YAxis, Tooltip, ResponsiveContainer, CartesianGrid } from 'recharts';
import { useStore } from '../app/store';
import { Card, Empty, Field, KV, Modal, PageHeader, ProBadge, Stat, Tabs, confirmDel } from '../components/ui';
import DogForm from '../components/DogForm';
import { ageText, fmtDate, fmtDateTime, fmtMoney, nowLocal, today, uid } from '../app/format';
import { COUNTRIES, HEALTH_LABEL, SHOW_CERTS, SHOW_CLASSES, SHOW_GRADES, SHOW_RANKS, SHOW_TITLES, type Breeding, type Championship, type HealthKind, type HealthRecord, type Show, type StudMating, type Weight } from '../app/types';
import { pregnancyInfo } from '../app/pregnancy';

type Tab = 'card' | 'health' | 'breeding' | 'career' | 'weight' | 'timeline';

export default function DogProfile() {
  const { id } = useParams();
  const { state, upsert, remove, toast, limits } = useStore();
  const nav = useNavigate();
  const [params, setParams] = useSearchParams();
  const tab = (params.get('tab') as Tab) || 'card';
  const dog = state.dogs.find(d => d.id === id);
  const [editing, setEditing] = useState(false);
  if (!dog) return <Card><Empty>Nie znaleziono psa. <Link to="/psy">Wróć do listy</Link></Empty></Card>;
  const breeder = state.profile.module === 'breeder';
  const tabs: { key: Tab; label: string }[] = [
    { key: 'card', label: 'Metryka' }, { key: 'health', label: 'Zdrowie' },
    ...(breeder ? [{ key: 'breeding' as Tab, label: dog.sex === 'female' ? 'Rozród' : 'Krycia' }] : []),
    { key: 'career', label: 'Kariera' }, { key: 'weight', label: 'Waga' }, { key: 'timeline', label: 'Oś czasu' },
  ];
  return (
    <div>
      <PageHeader back={() => nav('/psy')} title={dog.name} sub={<>{dog.pedigreeName} · {dog.breed} · {dog.sex === 'male' ? 'Pies' : 'Suka'}, {ageText(dog.birthDate)}</>}
        actions={<><button className="btn secondary" onClick={() => setEditing(true)}>✏️ Edytuj</button><button className="btn danger" onClick={() => { if (confirmDel('Usunąć psa i wszystkie jego wpisy?')) { remove('dogs', dog.id); nav('/psy'); } }}>Usuń</button></>} />
      <Tabs value={tab} onChange={t => setParams({ tab: t })} items={tabs} />
      {tab === 'card' && <CardTab />}
      {tab === 'health' && <HealthTab />}
      {tab === 'breeding' && (dog.sex === 'female' ? <BreedingTab /> : <StudTab />)}
      {tab === 'career' && <CareerTab />}
      {tab === 'weight' && <WeightTab />}
      {tab === 'timeline' && <TimelineTab />}
      {editing && <DogForm initial={dog} onClose={() => setEditing(false)} onSave={d => { upsert('dogs', d); setEditing(false); toast('Zapisano'); }} />}
    </div>
  );

  function CardTab() {
    return (
      <div className="stack">
        <Card>
          <div className="row" style={{ alignItems: 'flex-start' }}>
            <div className="avatar lg">{dog!.photo ? <img src={dog!.photo} alt="" /> : '🐕'}</div>
            <div style={{ flex: 1 }}>
              <h3>Dane podstawowe</h3>
              <KV items={[['Rasa', dog!.breed], ['Data urodzenia', fmtDate(dog!.birthDate)], ['Umaszczenie', dog!.color], ['Waga', dog!.weightKg ? `${dog!.weightKg} kg` : '—'], ['Płeć', dog!.sex === 'male' ? 'Pies' : 'Suka'], ['Kastrowany', dog!.neutered ? 'Tak' : 'Nie']]} />
            </div>
          </div>
        </Card>
        <Card title="Rodzice"><KV items={[['Ojciec', dog!.fatherName], ['Matka', dog!.motherName]]} /></Card>
        <Card title="Identyfikacja"><KV items={[['Nr rodowodu', dog!.pedigreeNo], ['Nr rejestracji oddziałowej', dog!.regNo], ['Nr chip', dog!.chip], ['Hodowla', dog!.kennelName], ['Paw ID', dog!.pawId]]} /></Card>
        {dog!.notes && <Card title="Notatki"><div style={{ whiteSpace: 'pre-wrap' }}>{dog!.notes}</div></Card>}
      </div>
    );
  }

  function HealthTab() {
    const [edit, setEdit] = useState<HealthRecord | null>(null);
    const recs = state.health.filter(h => h.dogId === dog!.id).sort((a, b) => b.date.localeCompare(a.date));
    const groups: HealthKind[] = ['vaccination', 'deworming', 'parasite', 'procedure', 'exam'];
    const t = today();
    return (
      <div className="stack">
        <div className="row no-print"><button className="btn" onClick={() => setEdit({ id: uid(), dogId: dog!.id, kind: 'vaccination', date: t, name: '' })}>+ Dodaj wpis</button></div>
        {groups.map(g => { const rs = recs.filter(r => r.kind === g); return (
          <Card key={g} title={HEALTH_LABEL[g]} right={<span className="badge gray">{rs.length}</span>}>
            {rs.length === 0 ? <div className="muted">Brak wpisów.</div> : <div className="list">{rs.map(r => (
              <div key={r.id} className="list-item">
                <div><div className="title">{r.name}</div><small>{fmtDate(r.date)}{r.vet ? ` · ${r.vet}` : ''}{r.result ? ` · ${r.result}` : ''}{r.notes ? ` · ${r.notes}` : ''}</small></div>
                <div className="row">{r.nextDate && <span className={`badge ${r.nextDate < t ? 'danger' : 'warn'}`}>Następne: {fmtDate(r.nextDate)}</span>}<button className="icon-btn" onClick={() => setEdit(r)}>✏️</button><button className="icon-btn" onClick={() => confirmDel() && remove('health', r.id)}>🗑️</button></div>
              </div>))}</div>}
          </Card>); })}
        {edit && <HealthForm rec={edit} onClose={() => setEdit(null)} onSave={r => { upsert('health', r); setEdit(null); toast('Zapisano'); }} />}
      </div>
    );
  }

  function BreedingTab() {
    const [edit, setEdit] = useState<Breeding | null>(null);
    const list = state.breedings.filter(b => b.femaleId === dog!.id).sort((a, b) => (b.matings[0]?.date ?? '').localeCompare(a.matings[0]?.date ?? ''));
    return (
      <div className="stack">
        <div className="row no-print"><button className="btn" onClick={() => setEdit({ id: uid(), femaleId: dog!.id, maleName: '', matings: [{ date: today(), type: 'natural', tie: true }], usg: [], progesterone: [], rtg: [] })}>+ Dodaj skojarzenie</button></div>
        {list.length === 0 && <Card><Empty>Brak skojarzeń. Dodaj pierwsze, aby uruchomić kalendarz ciąży.</Empty></Card>}
        {list.map(b => { const first = [...b.matings].sort((x, y) => x.date.localeCompare(y.date))[0]; const info = first ? pregnancyInfo(first.date) : null; const litter = state.litters.find(l => l.id === b.litterId); return (
          <Card key={b.id} title={<>Skojarzenie z <span style={{ color: 'var(--primary-600)' }}>{b.maleName}</span></>} right={<div className="row"><button className="icon-btn" onClick={() => setEdit(b)}>✏️</button><button className="icon-btn" onClick={() => confirmDel() && remove('breedings', b.id)}>🗑️</button></div>}>
            {info && !litter && info.day <= 70 && info.day > 0 && (
              <Link to={`/ciaza/${b.id}`} className="card soft clickable" style={{ display: 'block', marginBottom: 10, background: 'var(--primary)', color: '#fff' }}>
                <div className="row between"><div><b>📅 Kalendarz ciąży</b><div style={{ opacity: .85, fontSize: 13 }}>{info.day}. dzień · {info.week}. tydzień · termin ok. {fmtDate(info.expected)}</div></div><span>→</span></div>
              </Link>
            )}
            <KV items={[['Data rozpoczęcia cieczki', fmtDate(b.heatStartDate)], ['Krycia', b.matings.map(m => `${fmtDate(m.date)} – ${m.type === 'natural' ? 'naturalne' : 'inseminacja'}${m.tie ? ', zakleszczenie' : ''}`).join('; ') || '—'], ['Progesteron', b.progesterone.map(p => `${fmtDate(p.date)}: ${p.value}`).join('; ') || '—'], ['Badania USG', b.usg.map(p => `${fmtDate(p.date)}: ${p.value}`).join('; ') || '—'], ['Badania RTG', b.rtg.map(p => `${fmtDate(p.date)}: ${p.value}`).join('; ') || '—'], ['Miot', litter ? <Link to={`/mioty/${litter.id}`}>{litter.name}</Link> : '—'], ['Notatki', b.notes]]} />
          </Card>); })}
        {edit && <BreedingForm b={edit} onClose={() => setEdit(null)} onSave={b => { upsert('breedings', b); setEdit(null); toast('Zapisano'); }} />}
      </div>
    );
  }

  function StudTab() {
    const [edit, setEdit] = useState<StudMating | null>(null);
    const list = state.studMatings.filter(m => m.maleId === dog!.id).sort((a, b) => (b.dates[0] ?? '').localeCompare(a.dates[0] ?? ''));
    return (
      <div className="stack">
        <div className="row no-print"><button className="btn" onClick={() => setEdit({ id: uid(), maleId: dog!.id, femaleName: '', ownerFirst: '', ownerLast: '', place: 'kennel', type: 'natural', tie: true, dates: [today()] })}>+ Dodaj krycie</button></div>
        <Card title="Historia kryć reproduktora">
          {list.length === 0 ? <Empty>Brak zapisanych kryć.</Empty> : <div className="stack">{list.map(m => (
            <div key={m.id} className="card soft">
              <div className="row between"><b style={{ color: 'var(--primary-600)', fontSize: 16 }}>{m.femaleName}</b><div><button className="icon-btn" onClick={() => setEdit(m)}>✏️</button><button className="icon-btn" onClick={() => confirmDel() && remove('studMatings', m.id)}>🗑️</button></div></div>
              <KV items={[['Właściciel', `${m.ownerFirst} ${m.ownerLast}`], ['Liczba szczeniąt', m.puppiesCount ?? '—'], ['Rodzaj krycia', m.type === 'natural' ? 'Naturalne' : 'Inseminacja'], ['Czy było zakleszczenie', m.tie ? 'Tak' : 'Nie'], ['Miejsce krycia', m.place === 'kennel' ? 'Krycie w hodowli' : 'Krycie zewnętrzne'], ...m.dates.map((d, i) => [`Data krycia ${m.dates.length > 1 ? i + 1 : ''}`.trim(), fmtDate(d)] as [string, string]), ['Notatki', m.notes]]} />
            </div>))}</div>}
        </Card>
        {edit && <StudForm m={edit} onClose={() => setEdit(null)} onSave={m => { upsert('studMatings', m); setEdit(null); toast('Zapisano'); }} />}
      </div>
    );
  }

  function CareerTab() {
    const [sub, setSub] = useState<'shows' | 'champ'>('shows');
    const [editShow, setEditShow] = useState<Show | null>(null);
    const [editCh, setEditCh] = useState<Championship | null>(null);
    const [year, setYear] = useState('all');
    const shows = state.shows.filter(s => s.dogId === dog!.id).sort((a, b) => b.date.localeCompare(a.date));
    const years = Array.from(new Set(shows.map(s => s.date.slice(0, 4)))).sort().reverse();
    const visible = shows.filter(s => year === 'all' || s.date.startsWith(year));
    const champs = state.championships.filter(c => c.dogId === dog!.id);
    const certs = shows.filter(s => s.certificates).length, titles = shows.filter(s => s.titles).length;
    const showCost = (s: Show) => state.expenses.filter(e => e.showId === s.id).reduce((a, e) => a + e.amount, 0);
    return (
      <div className="stack">
        <div className="grid cols-3"><Stat icon="🏆" value={shows.length} label="Wystawy" /><Stat icon="🎖️" value={certs} label="Certyfikaty" /><Stat icon="🏅" value={titles} label="Tytuły" /></div>
        <Tabs value={sub} onChange={setSub} items={[{ key: 'shows', label: 'Wystawy' }, { key: 'champ', label: 'Championaty' }]} />
        {sub === 'shows' && (
          <>
            <div className="row between no-print">
              <select value={year} onChange={e => setYear(e.target.value)} style={{ padding: 8, borderRadius: 8, border: '1px solid var(--border)' }}><option value="all">Rok: wszystkie</option>{years.map(y => <option key={y} value={y}>Rok: {y}</option>)}</select>
              <button className="btn" onClick={() => { if (!limits.canAddShow()) { toast('Plan FREE: maks. 5 wystaw. Przejdź na PRO.'); return; } setEditShow({ id: uid(), dogId: dog!.id, country: 'Polska', city: '', rank: SHOW_RANKS[0], date: today(), dogClass: SHOW_CLASSES[4] }); }}>+ Dodaj wystawę</button>
            </div>
            {!limits.isPro && shows.length >= 5 && <div className="card soft">Limit 5 wystaw w planie FREE. <ProBadge /> znosi limit.</div>}
            {visible.length === 0 ? <Card><Empty>Brak wystaw.</Empty></Card> : visible.map(s => (
              <Card key={s.id}>
                <div className="row between"><div><b style={{ color: 'var(--primary-600)', fontSize: 16 }}>{s.country}, {s.city}</b><div>{s.rank}</div></div><div><button className="icon-btn" onClick={() => setEditShow(s)}>✏️</button><button className="icon-btn" onClick={() => confirmDel() && remove('shows', s.id)}>🗑️</button></div></div>
                <KV items={[['Nr katalogowy', s.catalogNo], ['Data wystawy', fmtDate(s.date)], ['Klasa', s.dogClass], ['Lokata', s.place], ['Ocena', s.grade], ['Sędzia', s.judge], ['Tytuły', s.titles], ['Certyfikaty', s.certificates], ['Notatki', s.notes]]} />
                <div className="row between" style={{ marginTop: 8 }}><small className="muted">Łączny koszt: <b>{fmtMoney(showCost(s))}</b></small><Link className="btn secondary sm" to={`/finanse?show=${s.id}`}>Koszty wystawy</Link></div>
              </Card>))}
          </>
        )}
        {sub === 'champ' && (
          <>
            <div className="grid cols-2">{champs.map(c => <div key={c.id} className="card row between"><div>⭐ <b>{c.country}</b><div className="muted">{c.title}</div></div><div><button className="icon-btn" onClick={() => setEditCh(c)}>✏️</button><button className="icon-btn" onClick={() => confirmDel() && remove('championships', c.id)}>🗑️</button></div></div>)}</div>
            {champs.length === 0 && <Card><Empty>Brak championatów.</Empty></Card>}
            <div className="row no-print"><button className="btn" onClick={() => { if (!limits.canAddChampionship()) { toast('Plan FREE: maks. 6 championatów. Przejdź na PRO.'); return; } setEditCh({ id: uid(), dogId: dog!.id, country: 'Polska', title: 'Champion' }); }}>+ Dodaj championat</button></div>
          </>
        )}
        {editShow && <ShowForm s={editShow} onClose={() => setEditShow(null)} onSave={s => { upsert('shows', s); setEditShow(null); toast('Zapisano'); }} />}
        {editCh && <Modal title="Championat" onClose={() => setEditCh(null)} actions={<><button className="btn secondary" onClick={() => setEditCh(null)}>Anuluj</button><button className="btn" onClick={() => { upsert('championships', editCh); setEditCh(null); }}>Zapisz</button></>}>
          <Field label="Kraj"><select value={editCh.country} onChange={e => setEditCh({ ...editCh, country: e.target.value })}>{COUNTRIES.map(c => <option key={c}>{c}</option>)}</select></Field>
          <Field label="Tytuł"><select value={editCh.title} onChange={e => setEditCh({ ...editCh, title: e.target.value })}>{['Champion', 'Junior Champion', 'Interchampion', 'Veteran Champion', 'Grand Champion', 'Multi Champion', 'Zwycięzca Klubu', 'Inny'].map(c => <option key={c}>{c}</option>)}</select></Field>
        </Modal>}
      </div>
    );
  }

  function WeightTab() {
    const [edit, setEdit] = useState<Weight | null>(null);
    const ws = state.weights.filter(w => w.dogId === dog!.id).sort((a, b) => a.date.localeCompare(b.date));
    const data = ws.map(w => ({ d: fmtDate(w.date), kg: w.grams / 1000 }));
    return (
      <div className="stack">
        <div className="row no-print"><button className="btn" onClick={() => setEdit({ id: uid(), dogId: dog!.id, date: nowLocal(), grams: dog!.weightKg ? dog!.weightKg * 1000 : 0 })}>+ Dodaj pomiar</button></div>
        <Card title="Historia pomiarów">
          {ws.length < 2 ? <div className="muted">Dodaj co najmniej dwa pomiary, aby zobaczyć wykres.</div> : (
            <div style={{ height: 220 }}><ResponsiveContainer><LineChart data={data}><CartesianGrid strokeDasharray="3 3" /><XAxis dataKey="d" fontSize={11} /><YAxis fontSize={11} unit=" kg" /><Tooltip /><Line isAnimationActive={false} type="monotone" dataKey="kg" stroke="#0f766e" strokeWidth={2} /></LineChart></ResponsiveContainer></div>
          )}
          <div className="list" style={{ marginTop: 10 }}>{[...ws].reverse().map(w => <div key={w.id} className="list-item"><div><div className="title">{(w.grams / 1000).toFixed(2)} kg</div><small>{fmtDateTime(w.date)}</small></div><div><button className="icon-btn" onClick={() => setEdit(w)}>✏️</button><button className="icon-btn" onClick={() => confirmDel() && remove('weights', w.id)}>🗑️</button></div></div>)}</div>
        </Card>
        {edit && <Modal title="Pomiar wagi" onClose={() => setEdit(null)} actions={<><button className="btn secondary" onClick={() => setEdit(null)}>Anuluj</button><button className="btn" disabled={!edit.grams} onClick={() => { upsert('weights', edit); upsert('dogs', { ...dog!, weightKg: edit.grams / 1000 }); setEdit(null); }}>Zapisz</button></>}>
          <Field label="Data i godzina"><input type="datetime-local" value={edit.date} onChange={e => setEdit({ ...edit, date: e.target.value })} /></Field>
          <Field label="Waga (kg)"><input type="number" step="0.01" value={edit.grams ? edit.grams / 1000 : ''} onChange={e => setEdit({ ...edit, grams: Math.round(Number(e.target.value) * 1000) })} /></Field>
        </Modal>}
      </div>
    );
  }

  function TimelineTab() {
    const events = useMemo(() => {
      const ev: { date: string; title: string; sub?: string; ico: string }[] = [];
      ev.push({ date: dog!.birthDate, title: 'Narodziny', ico: '🎂' });
      state.health.filter(h => h.dogId === dog!.id).forEach(h => ev.push({ date: h.date, title: `${HEALTH_LABEL[h.kind]}: ${h.name}`, sub: h.vet, ico: '💉' }));
      state.shows.filter(s => s.dogId === dog!.id).forEach(s => ev.push({ date: s.date, title: `Wystawa: ${s.country}, ${s.city}`, sub: [s.rank, s.grade, s.place ? `lokata ${s.place}` : '', s.titles, s.certificates].filter(Boolean).join(' · '), ico: '🏆' }));
      state.breedings.filter(b => b.femaleId === dog!.id).forEach(b => b.matings.forEach(m => ev.push({ date: m.date, title: `Krycie z ${b.maleName}`, sub: m.type === 'natural' ? 'naturalne' : 'inseminacja', ico: '❤️' })));
      state.studMatings.filter(m => m.maleId === dog!.id).forEach(m => m.dates.forEach(d => ev.push({ date: d, title: `Krycie suki ${m.femaleName}`, ico: '❤️' })));
      state.litters.filter(l => l.motherId === dog!.id || l.fatherId === dog!.id).forEach(l => ev.push({ date: l.birthDate, title: `Miot: ${l.name}`, sub: `${state.puppies.filter(p => p.litterId === l.id).length} szczeniąt`, ico: '🐾' }));
      state.weights.filter(w => w.dogId === dog!.id).forEach(w => ev.push({ date: w.date.slice(0, 10), title: `Waga: ${(w.grams / 1000).toFixed(2)} kg`, ico: '⚖️' }));
      state.expenses.filter(e => e.dogId === dog!.id).forEach(e => ev.push({ date: e.date, title: `Wydatek: ${e.category}${e.type ? ` / ${e.type}` : ''}`, sub: fmtMoney(e.amount), ico: '💰' }));
      return ev.sort((a, b) => b.date.localeCompare(a.date));
    }, []);
    return <Card title="Pełna historia"><div className="timeline">{events.map((e, i) => <div key={i} className="tl"><div className="row between"><b>{e.ico} {e.title}</b><small className="muted">{fmtDate(e.date)}</small></div>{e.sub && <small className="muted">{e.sub}</small>}</div>)}</div></Card>;
  }
}

export function HealthForm({ rec, onClose, onSave }: { rec: HealthRecord; onClose: () => void; onSave: (r: HealthRecord) => void }) {
  const [r, setR] = useState(rec);
  return (
    <Modal title="Wpis zdrowotny" onClose={onClose} actions={<><button className="btn secondary" onClick={onClose}>Anuluj</button><button className="btn" disabled={!r.name.trim() || !r.date} onClick={() => onSave(r)}>Zapisz</button></>}>
      <div className="form-grid">
        <Field label="Rodzaj"><select value={r.kind} onChange={e => setR({ ...r, kind: e.target.value as HealthKind })}>{(Object.keys(HEALTH_LABEL) as HealthKind[]).map(k => <option key={k} value={k}>{HEALTH_LABEL[k]}</option>)}</select></Field>
        <Field label="Nazwa / preparat *"><input value={r.name} onChange={e => setR({ ...r, name: e.target.value })} placeholder="np. Nobivac DHPPi" /></Field>
        <Field label="Data *"><input type="date" value={r.date} onChange={e => setR({ ...r, date: e.target.value })} /></Field>
        <Field label="Następny termin (przypomnienie)"><input type="date" value={r.nextDate ?? ''} onChange={e => setR({ ...r, nextDate: e.target.value || undefined })} /></Field>
        <Field label="Lekarz / lecznica"><input value={r.vet ?? ''} onChange={e => setR({ ...r, vet: e.target.value })} /></Field>
        <Field label="Wynik"><input value={r.result ?? ''} onChange={e => setR({ ...r, result: e.target.value })} /></Field>
      </div>
      <Field label="Notatki"><textarea value={r.notes ?? ''} onChange={e => setR({ ...r, notes: e.target.value })} /></Field>
    </Modal>
  );
}

function BreedingForm({ b, onClose, onSave }: { b: Breeding; onClose: () => void; onSave: (b: Breeding) => void }) {
  const { state } = useStore();
  const [x, setX] = useState(b);
  const males = state.dogs.filter(d => d.sex === 'male');
  const listEditor = (label: string, key: 'usg' | 'progesterone' | 'rtg', placeholder: string) => (
    <Card title={label} className="soft" right={<button className="btn sm secondary" onClick={() => setX({ ...x, [key]: [...x[key], { date: today(), value: '' }] })}>+ Dodaj</button>}>
      {x[key].length === 0 && <div className="muted">Brak wpisów.</div>}
      {x[key].map((v, i) => <div key={i} className="row" style={{ marginBottom: 6 }}><input type="date" value={v.date} onChange={e => setX({ ...x, [key]: x[key].map((o, j) => j === i ? { ...o, date: e.target.value } : o) })} style={{ padding: 8, borderRadius: 8, border: '1px solid var(--border)' }} /><input value={v.value} placeholder={placeholder} onChange={e => setX({ ...x, [key]: x[key].map((o, j) => j === i ? { ...o, value: e.target.value } : o) })} style={{ flex: 1, padding: 8, borderRadius: 8, border: '1px solid var(--border)' }} /><button className="icon-btn" onClick={() => setX({ ...x, [key]: x[key].filter((_, j) => j !== i) })}>🗑️</button></div>)}
    </Card>
  );
  return (
    <Modal title="Skojarzenie" onClose={onClose} wide actions={<><button className="btn secondary" onClick={onClose}>Anuluj</button><button className="btn" disabled={!x.maleName.trim() || x.matings.length === 0} onClick={() => onSave(x)}>Zapisz</button></>}>
      <div className="form-grid">
        <Field label="Reproduktor z moich psów"><select value={x.maleId ?? ''} onChange={e => { const m = males.find(d => d.id === e.target.value); setX({ ...x, maleId: m?.id, maleName: m ? `${m.name} (${m.pedigreeName})` : x.maleName }); }}><option value="">— inny / zewnętrzny —</option>{males.map(m => <option key={m.id} value={m.id}>{m.name}</option>)}</select></Field>
        <Field label="Reproduktor (nazwa) *"><input value={x.maleName} onChange={e => setX({ ...x, maleName: e.target.value })} /></Field>
        <Field label="Hodowla reproduktora"><input value={x.maleKennel ?? ''} onChange={e => setX({ ...x, maleKennel: e.target.value })} /></Field>
        <Field label="Data rozpoczęcia cieczki"><input type="date" value={x.heatStartDate ?? ''} onChange={e => setX({ ...x, heatStartDate: e.target.value || undefined })} /></Field>
      </div>
      <Card title="Krycia" className="soft" right={<button className="btn sm secondary" onClick={() => setX({ ...x, matings: [...x.matings, { date: today(), type: 'natural', tie: true }] })}>+ Dodaj kolejne krycie</button>}>
        {x.matings.map((m, i) => <div key={i} className="row" style={{ marginBottom: 6 }}>
          <input type="date" value={m.date} onChange={e => setX({ ...x, matings: x.matings.map((o, j) => j === i ? { ...o, date: e.target.value } : o) })} style={{ padding: 8, borderRadius: 8, border: '1px solid var(--border)' }} />
          <select value={m.type} onChange={e => setX({ ...x, matings: x.matings.map((o, j) => j === i ? { ...o, type: e.target.value as 'natural' | 'insemination' } : o) })} style={{ padding: 8, borderRadius: 8, border: '1px solid var(--border)' }}><option value="natural">Naturalne</option><option value="insemination">Inseminacja</option></select>
          <label className="row"><input type="checkbox" checked={!!m.tie} onChange={e => setX({ ...x, matings: x.matings.map((o, j) => j === i ? { ...o, tie: e.target.checked } : o) })} /> zakleszczenie</label>
          <button className="icon-btn" onClick={() => setX({ ...x, matings: x.matings.filter((_, j) => j !== i) })}>🗑️</button>
        </div>)}
      </Card>
      {listEditor('Progesteron', 'progesterone', 'np. 5,8 ng/ml')}
      {listEditor('Badania USG', 'usg', 'np. ciąża potwierdzona, 5–6 płodów')}
      {listEditor('Badania RTG', 'rtg', 'np. 6 szczeniąt')}
      <Field label="Notatki"><textarea value={x.notes ?? ''} onChange={e => setX({ ...x, notes: e.target.value })} /></Field>
    </Modal>
  );
}

function StudForm({ m, onClose, onSave }: { m: StudMating; onClose: () => void; onSave: (m: StudMating) => void }) {
  const [x, setX] = useState(m);
  return (
    <Modal title="Krycie" onClose={onClose} actions={<><button className="btn secondary" onClick={onClose}>Anuluj</button><button className="btn" disabled={!x.femaleName.trim()} onClick={() => onSave(x)}>Zapisz</button></>}>
      <div className="form-grid">
        <Field label="Miejsce krycia *"><select value={x.place} onChange={e => setX({ ...x, place: e.target.value as 'kennel' | 'external' })}><option value="kennel">Krycie w hodowli</option><option value="external">Krycie zewnętrzne</option></select></Field>
        <Field label="Imię suki *"><input value={x.femaleName} onChange={e => setX({ ...x, femaleName: e.target.value })} /></Field>
        <Field label="Imię właściciela"><input value={x.ownerFirst} onChange={e => setX({ ...x, ownerFirst: e.target.value })} /></Field>
        <Field label="Nazwisko właściciela"><input value={x.ownerLast} onChange={e => setX({ ...x, ownerLast: e.target.value })} /></Field>
        <Field label="Liczba szczeniąt"><input type="number" value={x.puppiesCount ?? ''} onChange={e => setX({ ...x, puppiesCount: e.target.value ? Number(e.target.value) : undefined })} /></Field>
        <Field label="Rodzaj krycia *"><select value={x.type} onChange={e => setX({ ...x, type: e.target.value as 'natural' | 'insemination' })}><option value="natural">Naturalne</option><option value="insemination">Inseminacja</option></select></Field>
        <Field label="Czy było zakleszczenie"><select value={x.tie ? '1' : '0'} onChange={e => setX({ ...x, tie: e.target.value === '1' })}><option value="1">Tak</option><option value="0">Nie</option></select></Field>
      </div>
      <Field label="Daty krycia">{x.dates.map((d, i) => <div key={i} className="row" style={{ marginBottom: 6 }}><input type="date" value={d} onChange={e => setX({ ...x, dates: x.dates.map((o, j) => j === i ? e.target.value : o) })} /><button className="icon-btn" onClick={() => setX({ ...x, dates: x.dates.filter((_, j) => j !== i) })}>🗑️</button></div>)}<button className="btn secondary sm" onClick={() => setX({ ...x, dates: [...x.dates, today()] })}>+ Dodaj datę</button></Field>
      <Field label="Notatki"><textarea value={x.notes ?? ''} onChange={e => setX({ ...x, notes: e.target.value })} /></Field>
    </Modal>
  );
}

function ShowForm({ s, onClose, onSave }: { s: Show; onClose: () => void; onSave: (s: Show) => void }) {
  const [x, setX] = useState(s);
  const toggle = (key: 'titles' | 'certificates', v: string) => { const cur = (x[key] ?? '').split(',').map(t => t.trim()).filter(Boolean); setX({ ...x, [key]: (cur.includes(v) ? cur.filter(c => c !== v) : [...cur, v]).join(', ') }); };
  const has = (key: 'titles' | 'certificates', v: string) => (x[key] ?? '').split(',').map(t => t.trim()).includes(v);
  return (
    <Modal title="Wystawa" onClose={onClose} wide actions={<><button className="btn secondary" onClick={onClose}>Anuluj</button><button className="btn" disabled={!x.city.trim() || !x.date} onClick={() => onSave(x)}>Zapisz</button></>}>
      <h3>Dane podstawowe</h3>
      <div className="form-grid">
        <Field label="Kraj *"><select value={x.country} onChange={e => setX({ ...x, country: e.target.value })}>{COUNTRIES.map(c => <option key={c}>{c}</option>)}</select></Field>
        <Field label="Miejscowość *"><input value={x.city} onChange={e => setX({ ...x, city: e.target.value })} /></Field>
        <Field label="Ranga wystawy *"><select value={x.rank} onChange={e => setX({ ...x, rank: e.target.value })}>{SHOW_RANKS.map(c => <option key={c}>{c}</option>)}</select></Field>
        <Field label="Data wystawy *"><input type="date" value={x.date} onChange={e => setX({ ...x, date: e.target.value })} /></Field>
      </div>
      <h3>Szczegóły</h3>
      <div className="form-grid">
        <Field label="Klasa *"><select value={x.dogClass} onChange={e => setX({ ...x, dogClass: e.target.value })}>{SHOW_CLASSES.map(c => <option key={c}>{c}</option>)}</select></Field>
        <Field label="Nr katalogowy"><input value={x.catalogNo ?? ''} onChange={e => setX({ ...x, catalogNo: e.target.value })} /></Field>
        <Field label="Ocena"><select value={x.grade ?? ''} onChange={e => setX({ ...x, grade: e.target.value })}><option value="">—</option>{SHOW_GRADES.map(c => <option key={c}>{c}</option>)}</select></Field>
        <Field label="Lokata"><select value={x.place ?? ''} onChange={e => setX({ ...x, place: e.target.value })}><option value="">—</option>{['1', '2', '3', '4', 'bez lokaty'].map(c => <option key={c}>{c}</option>)}</select></Field>
        <Field label="Sędzia"><input value={x.judge ?? ''} onChange={e => setX({ ...x, judge: e.target.value })} /></Field>
      </div>
      <Field label="Certyfikaty / wnioski"><div className="chips">{SHOW_CERTS.map(c => <button type="button" key={c} className={`chip ${has('certificates', c) ? 'on' : ''}`} onClick={() => toggle('certificates', c)}>{c}</button>)}</div></Field>
      <Field label="Tytuły"><div className="chips">{SHOW_TITLES.map(c => <button type="button" key={c} className={`chip ${has('titles', c) ? 'on' : ''}`} onClick={() => toggle('titles', c)}>{c}</button>)}</div></Field>
      <Field label="Notatki"><textarea value={x.notes ?? ''} onChange={e => setX({ ...x, notes: e.target.value })} /></Field>
    </Modal>
  );
}
