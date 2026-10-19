import { NavLink, Outlet } from 'react-router-dom';
import { useStore } from '../app/store';
import { APP_NAME } from './ui';

export default function Layout() {
  const { state } = useStore();
  const breeder = state.profile.module === 'breeder';
  const items = [
    { to: '/', label: 'Start', ico: '🏠' },
    { to: '/psy', label: 'Psy', ico: '🐕' },
    ...(breeder ? [{ to: '/mioty', label: 'Mioty', ico: '🐾' }] : []),
    { to: '/finanse', label: 'Finanse', ico: '💰' },
    { to: '/raporty', label: 'Raporty', ico: '📊' },
    { to: '/ustawienia', label: 'Ustawienia', ico: '⚙️' },
  ];
  const side = [...items.slice(0, -1), { to: '/przypomnienia', label: 'Przypomnienia', ico: '🔔' }, { to: '/skanuj', label: 'Skanuj Paw ID', ico: '🔳' }, items[items.length - 1]];
  return (
    <div className="shell">
      <aside className="sidebar">
        <div className="brand"><div className="logo">🐾</div>{APP_NAME}</div>
        {side.map(i => <NavLink key={i.to} to={i.to} end={i.to === '/'} className={({ isActive }) => `navlink ${isActive ? 'active' : ''}`}><span className="ico">{i.ico}</span>{i.label}</NavLink>)}
        <div className="spacer" />
        <div className="muted" style={{ padding: 10 }}>
          <div><b>{state.profile.kennelName || state.profile.breederName}</b></div>
          <div>Moduł: {breeder ? 'Hodowca' : 'Właściciel'} · Plan: {state.profile.plan.toUpperCase()}</div>
        </div>
      </aside>
      <main className="main"><Outlet /></main>
      <nav className="bottomnav">
        {items.map(i => <NavLink key={i.to} to={i.to} end={i.to === '/'} className={({ isActive }) => (isActive ? 'active' : '')}><span className="ico">{i.ico}</span>{i.label}</NavLink>)}
      </nav>
    </div>
  );
}
