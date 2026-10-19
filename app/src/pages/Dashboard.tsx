import { Link, useNavigate } from 'react-router-dom';
import { useStore } from '../app/store';
import { Card } from '../components/ui';
import { addDays, daysBetween, fmtDate, today } from '../app/format';
import { HEALTH_LABEL } from '../app/types';

export default function Dashboard() {
  const { state } = useStore();
  const nav = useNavigate();
  const p = state.profile;
  const breeder = p.module === 'breeder';
  const t = today();
  const horizon = addDays(t, 14);
  const dogName = (id?: string) => state.dogs.find(d => d.id === id)?.name;
  const upcoming = [
    ...state.reminders.filter(r => !r.done && r.date <= horizon).map(r => ({ date: r.date, title: r.title, sub: dogName(r.dogId) ?? r.notes ?? '', to: '/przypomnienia' })),
    ...state.health.filter(h => h.nextDate && h.nextDate <= horizon && h.dogId).map(h => ({ date: h.nextDate!, title: `${HEALTH_LABEL[h.kind]}: ${h.name}`, sub: dogName(h.dogId) ?? '', to: `/psy/${h.dogId}` })),
  ].sort((a, b) => a.date.localeCompare(b.date)).slice(0, 6);
  const females = state.dogs.filter(d => d.sex === 'female').length;
  const males = state.dogs.filter(d => d.sex === 'male').length;
  const activePreg = state.breedings.filter(b => !b.litterId && b.matings.length && daysBetween(b.matings[0].date, t) < 70);
  const hour = new Date().getHours();
  const greet = hour < 12 ? 'Dzień dobry' : hour < 18 ? 'Cześć' : 'Dobry wieczór';

  return (
    <div className="stack">
      <div className="hero">
        <div className="row between">
          <div>
            {breeder && <div className="muted" style={{ textTransform: 'uppercase', fontSize: 12, letterSpacing: 1 }}>Hodowla</div>}
            <h1 style={{ color: '#fff' }}>{breeder && p.kennelName ? p.kennelName : `${greet}, ${p.breederName}!`}</h1>
            {breeder && p.kennelNo && <div className="muted">Numer hodowli: {p.kennelNo}</div>}
            {breeder && <div style={{ marginTop: 6 }}>{greet}, {p.breederName}! Psy śpią czy wariują?</div>}
          </div>
          <span className={`badge ${p.plan === 'pro' ? 'pro' : 'gray'}`}>{p.plan.toUpperCase()}</span>
        </div>
      </div>

      <Card title="🔔 Powiadomienia" right={<Link to="/przypomnienia" className="muted">Wszystkie →</Link>}>
        {upcoming.length === 0 ? <div className="muted">Brak nadchodzących terminów w ciągu 14 dni.</div> : (
          <div className="list">{upcoming.map((u, i) => (
            <Link key={i} to={u.to} className="list-item" style={{ color: 'inherit' }}>
              <div><div className="title">{u.title}</div><small>{u.sub}</small></div>
              <span className={`badge ${u.date < t ? 'danger' : daysBetween(t, u.date) <= 3 ? 'warn' : ''}`}>{u.date < t ? 'Zaległe' : fmtDate(u.date)}</span>
            </Link>))}</div>
        )}
      </Card>

      <div>
        <h3>Twoje psy</h3>
        <div className="grid cols-2">
          <Card onClick={() => nav('/psy?sex=female')}><div className="stat"><div style={{ fontSize: 26 }}>♀</div><div className="value">{females}</div><div className="label">Moje suki</div></div></Card>
          <Card onClick={() => nav('/psy?sex=male')}><div className="stat"><div style={{ fontSize: 26 }}>♂</div><div className="value">{males}</div><div className="label">Moje psy</div></div></Card>
        </div>
      </div>

      {breeder && activePreg.length > 0 && (
        <Card title="🤰 Trwające ciąże">
          <div className="list">{activePreg.map(b => { const f = state.dogs.find(d => d.id === b.femaleId); const day = daysBetween(b.matings[0].date, t) + 1; return (
            <Link key={b.id} to={`/ciaza/${b.id}`} className="list-item" style={{ color: 'inherit' }}><div><div className="title">{f?.name} × {b.maleName}</div><small>{day}. dzień ciąży · {Math.ceil(day / 7)}. tydzień</small></div><span className="badge">Kalendarz →</span></Link>); })}</div>
        </Card>
      )}

      <div>
        <h3>Szybki dostęp</h3>
        <div className="grid cols-3">
          <Card onClick={() => nav('/psy')}><div style={{ fontSize: 26 }}>🏆</div><b>Kariera</b><div className="muted">{state.shows.length} wystaw · {state.championships.length} championatów</div></Card>
          {breeder && <Card onClick={() => nav('/mioty')}><div style={{ fontSize: 26 }}>🐾</div><b>Mioty</b><div className="muted">{state.litters.length} miotów · {state.puppies.length} szczeniąt</div></Card>}
          <Card onClick={() => nav('/finanse')}><div style={{ fontSize: 26 }}>💰</div><b>Finanse</b><div className="muted">{state.expenses.length} wpisów</div></Card>
          <Card onClick={() => nav('/raporty')}><div style={{ fontSize: 26 }}>📊</div><b>Raporty</b><div className="muted">Zestawienia i PDF</div></Card>
          <Card onClick={() => nav('/przypomnienia')}><div style={{ fontSize: 26 }}>🔔</div><b>Przypomnienia</b><div className="muted">{state.reminders.filter(r => !r.done).length} aktywnych</div></Card>
          <Card onClick={() => nav('/skanuj')}><div style={{ fontSize: 26 }}>🔳</div><b>Skanuj Paw ID</b><div className="muted">Odbierz dane szczenięcia</div></Card>
        </div>
      </div>
    </div>
  );
}
