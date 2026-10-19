import { useRef, useState } from 'react';
import { Users, Download, Upload, Moon, Sun, Shield, Plus } from 'lucide-react';
import { useStore } from '../app/store';
import { Card, Field, ProBadge, Switch, DelBtn, Modal } from '../components/ui';
import { ArtHeader } from '../components/ui';
import { Settings as ArtIcon } from 'lucide-react';
import { emptyState, demoState } from '../app/seed';
import { FREE_LIMITS, type AppState, type Member } from '../app/types';
import { uid } from '../app/format';

export default function Settings() {
  const { state, setProfile, replace, toast, upsert, remove } = useStore();
  const p = state.profile;
  const [form, setForm] = useState({ breederName: p.breederName, kennelName: p.kennelName, kennelNo: p.kennelNo ?? '', email: p.email ?? '' });
  const [invite, setInvite] = useState<Member | null>(null);
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
  const roleLabel = { owner: 'Właściciel hodowli', editor: 'Współpracownik (edycja)', viewer: 'Podgląd (np. weterynarz)' };

  return (
    <div className="stack">
      <ArtHeader compact tone="slate" icon={<ArtIcon size={24} />} title="Ustawienia" sub="Profil, zespół, plan i dane" />
      <Card title="Wygląd" icon={p.darkMode ? <Moon size={18} /> : <Sun size={18} />}>
        <div className="row between"><div><b>Tryb ciemny</b><div className="muted">Oszczędza wzrok wieczorem przy porodzie.</div></div><Switch on={!!p.darkMode} onChange={v => setProfile({ darkMode: v })} label="Tryb ciemny" /></div>
      </Card>
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

      {p.module === 'breeder' && (
        <Card title="Zespół hodowli" icon={<Users size={18} />} right={<button className="btn sm" onClick={() => setInvite({ id: uid(), name: '', email: '', role: 'editor', status: 'invited' })}><Plus size={14} /> Zaproś</button>}>
          <p className="muted">Współwłaściciele, rodzina i lekarz weterynarii mogą pracować na tej samej hodowli z własnymi kontami.</p>
          <div className="list">{state.members.map(m => <div key={m.id} className="list-item"><div><div className="title">{m.name || m.email}</div><small>{m.email} · {roleLabel[m.role]}</small></div><div className="row"><span className={`badge ${m.status === 'active' ? 'success' : 'warn'}`}>{m.status === 'active' ? 'aktywny' : 'zaproszony'}</span>{m.role !== 'owner' && <DelBtn onClick={() => remove('members', m.id)} />}</div></div>)}</div>
          <small className="muted">Prototyp: zaproszenia są zapisywane lokalnie. W wersji produkcyjnej zaproszenie trafia e-mailem, a uprawnienia egzekwuje backend.</small>
        </Card>
      )}

      <Card title="Tryb pracy">
        <p className="muted">Mam psa: zdrowie, wydatki, przypomnienia. Prowadzę hodowlę: dodatkowo rozród, mioty, szczenięta, karty przekazania, dokumenty i raporty hodowlane.</p>
        <div className="row">
          <button className={`btn ${p.module === 'owner' ? '' : 'secondary'}`} onClick={() => setProfile({ module: 'owner' })}>Mam psa</button>
          <button className={`btn ${p.module === 'breeder' ? '' : 'secondary'}`} onClick={() => setProfile({ module: 'breeder' })}>Prowadzę hodowlę</button>
        </div>
      </Card>

      <Card title="Plan" right={p.plan === 'pro' ? <ProBadge /> : <span className="badge gray">FREE</span>}>
        <div className="grid cols-2 stack-m">
          <div className="card soft"><b>FREE – 0 zł</b><ul className="muted" style={{ paddingLeft: 18 }}><li>do {FREE_LIMITS.females} suk i {FREE_LIMITS.males} psów</li><li>do {FREE_LIMITS.shows} wystaw, {FREE_LIMITS.championships} championatów</li><li>wykres wydatków: {FREE_LIMITS.chartMonths} z 6 miesięcy</li></ul></div>
          <div className="card soft"><b>PRO – 89 zł/rok lub 12,99 zł/mies.</b><ul className="muted" style={{ paddingLeft: 18 }}><li>bez limitów psów, wystaw i championatów</li><li>pełne wykresy, raporty i dokumenty PDF</li><li>zespół hodowli, strona nabywcy, synchronizacja (w przygotowaniu)</li></ul></div>
        </div>
        <div className="row" style={{ marginTop: 10 }}>
          <button className="btn" onClick={() => { setProfile({ plan: p.plan === 'pro' ? 'free' : 'pro' }); toast(p.plan === 'pro' ? 'Przełączono na FREE' : 'Aktywowano PRO (tryb demo)'); }}>{p.plan === 'pro' ? 'Przełącz na FREE (demo)' : 'Aktywuj PRO (demo)'}</button>
          <small className="muted">W wersji produkcyjnej płatność przez Google Play / App Store / Stripe.</small>
        </div>
      </Card>

      <Card title="Bezpieczeństwo danych" icon={<Shield size={18} />}>
        <p className="muted">Dane są przechowywane lokalnie na tym urządzeniu. Pobierz kopię, aby przenieść je lub zabezpieczyć.</p>
        <div className="row">
          <button className="btn secondary" onClick={exportJson}><Download size={16} /> Pobierz kopię (JSON)</button>
          <button className="btn secondary" onClick={() => file.current?.click()}><Upload size={16} /> Przywróć z kopii</button>
          <input ref={file} type="file" accept="application/json" hidden onChange={e => e.target.files?.[0] && importJson(e.target.files[0])} />
          <button className="btn secondary" onClick={() => { if (confirm('Załadować dane demonstracyjne? Obecne dane zostaną nadpisane.')) { replace(demoState()); toast('Załadowano dane demo'); } }}>Dane demo</button>
          <button className="btn danger" onClick={() => { if (confirm('Usunąć WSZYSTKIE dane z tego urządzenia?')) { replace(emptyState()); } }}>Usuń wszystkie dane</button>
        </div>
      </Card>

      <Card title="O aplikacji">
        <p className="muted">Wersja prototypowa 0.2 (web). Ta sama baza kodu zostanie opakowana w aplikację Android/iOS. Dane zdrowotne mają charakter ewidencyjny – w sprawach zdrowia konsultuj się z lekarzem weterynarii.</p>
      </Card>

      {invite && <Modal title="Zaproś do hodowli" onClose={() => setInvite(null)} actions={<><button className="btn secondary" onClick={() => setInvite(null)}>Anuluj</button><button className="btn" disabled={!invite.email.trim()} onClick={() => { upsert('members', invite); setInvite(null); toast('Zaproszenie zapisane'); }}>Wyślij zaproszenie</button></>}>
        <Field label="Imię i nazwisko"><input value={invite.name} onChange={e => setInvite({ ...invite, name: e.target.value })} /></Field>
        <Field label="E-mail *"><input type="email" value={invite.email} onChange={e => setInvite({ ...invite, email: e.target.value })} /></Field>
        <Field label="Rola"><select value={invite.role} onChange={e => setInvite({ ...invite, role: e.target.value as Member['role'] })}><option value="editor">Współpracownik (edycja)</option><option value="viewer">Podgląd (np. weterynarz)</option></select></Field>
      </Modal>}
    </div>
  );
}
