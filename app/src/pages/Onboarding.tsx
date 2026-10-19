import { useState } from 'react';
import { PawPrint, Dog } from 'lucide-react';
import { useStore } from '../app/store';
import { demoState } from '../app/seed';
import { APP_NAME, Field } from '../components/ui';
import type { Module } from '../app/types';

export default function Onboarding() {
  const { setProfile, replace } = useStore();
  const [module, setModule] = useState<Module | null>(null);
  const [name, setName] = useState('');
  const [kennel, setKennel] = useState('');
  const [kennelNo, setKennelNo] = useState('');
  const [email, setEmail] = useState('');

  const loadDemo = () => replace(demoState());

  return (
    <div className="module-pick">
      <div className="box">
        <div className="row" style={{ marginBottom: 20 }}><div className="avatar" style={{ width: 52, height: 52, background: 'var(--primary)', color: '#fff' }}><PawPrint size={28} className="wag" /></div><div><h1 style={{ margin: 0 }}>{APP_NAME}</h1><div className="muted">Hodowla i psy w jednym miejscu.</div></div></div>
        {!module ? (
          <>
            <h2>Jak korzystasz z aplikacji?</h2>
            <p className="muted">Wybierz tryb pracy. Zmienisz go w każdej chwili w Ustawieniach.</p>
            <div className="grid cols-2 stack-m" style={{ marginTop: 16 }}>
              <div className="module-card" onClick={() => setModule('owner')}>
                <div className="avatar" style={{ width: 52, height: 52, marginBottom: 8 }}><Dog size={28} /></div><h3>Mam psa</h3>
                <p className="muted">Zdrowie, wydatki, przypomnienia i codzienna opieka nad Twoim psem. Odbierz psa od hodowcy kodem QR.</p>
              </div>
              <div className="module-card dark" onClick={() => setModule('breeder')}>
                <div className="avatar" style={{ width: 52, height: 52, marginBottom: 8, background: 'rgba(255,255,255,.2)', color: '#fff' }}><PawPrint size={28} /></div><h3>Prowadzę hodowlę</h3>
                <p style={{ opacity: .85 }}>Psy, rozród, monitor ciąży, mioty, szczenięta, wystawy, finanse, raporty i karty przekazania.</p>
              </div>
            </div>
            <div style={{ marginTop: 22, textAlign: 'center' }}>
              <button className="btn secondary" onClick={loadDemo}>Załaduj dane demonstracyjne (hodowla)</button>
              <div className="muted" style={{ marginTop: 8 }}>Dane są zapisywane lokalnie w Twojej przeglądarce.</div>
            </div>
          </>
        ) : (
          <div className="card">
            <h2>{module === 'breeder' ? 'Dane hodowli' : 'Twoje dane'}</h2>
            <Field label="Twoje imię"><input value={name} onChange={e => setName(e.target.value)} placeholder="np. Ania" /></Field>
            {module === 'breeder' && <>
              <Field label="Nazwa hodowli"><input value={kennel} onChange={e => setKennel(e.target.value)} placeholder="np. z Zielonego Wzgórza" /></Field>
              <Field label="Numer hodowli (opcjonalnie)"><input value={kennelNo} onChange={e => setKennelNo(e.target.value)} /></Field>
            </>}
            <Field label="E-mail (opcjonalnie)"><input type="email" value={email} onChange={e => setEmail(e.target.value)} /></Field>
            <div className="row between">
              <button className="btn ghost" onClick={() => setModule(null)}>← Wróć</button>
              <button className="btn" disabled={!name.trim()} onClick={() => setProfile({ module, breederName: name.trim(), kennelName: kennel.trim(), kennelNo: kennelNo.trim(), email: email.trim(), onboarded: true })}>Zaczynamy</button>
            </div>
          </div>
        )}
      </div>
    </div>
  );
}
