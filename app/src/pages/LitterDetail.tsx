import { useState } from 'react';
import { Link, useNavigate, useParams } from 'react-router-dom';
import { LineChart, Line, XAxis, YAxis, Tooltip, ResponsiveContainer, CartesianGrid, Legend } from 'recharts';
import { useStore } from '../app/store';
import { Card, Chips, Empty, Field, Modal, PageHeader, Tabs, confirmDel, sexIcon } from '../components/ui';
import { LitterForm } from './Litters';
import { daysBetween, fmtDate, fmtDateTime, nowLocal, today, uid } from '../app/format';
import { ACCUSTOMED_ITEMS, LITTER_CHECKLIST, MARKER_COLORS, type HealthKind, type LitterPack, type Puppy } from '../app/types';
import { HealthForm } from './DogProfile';

type Tab = 'puppies' | 'analysis' | 'care' | 'pack';

export function PuppyForm({ initial, litterId, index, onClose, onSave }: { initial?: Puppy; litterId: string; index: number; onClose: () => void; onSave: (p: Puppy) => void }) {
  const [p, setP] = useState<Puppy>(initial ?? { id: uid(), litterId, name: '', sex: 'male', birthDateTime: nowLocal(), birthStatus: 'alive', markerColor: MARKER_COLORS[index % MARKER_COLORS.length], pawId: `KNL-P-${Date.now().toString(36).toUpperCase().slice(-6)}`, owners: [], character: [] });
  return (
    <Modal title={initial ? 'Edytuj szczenię' : 'Dodaj szczenię'} onClose={onClose} actions={<><button className="btn secondary" onClick={onClose}>Anuluj</button><button className="btn" disabled={!p.name.trim()} onClick={() => onSave(p)}>Zapisz</button></>}>
      <div className="form-grid">
        <Field label="Imię / oznaczenie *"><input value={p.name} onChange={e => setP({ ...p, name: e.target.value })} placeholder="np. Blue Boy" /></Field>
        <Field label="Płeć"><select value={p.sex} onChange={e => setP({ ...p, sex: e.target.value as 'male' | 'female' })}><option value="male">Pies</option><option value="female">Suka</option></select></Field>
        <Field label="Data i godzina urodzenia"><input type="datetime-local" value={p.birthDateTime} onChange={e => setP({ ...p, birthDateTime: e.target.value })} /></Field>
        <Field label="Umaszczenie"><input value={p.color ?? ''} onChange={e => setP({ ...p, color: e.target.value })} /></Field>
        <Field label="Waga urodzeniowa (g)"><input type="number" value={p.birthWeightG ?? ''} onChange={e => setP({ ...p, birthWeightG: e.target.value ? Number(e.target.value) : undefined })} /></Field>
        <Field label="Status urodzenia"><select value={p.birthStatus} onChange={e => setP({ ...p, birthStatus: e.target.value as Puppy['birthStatus'] })}><option value="alive">Żywy</option><option value="stillborn">Martwo urodzony</option><option value="died">Padł po urodzeniu</option></select></Field>
        <Field label="Nr rodowodu / metryki"><input value={p.pedigreeNo ?? ''} onChange={e => setP({ ...p, pedigreeNo: e.target.value })} /></Field>
        <Field label="Nr chipa"><input value={p.chip ?? ''} onChange={e => setP({ ...p, chip: e.target.value })} /></Field>
      </div>
      <Field label="Kolor znacznika (obróżki)"><div className="chips">{MARKER_COLORS.map(c => <button type="button" key={c} className="chip" style={{ background: c, borderColor: p.markerColor === c ? '#000' : c, width: 34, height: 34, padding: 0, outline: p.markerColor === c ? '3px solid var(--primary-soft)' : 'none' }} onClick={() => setP({ ...p, markerColor: c })} aria-label={c} />)}</div></Field>
    </Modal>
  );
}

export default function LitterDetail() {
  const { id } = useParams();
  const { state, upsert, dispatch, toast } = useStore();
  const nav = useNavigate();
  const litter = state.litters.find(l => l.id === id);
  const [tab, setTab] = useState<Tab>('puppies');
  const [editLitter, setEditLitter] = useState(false);
  const [addPup, setAddPup] = useState(false);
  const [bulkWeight, setBulkWeight] = useState(false);
  const [bulkHealth, setBulkHealth] = useState(false);
  const [note, setNote] = useState('');
  if (!litter) return <Card><Empty>Nie znaleziono miotu. <Link to="/mioty">Wróć</Link></Empty></Card>;
  const pups = state.puppies.filter(p => p.litterId === litter.id).sort((a, b) => a.birthDateTime.localeCompare(b.birthDateTime));
  const lastWeights = (pid: string) => state.weights.filter(w => w.puppyId === pid).sort((a, b) => a.date.localeCompare(b.date));
  const allKeys = LITTER_CHECKLIST.flatMap(g => g.items.map(i => i.key));
  const doneCount = allKeys.filter(k => litter.checklist[k]).length;
  const pct = Math.round((doneCount / allKeys.length) * 100);
  const age = daysBetween(litter.birthDate, today());

  return (
    <div>
      <PageHeader back={() => nav('/mioty')} title={`Metryka miotu: ${litter.name}`} sub={<>Ur. {fmtDate(litter.birthDate)} ({age} dni) · Matka: {litter.motherName} · Ojciec: {litter.fatherName || '—'}</>} actions={<button className="btn secondary" onClick={() => setEditLitter(true)}>✏️ Edytuj miot</button>} />
      <Tabs value={tab} onChange={setTab} items={[{ key: 'puppies', label: `Szczenięta (${pups.length})` }, { key: 'analysis', label: 'Analiza miotu' }, { key: 'care', label: `Opieka nad miotem (${pct}%)` }, { key: 'pack', label: 'Cyfrowa wyprawka' }]} />

      {tab === 'puppies' && (
        <div className="stack">
          <div className="row no-print">
            <button className="btn" onClick={() => setAddPup(true)}>+ Dodaj szczenię</button>
            {pups.length > 0 && <><button className="btn secondary" onClick={() => setBulkWeight(true)}>⚖️ Ważenie całego miotu</button><button className="btn secondary" onClick={() => setBulkHealth(true)}>💉 Wpis dla wszystkich</button></>}
          </div>
          {pups.length === 0 && <Card><Empty>Brak szczeniąt. Dodaj pierwsze szczenię z miotu.</Empty></Card>}
          {pups.map(p => { const ws = lastWeights(p.id); const last = ws[ws.length - 1]; const prev = ws[ws.length - 2]; const diff = last && prev ? last.grams - prev.grams : null; return (
            <Card key={p.id} className="" >
              <div style={{ borderLeft: `5px solid ${p.markerColor}`, paddingLeft: 12 }}>
                <div className="row between">
                  <div><b style={{ fontSize: 17, color: 'var(--primary-600)' }}>{p.name}</b><div className="muted">{sexIcon(p.sex)} {p.sex === 'male' ? 'Pies' : 'Suka'} · Ur. {fmtDateTime(p.birthDateTime)}{p.birthStatus !== 'alive' ? ' · ' + (p.birthStatus === 'stillborn' ? 'martwo urodzony' : 'padł') : ''}</div></div>
                  {last ? <div className="card soft" style={{ padding: '6px 10px', textAlign: 'right' }}><b>⚖️ {last.grams} g</b>{diff !== null && <div style={{ fontSize: 12, color: diff >= 0 ? 'var(--success)' : 'var(--danger)' }}>{diff >= 0 ? '↑ +' : '↓ '}{diff} g</div>}</div> : <span className="badge gray">brak pomiaru</span>}
                </div>
                <div className="row" style={{ marginTop: 10, gap: 6 }}>
                  <Link className="btn secondary sm" to={`/szczenieta/${p.id}`}>📋 Metryka</Link>
                  <Link className="btn secondary sm" to={`/szczenieta/${p.id}?tab=weights`}>⚖️ Wagi</Link>
                  <Link className="btn sm" to={`/szczenieta/${p.id}?tab=pawid`}>🔳 Karta Paw ID</Link>
                  {p.owners.length > 0 && <span className="badge">Właściciel: {p.owners[0].name}</span>}
                  {p.handoverDate && <span className="badge gray">Przekazany {fmtDate(p.handoverDate)}</span>}
                </div>
              </div>
            </Card>); })}
        </div>
      )}

      {tab === 'analysis' && <Analysis />}

      {tab === 'care' && (
        <div className="stack">
          <Card title="Opieka nad miotem" right={<span className="badge">{doneCount} z {allKeys.length} etapów · {pct}%</span>}>
            <div className="progress" style={{ marginBottom: 12 }}><div style={{ width: `${pct}%` }} /></div>
            {LITTER_CHECKLIST.map(g => <div key={g.group} style={{ marginBottom: 12 }}><div style={{ fontWeight: 700, color: 'var(--primary-600)', fontSize: 12, textTransform: 'uppercase', letterSpacing: 1, borderLeft: '3px solid var(--primary)', paddingLeft: 8, marginBottom: 4 }}>{g.group}</div>{g.items.map(i => <label key={i.key} className="check"><input type="checkbox" checked={!!litter.checklist[i.key]} onChange={e => upsert('litters', { ...litter, checklist: { ...litter.checklist, [i.key]: e.target.checked } })} /><div><div className="t" style={{ color: litter.checklist[i.key] ? 'var(--primary-600)' : undefined }}>{i.title}</div><div className="d">{i.desc}</div></div></label>)}</div>)}
          </Card>
          <Card title="Notatki do miotu" right={<span className="badge gray">{litter.notes.length}</span>}>
            {litter.notes.map((n, i) => <div key={i} className="list-item" style={{ marginBottom: 6 }}><div>{n}</div><button className="icon-btn" onClick={() => upsert('litters', { ...litter, notes: litter.notes.filter((_, j) => j !== i) })}>🗑️</button></div>)}
            <div className="row"><input value={note} onChange={e => setNote(e.target.value)} placeholder="Nowa notatka..." style={{ flex: 1, padding: 9, borderRadius: 10, border: '1px solid var(--border)' }} /><button className="btn" disabled={!note.trim()} onClick={() => { upsert('litters', { ...litter, notes: [...litter.notes, note.trim()] }); setNote(''); }}>Dodaj</button></div>
          </Card>
        </div>
      )}

      {tab === 'pack' && <PackEditor />}

      {editLitter && <LitterForm initial={litter} onClose={() => setEditLitter(false)} onSave={l => { upsert('litters', l); setEditLitter(false); toast('Zapisano'); }} />}
      {addPup && <PuppyForm litterId={litter.id} index={pups.length} onClose={() => setAddPup(false)} onSave={p => { upsert('puppies', p); if (p.birthWeightG) upsert('weights', { id: uid(), puppyId: p.id, date: p.birthDateTime, grams: p.birthWeightG }); setAddPup(false); toast('Szczenię dodane'); }} />}
      {bulkWeight && <BulkWeight />}
      {bulkHealth && <HealthForm rec={{ id: uid(), kind: 'deworming', date: today(), name: '' }} onClose={() => setBulkHealth(false)} onSave={r => { dispatch({ type: 'bulk', fn: s => ({ ...s, health: [...s.health, ...pups.map(p => ({ ...r, id: uid(), puppyId: p.id }))] }) }); setBulkHealth(false); toast(`Wpis dodany dla ${pups.length} szczeniąt`); }} />}
    </div>
  );

  function Analysis() {
    const rows = pups.map(p => { const ws = lastWeights(p.id); const last = ws[ws.length - 1]; const prev = ws[ws.length - 2]; return { p, last, diff: last && prev ? last.grams - prev.grams : null }; });
    const withW = rows.filter(r => r.last);
    const heaviest = withW.length ? withW.reduce((a, b) => (b.last!.grams > a.last!.grams ? b : a)) : null;
    const lightest = withW.length ? withW.reduce((a, b) => (b.last!.grams < a.last!.grams ? b : a)) : null;
    const withD = rows.filter(r => r.diff !== null);
    const bestGain = withD.length ? withD.reduce((a, b) => (b.diff! > a.diff! ? b : a)) : null;
    const worstGain = withD.length ? withD.reduce((a, b) => (b.diff! < a.diff! ? b : a)) : null;
    const [hidden, setHidden] = useState<string[]>([]);
    const dates = Array.from(new Set(state.weights.filter(w => pups.some(p => p.id === w.puppyId)).map(w => w.date.slice(0, 10)))).sort();
    const data = dates.map(d => { const row: Record<string, string | number> = { d: fmtDate(d) }; pups.forEach(p => { const w = state.weights.filter(x => x.puppyId === p.id && x.date.startsWith(d)).pop(); if (w) row[p.name] = w.grams; }); return row; });
    return (
      <div className="stack">
        <Card title="Miot w liczbach">
          <div className="grid cols-3"><div className="card soft stat"><div className="value">{pups.length}</div><div className="label">Szczenięta</div></div><div className="card soft stat"><div className="value">{pups.filter(p => p.sex === 'male').length}</div><div className="label">Psy</div></div><div className="card soft stat"><div className="value">{pups.filter(p => p.sex === 'female').length}</div><div className="label">Suki</div></div></div>
        </Card>
        <Card title="Najcięższe i najlżejsze szczenię">
          {heaviest && <Link to={`/szczenieta/${heaviest.p.id}`} className="list-item" style={{ color: 'inherit', marginBottom: 6, borderLeft: `4px solid ${heaviest.p.markerColor}` }}><div><small className="muted">NAJCIĘŻSZE SZCZENIĘ</small><div className="title">{heaviest.p.name}</div><small>Ostatni pomiar: {fmtDateTime(heaviest.last!.date)}</small></div><b style={{ fontSize: 18 }}>{heaviest.last!.grams} g</b></Link>}
          {lightest && <Link to={`/szczenieta/${lightest.p.id}`} className="list-item" style={{ color: 'inherit', borderLeft: `4px solid ${lightest.p.markerColor}` }}><div><small className="muted">NAJLŻEJSZE SZCZENIĘ</small><div className="title">{lightest.p.name}</div><small>Ostatni pomiar: {fmtDateTime(lightest.last!.date)}</small></div><b style={{ fontSize: 18 }}>{lightest.last!.grams} g</b></Link>}
          {rows.length - withW.length > 0 && <div className="badge gray" style={{ marginTop: 8 }}>ℹ️ Szczenięta bez pomiaru masy: {rows.length - withW.length}</div>}
        </Card>
        <Card title="Zmiana od poprzedniego pomiaru">
          <p className="muted">Porównanie dwóch ostatnich pomiarów każdego szczenięcia.</p>
          {bestGain && <div className="list-item" style={{ marginBottom: 6 }}><div><small className="muted">NAJWIĘKSZY WZROST</small><div className="title">{bestGain.p.name}</div></div><b style={{ color: 'var(--success)' }}>+{bestGain.diff} g</b></div>}
          {worstGain && <div className="list-item"><div><small className="muted">NAJMNIEJSZY WZROST</small><div className="title">{worstGain.p.name}</div></div><b style={{ color: worstGain.diff! < 0 ? 'var(--danger)' : undefined }}>{worstGain.diff! >= 0 ? '+' : ''}{worstGain.diff} g</b></div>}
          {!withD.length && <div className="muted">Potrzebne co najmniej dwa pomiary.</div>}
        </Card>
        <Card title="Wykres wag szczeniąt">
          <p className="muted">Porównaj rozwój wszystkich szczeniąt. Dotknij nazwy, aby ukryć lub pokazać linię.</p>
          {data.length < 2 ? <div className="muted">Za mało pomiarów.</div> : <div style={{ height: 260 }}><ResponsiveContainer><LineChart data={data}><CartesianGrid strokeDasharray="3 3" /><XAxis dataKey="d" fontSize={11} /><YAxis fontSize={11} unit=" g" domain={['auto', 'auto']} /><Tooltip /><Legend onClick={e => { const k = String(e.value); setHidden(h => h.includes(k) ? h.filter(x => x !== k) : [...h, k]); }} />{pups.map(p => <Line key={p.id} type="monotone" dataKey={p.name} stroke={p.markerColor} strokeWidth={2} hide={hidden.includes(p.name)} connectNulls />)}</LineChart></ResponsiveContainer></div>}
        </Card>
      </div>
    );
  }

  function PackEditor() {
    const [pack, setPack] = useState<LitterPack>(litter!.pack);
    const set = <K extends keyof LitterPack>(k: K, v: LitterPack[K]) => setPack({ ...pack, [k]: v });
    return (
      <div className="stack">
        <Card title="Informacje wspólne dla miotu"><p className="muted">Żywienie, pielęgnacja i zalecenia dotyczące wszystkich szczeniąt. Trafią do Paw ID każdego szczenięcia.</p>
          <h3>🍖 Żywienie</h3>
          <div className="form-grid">
            <Field label="Producent karmy"><input value={pack.foodBrand ?? ''} onChange={e => set('foodBrand', e.target.value)} /></Field>
            <Field label="Nazwa karmy"><input value={pack.foodName ?? ''} onChange={e => set('foodName', e.target.value)} /></Field>
            <Field label="Porcja"><input value={pack.portion ?? ''} onChange={e => set('portion', e.target.value)} placeholder="np. 75 g" /></Field>
            <Field label="Liczba posiłków dziennie"><div className="chips">{[2, 3, 4, 5].map(n => <button type="button" key={n} className={`chip ${pack.mealsPerDay === n ? 'on' : ''}`} onClick={() => set('mealsPerDay', n)}>{n}</button>)}</div></Field>
            <Field label="Godziny karmienia"><input value={pack.feedingHours ?? ''} onChange={e => set('feedingHours', e.target.value)} placeholder="np. 7, 11, 15, 19" /></Field>
          </div>
          <h3>💊 Suplementacja</h3><Field label="Informacje i zalecenia"><textarea value={pack.supplements ?? ''} onChange={e => set('supplements', e.target.value)} /></Field>
          <h3>🛁 Pielęgnacja</h3><Field label="Codzienna opieka i zalecenia"><textarea value={pack.grooming ?? ''} onChange={e => set('grooming', e.target.value)} /></Field>
          <h3>🏠 Pierwsze dni w nowym domu</h3><Field label="Wskazówki"><textarea value={pack.firstDays ?? ''} onChange={e => set('firstDays', e.target.value)} /></Field>
          <Field label="Z czym szczenięta są już oswojone?"><Chips options={ACCUSTOMED_ITEMS} value={pack.accustomed} onChange={v => set('accustomed', v)} /></Field>
          <button className="btn" onClick={() => { upsert('litters', { ...litter!, pack }); toast('Wyprawka zapisana'); }}>Zapisz wyprawkę</button>
        </Card>
        <Card title="Informacje o szczeniętach"><p className="muted">Charakter, socjalizacja i indywidualne przyzwyczajenia każdego szczenięcia uzupełnisz w metryce szczenięcia.</p><div className="list">{pups.map(p => <Link key={p.id} to={`/szczenieta/${p.id}?tab=pack`} className="list-item" style={{ color: 'inherit' }}><div className="row"><span style={{ color: p.markerColor, fontSize: 20 }}>🐾</span><div><div className="title">{p.name}</div><small>{p.character.length ? p.character.join(', ') : 'Informacje indywidualne – uzupełnij'}</small></div></div><span>→</span></Link>)}</div></Card>
      </div>
    );
  }

  function BulkWeight() {
    const [date, setDate] = useState(nowLocal());
    const [vals, setVals] = useState<Record<string, string>>({});
    return (
      <Modal title="Ważenie całego miotu" onClose={() => setBulkWeight(false)} actions={<><button className="btn secondary" onClick={() => setBulkWeight(false)}>Anuluj</button><button className="btn" onClick={() => { const items = pups.filter(p => vals[p.id]).map(p => ({ id: uid(), puppyId: p.id, date, grams: Number(vals[p.id]) })); dispatch({ type: 'bulk', fn: s => ({ ...s, weights: [...s.weights, ...items] }) }); setBulkWeight(false); toast(`Zapisano ${items.length} pomiarów`); }}>Zapisz</button></>}>
        <Field label="Data i godzina"><input type="datetime-local" value={date} onChange={e => setDate(e.target.value)} /></Field>
        {pups.map(p => <Field key={p.id} label={`${p.name} (g)`}><input type="number" value={vals[p.id] ?? ''} onChange={e => setVals({ ...vals, [p.id]: e.target.value })} placeholder={`ostatnio: ${lastWeights(p.id).pop()?.grams ?? '—'} g`} /></Field>)}
      </Modal>
    );
  }
}

export function useRemovePuppy() {
  const { dispatch } = useStore();
  return (id: string) => { if (!confirmDel('Usunąć szczenię i jego historię?')) return false; dispatch({ type: 'bulk', fn: s => ({ ...s, puppies: s.puppies.filter(p => p.id !== id), weights: s.weights.filter(w => w.puppyId !== id), health: s.health.filter(h => h.puppyId !== id) }) }); return true; };
}

export type { HealthKind };
