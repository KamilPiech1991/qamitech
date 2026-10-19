import { useState } from 'react';
import { PawPrint, Plus } from 'lucide-react';
import { useNavigate } from 'react-router-dom';
import { useStore } from '../app/store';
import { Card, Empty, Field, Modal, confirmDel, DelBtn } from '../components/ui';
import { ArtHeader } from '../components/ui';
import { PawPrint as ArtIcon } from 'lucide-react';
import { fmtDate, today, uid } from '../app/format';
import type { Litter } from '../app/types';

export function LitterForm({ initial, onClose, onSave }: { initial?: Litter; onClose: () => void; onSave: (l: Litter) => void }) {
  const { state } = useStore();
  const [l, setL] = useState<Litter>(initial ?? { id: uid(), name: '', motherName: '', fatherName: '', birthDate: today(), notes: [], checklist: {}, pack: { accustomed: [] }, birthDiary: [], createdAt: today() });
  const females = state.dogs.filter(d => d.sex === 'female'), males = state.dogs.filter(d => d.sex === 'male');
  const breedings = state.breedings.filter(b => b.femaleId === l.motherId);
  return (
    <Modal title={initial ? 'Edytuj miot' : 'Nowy miot'} onClose={onClose} actions={<><button className="btn secondary" onClick={onClose}>Anuluj</button><button className="btn" disabled={!l.name.trim() || !l.motherName.trim() || !l.birthDate} onClick={() => onSave(l)}>Zapisz</button></>}>
      <div className="form-grid">
        <Field label="Nazwa / oznaczenie miotu *"><input value={l.name} onChange={e => setL({ ...l, name: e.target.value })} placeholder="np. Miot D" /></Field>
        <Field label="Data urodzenia *"><input type="date" value={l.birthDate} onChange={e => setL({ ...l, birthDate: e.target.value })} /></Field>
        <Field label="Matka (z moich suk)"><select value={l.motherId ?? ''} onChange={e => { const d = females.find(f => f.id === e.target.value); setL({ ...l, motherId: d?.id, motherName: d ? d.pedigreeName : l.motherName }); }}><option value="">— wpisz ręcznie —</option>{females.map(f => <option key={f.id} value={f.id}>{f.name}</option>)}</select></Field>
        <Field label="Matka (nazwa) *"><input value={l.motherName} onChange={e => setL({ ...l, motherName: e.target.value })} /></Field>
        <Field label="Ojciec (z moich psów)"><select value={l.fatherId ?? ''} onChange={e => { const d = males.find(f => f.id === e.target.value); setL({ ...l, fatherId: d?.id, fatherName: d ? d.pedigreeName : l.fatherName }); }}><option value="">— wpisz ręcznie —</option>{males.map(f => <option key={f.id} value={f.id}>{f.name}</option>)}</select></Field>
        <Field label="Ojciec (nazwa)"><input value={l.fatherName} onChange={e => setL({ ...l, fatherName: e.target.value })} /></Field>
        {breedings.length > 0 && <Field label="Powiązane skojarzenie"><select value={l.breedingId ?? ''} onChange={e => setL({ ...l, breedingId: e.target.value || undefined })}><option value="">—</option>{breedings.map(b => <option key={b.id} value={b.id}>{b.maleName} – {fmtDate(b.matings[0]?.date)}</option>)}</select></Field>}
      </div>
    </Modal>
  );
}

export default function Litters() {
  const { state, upsert, dispatch, toast } = useStore();
  const nav = useNavigate();
  const [adding, setAdding] = useState(false);
  const litters = [...state.litters].sort((a, b) => b.birthDate.localeCompare(a.birthDate));
  const del = (id: string) => { if (!confirmDel('Usunąć miot wraz ze szczeniętami?')) return; dispatch({ type: 'bulk', fn: s => { const pids = s.puppies.filter(p => p.litterId === id).map(p => p.id); return { ...s, litters: s.litters.filter(l => l.id !== id), puppies: s.puppies.filter(p => p.litterId !== id), weights: s.weights.filter(w => !w.puppyId || !pids.includes(w.puppyId)), health: s.health.filter(h => !h.puppyId || !pids.includes(h.puppyId)), breedings: s.breedings.map(b => b.litterId === id ? { ...b, litterId: undefined } : b) }; } }); };
  return (
    <div>
      <ArtHeader compact tone="green" icon={<ArtIcon size={24} />} title="Mioty" sub="Wszystkie mioty hodowli" actions={<button className="btn" onClick={() => setAdding(true)}><Plus size={18} /> Nowy miot</button>} />
      {litters.length === 0 ? <Card><Empty icon={<PawPrint size={28} />}>Brak miotów. Dodaj pierwszy miot, aby prowadzić metrykę szczeniąt.</Empty></Card> : (
        <div className="stack">{litters.map(l => { const pups = state.puppies.filter(p => p.litterId === l.id); return (
          <Card key={l.id} onClick={() => nav(`/mioty/${l.id}`)}>
            <div className="row between">
              <div><b style={{ fontSize: 18, color: 'var(--primary-600)' }}>{l.name}</b><div className="muted">Ur. {fmtDate(l.birthDate)}</div><div><span className="muted">Ojciec:</span> {l.fatherName || '—'}</div><div><span className="muted">Matka:</span> {l.motherName}</div><div><span className="muted">Liczba szczeniąt:</span> <b>{pups.length}</b> ({pups.filter(p => p.sex === 'male').length} ♂ / {pups.filter(p => p.sex === 'female').length} ♀)</div></div>
              <DelBtn onClick={() => del(l.id)} />
            </div>
          </Card>); })}</div>
      )}
      {adding && <LitterForm onClose={() => setAdding(false)} onSave={l => { upsert('litters', l); if (l.breedingId) { const b = state.breedings.find(x => x.id === l.breedingId); if (b) upsert('breedings', { ...b, litterId: l.id }); } setAdding(false); toast('Miot dodany'); nav(`/mioty/${l.id}`); }} />}
    </div>
  );
}
