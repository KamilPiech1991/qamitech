import { useEffect, type ReactNode } from 'react';

export const APP_NAME = 'Kennelo';

export function PageHeader({ title, sub, actions, back }: { title: string; sub?: ReactNode; actions?: ReactNode; back?: () => void }) {
  return (
    <div className="page-header">
      <div className="row">
        {back && <button className="icon-btn no-print" onClick={back} aria-label="Wstecz">←</button>}
        <div><h1>{title}</h1>{sub && <div className="sub">{sub}</div>}</div>
      </div>
      {actions && <div className="row no-print">{actions}</div>}
    </div>
  );
}

export function Card({ children, className = '', onClick, title, right }: { children?: ReactNode; className?: string; onClick?: () => void; title?: ReactNode; right?: ReactNode }) {
  return (
    <div className={`card ${onClick ? 'clickable' : ''} ${className}`} onClick={onClick}>
      {(title || right) && <div className="row between" style={{ marginBottom: 10 }}><h3 style={{ margin: 0 }}>{title}</h3>{right}</div>}
      {children}
    </div>
  );
}

export function Field({ label, children, hint }: { label: string; children: ReactNode; hint?: string }) {
  return <div className="field"><label>{label}</label>{children}{hint && <small>{hint}</small>}</div>;
}

export function Modal({ title, onClose, children, actions, wide }: { title: string; onClose: () => void; children: ReactNode; actions?: ReactNode; wide?: boolean }) {
  useEffect(() => { const h = (e: KeyboardEvent) => e.key === 'Escape' && onClose(); window.addEventListener('keydown', h); return () => window.removeEventListener('keydown', h); }, [onClose]);
  return (
    <div className="modal-backdrop" onMouseDown={e => e.target === e.currentTarget && onClose()}>
      <div className="modal" style={wide ? { maxWidth: 860 } : undefined} role="dialog" aria-modal="true">
        <div className="row between"><h2>{title}</h2><button className="icon-btn" onClick={onClose} aria-label="Zamknij">✕</button></div>
        {children}
        {actions && <div className="actions">{actions}</div>}
      </div>
    </div>
  );
}

export function Tabs<T extends string>({ value, onChange, items }: { value: T; onChange: (v: T) => void; items: { key: T; label: string }[] }) {
  return <div className="tabs no-print">{items.map(i => <button key={i.key} className={i.key === value ? 'active' : ''} onClick={() => onChange(i.key)}>{i.label}</button>)}</div>;
}

export function Empty({ children }: { children: ReactNode }) { return <div className="empty">{children}</div>; }

export function Stat({ value, label, icon }: { value: ReactNode; label: string; icon?: string }) {
  return <div className="card stat">{icon && <div style={{ fontSize: 22 }}>{icon}</div>}<div className="value">{value}</div><div className="label">{label}</div></div>;
}

export function KV({ items }: { items: [string, ReactNode][] }) {
  return <dl className="kv">{items.map(([k, v]) => <div key={k} style={{ display: 'contents' }}><dt>{k}</dt><dd>{v ?? '—'}</dd></div>)}</dl>;
}

export function Chips({ options, value, onChange }: { options: string[]; value: string[]; onChange: (v: string[]) => void }) {
  return <div className="chips">{options.map(o => <button type="button" key={o} className={`chip ${value.includes(o) ? 'on' : ''}`} onClick={() => onChange(value.includes(o) ? value.filter(x => x !== o) : [...value, o])}>{o}</button>)}</div>;
}

export function ProBadge() { return <span className="badge pro">PRO</span>; }

export function confirmDel(msg = 'Na pewno usunąć ten wpis?') { return window.confirm(msg); }

export const sexIcon = (s: 'male' | 'female') => (s === 'male' ? '♂' : '♀');
export const sexLabel = (s: 'male' | 'female') => (s === 'male' ? 'Pies' : 'Suka');
