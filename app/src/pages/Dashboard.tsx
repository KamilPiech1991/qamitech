import { Link, useNavigate } from 'react-router-dom';
import { Bell, Dog, PawPrint, Trophy, Wallet, BarChart3, QrCode, Heart, FileText, Flower2, ArrowRight } from 'lucide-react';
import { useStore } from '../app/store';
import { Card } from '../components/ui';
import { addDays, daysBetween, fmtDate, today } from '../app/format';
import { HEALTH_LABEL } from '../app/types';
import { heatStats } from '../app/heat';

export default function Dashboard() {
  const { state } = useStore();
  const nav = useNavigate();
  const p = state.profile;
  const breeder = p.module === 'breeder';
  const t = today();
  const horizon = addDays(t, 14);
  const dogName = (id?: string) => state.dogs.find(d => d.id === id)?.name;
  const heatSoon = state.dogs.filter(d => d.sex === 'female').map(d => ({ d, s: heatStats(state.heats.filter(h => h.dogId === d.id)) })).filter(x => x.s && x.s.nextFrom <= addDays(t, 30) && x.s.nextTo >= t);
  const upcoming = [
    ...state.reminders.filter(r => !r.done && r.date <= horizon).map(r => ({ date: r.date, title: r.title, sub: dogName(r.dogId) ?? r.notes ?? '', to: '/przypomnienia' })),
    ...state.health.filter(h => h.nextDate && h.nextDate <= horizon && h.dogId).map(h => ({ date: h.nextDate!, title: `${HEALTH_LABEL[h.kind]}: ${h.name}`, sub: dogName(h.dogId) ?? '', to: `/psy/${h.dogId}?tab=health` })),
    ...heatSoon.map(x => ({ date: x.s!.next, title: `Spodziewana cieczka: ${x.d.name}`, sub: `okno ${fmtDate(x.s!.nextFrom)} – ${fmtDate(x.s!.nextTo)}`, to: `/psy/${x.d.id}?tab=breeding` })),
  ].sort((a, b) => a.date.localeCompare(b.date)).slice(0, 6);
  const females = state.dogs.filter(d => d.sex === 'female').length;
  const males = state.dogs.filter(d => d.sex === 'male').length;
  const activePreg = state.breedings.filter(b => !b.litterId && b.matings.length && daysBetween(b.matings[0].date, t) < 70);
  const monthExp = state.expenses.filter(e => e.date.slice(0, 7) === t.slice(0, 7)).reduce((a, e) => a + e.amount, 0);
  const hour = new Date().getHours();
  const greet = hour < 12 ? 'Dzień dobry' : hour < 18 ? 'Cześć' : 'Dobry wieczór';

  return (
    <div className="stack">
      <div className="hero">
        <div className="row between" style={{ position: 'relative' }}>
          <div>
            <div className="muted" style={{ fontWeight: 800, fontSize: 13 }}>{greet}</div>
            <h1>{p.breederName}{breeder && p.kennelName ? '' : '!'}</h1>
            {breeder && <div style={{ fontSize: 15, fontWeight: 700, opacity: .95 }}>{p.kennelName}{p.kennelNo ? ` · nr ${p.kennelNo}` : ''}</div>}
            <div className="muted" style={{ marginTop: 6 }}>Psy śpią czy wariują?</div>
          </div>
          <span className={`badge ${p.plan === 'pro' ? 'pro' : ''}`} style={p.plan !== 'pro' ? { background: 'rgba(255,255,255,.2)', color: '#fff' } : undefined}>{p.plan.toUpperCase()}</span>
        </div>
      </div>

      <Card title="Najbliższe terminy" icon={<Bell size={18} />} right={<Link to="/przypomnienia" className="muted" style={{ display: 'flex', alignItems: 'center', gap: 4 }}>Wszystkie <ArrowRight size={14} /></Link>}>
        {upcoming.length === 0 ? <div className="muted">Brak nadchodzących terminów w ciągu 14 dni. Odpocznij z psami.</div> : (
          <div className="list">{upcoming.map((u, i) => (
            <Link key={i} to={u.to} className="list-item" style={{ color: 'inherit' }}>
              <div><div className="title">{u.title}</div><small>{u.sub}</small></div>
              <span className={`badge ${u.date < t ? 'danger' : daysBetween(t, u.date) <= 3 ? 'warn' : ''}`}>{u.date < t ? 'Zaległe' : daysBetween(t, u.date) === 0 ? 'Dziś' : daysBetween(t, u.date) === 1 ? 'Jutro' : fmtDate(u.date)}</span>
            </Link>))}</div>
        )}
      </Card>

      <div className="grid cols-2">
        <a className="tile" onClick={() => nav('/psy?sex=female')}><div className="ico"><Dog size={24} /></div><div><div className="value">{females}</div><div className="label">{females === 1 ? 'Moja suka' : 'Moje suki'}</div></div></a>
        <a className="tile" onClick={() => nav('/psy?sex=male')}><div className="ico"><Dog size={24} /></div><div><div className="value">{males}</div><div className="label">{males === 1 ? 'Mój pies' : 'Moje psy'}</div></div></a>
        {breeder && <a className="tile" onClick={() => nav('/mioty')}><div className="ico"><PawPrint size={24} /></div><div><div className="value">{state.litters.length}</div><div className="label">{state.litters.length === 1 ? 'Miot' : 'Mioty'} · {state.puppies.length} szczeniąt</div></div></a>}
        <a className="tile" onClick={() => nav('/finanse')}><div className="ico"><Wallet size={24} /></div><div><div className="value">{Math.round(monthExp)} zł</div><div className="label">Wydatki w tym miesiącu</div></div></a>
        {!breeder && <a className="tile" onClick={() => nav('/psy')}><div className="ico"><Trophy size={24} /></div><div><div className="value">{state.shows.length}</div><div className="label">Wystawy</div></div></a>}
      </div>

      {breeder && activePreg.length > 0 && activePreg.map(b => { const f = state.dogs.find(d => d.id === b.femaleId); const day = daysBetween(b.matings[0].date, t) + 1; const expected = addDays(b.matings[0].date, 62); return (
        <Link key={b.id} to={`/ciaza/${b.id}`} className="hero" style={{ display: 'block' }}>
          <div className="row between"><div className="muted" style={{ fontWeight: 800 }}><Heart size={14} style={{ verticalAlign: -2 }} /> Trwająca ciąża · {f?.name} × {b.maleName}</div><ArrowRight size={18} /></div>
          <div style={{ fontSize: 24, fontWeight: 900, margin: '6px 0' }}>{day}. dzień · {Math.ceil(day / 7)}. tydzień</div>
          <div className="progress"><div style={{ width: `${Math.min(100, (day / 63) * 100)}%` }} /></div>
          <div className="muted" style={{ marginTop: 6, fontWeight: 700 }}>Przewidywany poród: {fmtDate(expected)} · zostało {63 - day} dni</div>
        </Link>); })}

      <div>
        <h3>Szybki dostęp</h3>
        <div className="grid cols-3">
          <Card onClick={() => nav('/psy')} icon={<Trophy size={18} />} title="Kariera"><div className="muted">{state.shows.length} wystaw · {state.championships.length} championatów</div></Card>
          {breeder && <Card onClick={() => nav('/dokumenty')} icon={<FileText size={18} />} title="Dokumenty"><div className="muted">Umowy, protokoły, karta miotu</div></Card>}
          <Card onClick={() => nav('/raporty')} icon={<BarChart3 size={18} />} title="Raporty"><div className="muted">Zestawienia i PDF</div></Card>
          <Card onClick={() => nav('/przypomnienia')} icon={<Bell size={18} />} title="Przypomnienia"><div className="muted">{state.reminders.filter(r => !r.done).length} aktywnych</div></Card>
          <Card onClick={() => nav('/skanuj')} icon={<QrCode size={18} />} title="Skanuj Paw ID"><div className="muted">Odbierz dane szczenięcia</div></Card>
          {breeder && <Card onClick={() => nav('/psy?sex=female')} icon={<Flower2 size={18} />} title="Cieczki"><div className="muted">{heatSoon.length ? `${heatSoon.length} spodziewane wkrótce` : 'Kalendarz i prognoza'}</div></Card>}
        </div>
      </div>
    </div>
  );
}
