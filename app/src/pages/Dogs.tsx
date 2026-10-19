import { useState } from 'react';
import { Link, useNavigate, useSearchParams } from 'react-router-dom';
import { useStore } from '../app/store';
import { Card, Empty, PageHeader, ProBadge, sexIcon } from '../components/ui';
import DogForm from '../components/DogForm';
import { ageText } from '../app/format';
import { FREE_LIMITS } from '../app/types';

export default function Dogs() {
  const { state, upsert, limits, toast } = useStore();
  const nav = useNavigate();
  const [params, setParams] = useSearchParams();
  const sexFilter = params.get('sex');
  const [compact, setCompact] = useState(false);
  const [adding, setAdding] = useState(false);
  const dogs = state.dogs.filter(d => !sexFilter || d.sex === sexFilter).sort((a, b) => a.name.localeCompare(b.name));
  const breeder = state.profile.module === 'breeder';
  const females = state.dogs.filter(d => d.sex === 'female').length, males = state.dogs.filter(d => d.sex === 'male').length;
  const nearLimit = !limits.isPro && (females >= FREE_LIMITS.females || males >= FREE_LIMITS.males);

  return (
    <div>
      <PageHeader title="Moje psy" sub={`${females} ${females === 1 ? 'suka' : 'suk'} · ${males} ${males === 1 ? 'pies' : 'psów'}`} actions={<button className="btn" onClick={() => setAdding(true)}>+ Dodaj psa</button>} />
      <div className="row between no-print" style={{ marginBottom: 12 }}>
        <div className="tabs" style={{ margin: 0, padding: 0 }}>
          <button className={!sexFilter ? 'active' : ''} onClick={() => setParams({})}>Wszystkie</button>
          <button className={sexFilter === 'female' ? 'active' : ''} onClick={() => setParams({ sex: 'female' })}>Suki</button>
          <button className={sexFilter === 'male' ? 'active' : ''} onClick={() => setParams({ sex: 'male' })}>Psy</button>
        </div>
        <div className="tabs" style={{ margin: 0, padding: 0 }}>
          <button className={!compact ? 'active' : ''} onClick={() => setCompact(false)}>Widok pełny</button>
          <button className={compact ? 'active' : ''} onClick={() => setCompact(true)}>Widok kompaktowy</button>
        </div>
      </div>
      {nearLimit && <div className="card soft" style={{ marginBottom: 12 }}><div className="row between"><span>Plan FREE: do {FREE_LIMITS.females} suk i {FREE_LIMITS.males} psów. <ProBadge /> znosi limity.</span><Link to="/ustawienia" className="btn sm">Zobacz PRO</Link></div></div>}
      {dogs.length === 0 ? <Card><Empty>Nie masz jeszcze psów. Dodaj pierwszego lub zeskanuj Paw ID od hodowcy.</Empty></Card> : (
        <div className="stack">
          {dogs.map(d => (
            <Card key={d.id} onClick={() => nav(`/psy/${d.id}`)}>
              <div className="row" style={{ alignItems: 'flex-start' }}>
                <div className="avatar">{d.photo ? <img src={d.photo} alt="" /> : '🐕'}</div>
                <div style={{ flex: 1, minWidth: 0 }}>
                  <div className="row between"><div><b style={{ fontSize: 17 }}>{d.name}</b> <span className="muted">({d.pedigreeName})</span></div><span className="badge gray">{sexIcon(d.sex)} {d.sex === 'male' ? 'Pies' : 'Suka'}</span></div>
                  <div className="muted">{d.breed}</div>
                  <div className="muted">Wiek: {ageText(d.birthDate)}</div>
                </div>
              </div>
              {!compact && (
                <div className="row" style={{ marginTop: 12, gap: 6 }} onClick={e => e.stopPropagation()}>
                  <Link className="btn secondary sm" to={`/psy/${d.id}?tab=health`}>💉 Zdrowie</Link>
                  {breeder && <Link className="btn secondary sm" to={`/psy/${d.id}?tab=breeding`}>{d.sex === 'female' ? '🤰 Rozród' : '❤️ Krycia'}</Link>}
                  <Link className="btn secondary sm" to={`/psy/${d.id}?tab=career`}>🏆 Kariera</Link>
                  <Link className="btn secondary sm" to={`/psy/${d.id}?tab=weight`}>⚖️ Waga</Link>
                  <Link className="btn secondary sm" to={`/psy/${d.id}?tab=timeline`}>🕒 Oś czasu</Link>
                </div>
              )}
            </Card>
          ))}
        </div>
      )}
      {adding && <DogForm onClose={() => setAdding(false)} onSave={d => { if (!limits.canAddDog(d.sex)) { toast('Limit planu FREE osiągnięty. Przejdź na PRO, aby dodać więcej psów.'); return; } upsert('dogs', d); setAdding(false); toast('Pies dodany'); nav(`/psy/${d.id}`); }} />}
    </div>
  );
}
