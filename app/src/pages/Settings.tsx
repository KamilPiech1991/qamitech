import { useRef, useState } from 'react';
import { useStore } from '../app/store';
import { Card, Field, PageHeader, ProBadge } from '../components/ui';
import { emptyState, demoState } from '../app/seed';
import { FREE_LIMITS, type AppState } from '../app/types';

export default function Settings() {
  const { state, setProfile, replace, toast } = useStore();
  const p = state.profile;
  const [form, setForm] = useState({ breederName: p.breederName, kennelName: p.kennelName, kennelNo: p.kennelNo ?? '', email: p.email ?? '' });
  const file = useRef<HTMLInputElement>(null);

  const exportJson = () => {
    const blob = new Blob([JSON.stringify(state, null, 2)], { type: 'application/json' });
    const a = document.createElement('a'); a.href = URL.createObjectURL(blob); a.download = `kennelo-backup-${new Date().toISOString().slice(0, 10)}.json`; a.click();
    toast('Kopia zapasowa pobrana');
  };
  const importJson = async (f: File) => {
    try { const data = JSON.parse(await f.text()) as AppState; if (!data.profile || !Array.isArray(data.dogs)) throw new Error('bad'); replace({ ...emptyState(), ...data }); toast('Dane przywrócone z kopii'); }
    catch { toast('Nieprawidłowy plik kopii zapasowej'); }
  };

  return (
    <div className="stack">
      <PageHeader title="Ustawienia" />
      <Card title="Profil i hodowla">
        <div className="form-grid">
          <Field label="Imię"><input value={form.breederName} onChange={e => setForm({ ...form, breederName: e.target.value })} /></Field>
          <Field label="E-mail"><input value={form.email} onChange={e => setForm({ ...form, email: e.target.value })} /></Field>
          {p.module === 'breeder' && <>
            <Field label="Nazwa hodowli"><input value={form.kennelName} onChange={e => setForm({ ...form, kennelName: e.target.value })} /></Field>
            <Field label="Numer hodowli"><input value={form.kennelNo} onChange={e => setForm({ ...form, kennelNo: e.target.value })} /></Field>
          </>}
        </div>
        <button className="btn" onClick={() => { setProfile(form); toast('Zapisano profil'); }}>Zapisz</button>
      </Card>

      <Card title="Moduł aplikacji">
        <p className="muted">Właściciel: zdrowie, finanse, przypomnienia. Hodowca: dodatkowo rozród, mioty, szczenięta, Paw ID, raporty hodowlane.</p>
        <div className="row">
          <button className={`btn ${p.module === 'owner' ? '' : 'secondary'}`} onClick={() => setProfile({ module: 'owner' })}>🐶 Właściciel</button>
          <button className={`btn ${p.module === 'breeder' ? '' : 'secondary'}`} onClick={() => setProfile({ module: 'breeder' })}>🐾 Hodowca</button>
        </div>
      </Card>

      <Card title="Plan" right={p.plan === 'pro' ? <ProBadge /> : <span className="badge gray">FREE</span>}>
        <div className="grid cols-2 stack-m">
          <div className="card soft"><b>FREE – 0 zł</b><ul className="muted" style={{ paddingLeft: 18 }}><li>do {FREE_LIMITS.females} suk i {FREE_LIMITS.males} psów</li><li>do {FREE_LIMITS.shows} wystaw, {FREE_LIMITS.championships} championatów</li><li>wykres wydatków: {FREE_LIMITS.chartMonths} z 6 miesięcy</li></ul></div>
          <div className="card soft"><b>PRO – 99 zł/rok lub 13,99 zł/mies.</b><ul className="muted" style={{ paddingLeft: 18 }}><li>bez limitów psów, wystaw i championatów</li><li>pełne wykresy i raporty PDF</li><li>synchronizacja w chmurze (w przygotowaniu)</li></ul></div>
        </div>
        <div className="row" style={{ marginTop: 10 }}>
          <button className="btn" onClick={() => { setProfile({ plan: p.plan === 'pro' ? 'free' : 'pro' }); toast(p.plan === 'pro' ? 'Przełączono na FREE' : 'Aktywowano PRO (tryb demo)'); }}>{p.plan === 'pro' ? 'Przełącz na FREE (demo)' : 'Aktywuj PRO (demo)'}</button>
          <small className="muted">W wersji produkcyjnej płatność przez Google Play / App Store / Stripe.</small>
        </div>
      </Card>

      <Card title="Kopie zapasowe i dane">
        <p className="muted">Dane są przechowywane lokalnie na tym urządzeniu. Pobierz kopię, aby przenieść je lub zabezpieczyć.</p>
        <div className="row">
          <button className="btn secondary" onClick={exportJson}>⬇️ Pobierz kopię (JSON)</button>
          <button className="btn secondary" onClick={() => file.current?.click()}>⬆️ Przywróć z kopii</button>
          <input ref={file} type="file" accept="application/json" hidden onChange={e => e.target.files?.[0] && importJson(e.target.files[0])} />
          <button className="btn secondary" onClick={() => { if (confirm('Załadować dane demonstracyjne? Obecne dane zostaną nadpisane.')) { replace(demoState()); toast('Załadowano dane demo'); } }}>Dane demo</button>
          <button className="btn danger" onClick={() => { if (confirm('Usunąć WSZYSTKIE dane z tego urządzenia?')) { replace(emptyState()); } }}>Usuń wszystkie dane</button>
        </div>
      </Card>

      <Card title="O aplikacji">
        <p className="muted">Wersja prototypowa 0.1 (web). Ta sama baza kodu zostanie opakowana w aplikację Android/iOS. Dane zdrowotne mają charakter ewidencyjny – w sprawach zdrowia konsultuj się z lekarzem weterynarii.</p>
      </Card>
    </div>
  );
}
