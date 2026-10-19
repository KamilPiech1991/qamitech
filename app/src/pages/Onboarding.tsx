import { useState } from 'react';
import { PawPrint, Dog, Eye, EyeOff, Mail, Lock, ArrowLeft, ShieldCheck } from 'lucide-react';
import { useStore } from '../app/store';
import { demoState } from '../app/seed';
import { Field, Wordmark } from '../components/ui';
import type { Module } from '../app/types';

type Step = 'module' | 'auth' | 'details';
type AuthMode = 'register' | 'login';

function GoogleMark() {
  return (
    <svg width="18" height="18" viewBox="0 0 48 48" aria-hidden="true">
      <path fill="#EA4335" d="M24 9.5c3.5 0 6.6 1.2 9 3.6l6.7-6.7C35.6 2.6 30.2 0 24 0 14.6 0 6.5 5.4 2.6 13.3l7.8 6C12.3 13.5 17.7 9.5 24 9.5z" />
      <path fill="#4285F4" d="M46.5 24.5c0-1.6-.1-3.1-.4-4.5H24v8.5h12.7c-.6 3-2.3 5.5-4.8 7.2l7.5 5.8c4.4-4 7.1-10 7.1-17z" />
      <path fill="#FBBC05" d="M10.4 28.7A14.5 14.5 0 0 1 9.5 24c0-1.6.3-3.2.8-4.7l-7.8-6A24 24 0 0 0 0 24c0 3.9.9 7.5 2.6 10.7l7.8-6z" />
      <path fill="#34A853" d="M24 48c6.5 0 11.9-2.1 15.9-5.8l-7.5-5.8c-2.1 1.4-4.9 2.3-8.4 2.3-6.3 0-11.7-4-13.6-9.7l-7.8 6C6.5 42.6 14.6 48 24 48z" />
    </svg>
  );
}

export default function Onboarding() {
  const { setProfile, replace } = useStore();
  const [step, setStep] = useState<Step>('module');
  const [module, setModule] = useState<Module>('breeder');
  const [mode, setMode] = useState<AuthMode>('register');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [showPw, setShowPw] = useState(false);
  const [authErr, setAuthErr] = useState('');
  const [provider, setProvider] = useState<'email' | 'google'>('email');
  const [name, setName] = useState('');
  const [kennel, setKennel] = useState('');
  const [kennelNo, setKennelNo] = useState('');

  const loadDemo = () => replace(demoState());
  const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.trim());
  const pwOk = mode === 'login' ? password.length > 0 : password.length >= 8;

  const submitAuth = () => {
    if (!emailOk) { setAuthErr('Podaj poprawny adres e-mail.'); return; }
    if (!pwOk) { setAuthErr(mode === 'login' ? 'Wpisz hasło.' : 'Hasło powinno mieć co najmniej 8 znaków.'); return; }
    setAuthErr(''); setProvider('email'); setStep('details');
  };
  const google = () => { setAuthErr(''); setProvider('google'); if (!email) setEmail(''); setStep('details'); };
  const finish = () => setProfile({ module, breederName: name.trim(), kennelName: kennel.trim(), kennelNo: kennelNo.trim(), email: email.trim(), authProvider: provider, onboarded: true });

  return (
    <div className="module-pick">
      <div className="box">
        {step === 'module' ? (
          <picture>
            <source media="(max-width: 640px)" srcSet={`${import.meta.env.BASE_URL}brand/header-mobile.webp`} />
            <img className="brand-hero" src={`${import.meta.env.BASE_URL}brand/header-1600.webp`} srcSet={`${import.meta.env.BASE_URL}brand/header-800.webp 800w, ${import.meta.env.BASE_URL}brand/header-1600.webp 1600w`} sizes="(max-width: 800px) 100vw, 760px" alt="dogpilot – hodowla i psy w jednym miejscu" />
          </picture>
        ) : (
          <picture>
            <source media="(max-width: 640px)" srcSet={`${import.meta.env.BASE_URL}brand/header2-mobile.webp`} />
            <img className="brand-hero short" src={`${import.meta.env.BASE_URL}brand/header2-1600.webp`} srcSet={`${import.meta.env.BASE_URL}brand/header2-800.webp 800w, ${import.meta.env.BASE_URL}brand/header2-1600.webp 1600w`} sizes="(max-width: 800px) 100vw, 760px" alt="dogpilot – hodowla i psy w jednym miejscu" />
          </picture>
        )}
        <div className="row only-mobile" style={{ marginBottom: 16, gap: 10 }}><div className="avatar" style={{ width: 44, height: 44, background: 'var(--primary)', color: '#fff' }}><PawPrint size={24} className="wag" /></div><Wordmark height={30} /></div>

        {step === 'module' && (
          <>
            <div className="muted" style={{ marginBottom: 18, fontWeight: 700 }}>Hodowla i psy w jednym miejscu.</div>
            <h2>Jak korzystasz z aplikacji?</h2>
            <p className="muted">Wybierz tryb pracy. Zmienisz go w każdej chwili w Ustawieniach.</p>
            <div className="grid cols-2 stack-m" style={{ marginTop: 16 }}>
              <div className="module-card" onClick={() => { setModule('owner'); setStep('auth'); }}>
                <div className="avatar" style={{ width: 52, height: 52, marginBottom: 8 }}><Dog size={28} /></div><h3>Mam psiaka</h3>
                <p className="muted">Zdrowie, wydatki, przypomnienia i codzienna opieka nad Twoim psem. Odbierz psa od hodowcy kodem QR.</p>
              </div>
              <div className="module-card dark" onClick={() => { setModule('breeder'); setStep('auth'); }}>
                <div className="avatar" style={{ width: 52, height: 52, marginBottom: 8, background: 'rgba(255,255,255,.2)', color: '#fff' }}><PawPrint size={28} /></div><h3>Prowadzę hodowlę</h3>
                <p style={{ opacity: .85 }}>Psy, rozród, monitor ciąży, mioty, szczenięta, wystawy, finanse, raporty i karty przekazania.</p>
              </div>
            </div>
            <div style={{ marginTop: 22, textAlign: 'center' }}>
              <button className="btn secondary" onClick={loadDemo}>Załaduj dane demonstracyjne (hodowla)</button>
              <div className="muted" style={{ marginTop: 8 }}>Dane są zapisywane lokalnie w Twojej przeglądarce.</div>
            </div>
          </>
        )}

        {step === 'auth' && (
          <div className="auth card">
            <button className="btn ghost sm" onClick={() => setStep('module')} style={{ alignSelf: 'flex-start', marginLeft: -8 }}><ArrowLeft size={16} /> {module === 'breeder' ? 'Prowadzę hodowlę' : 'Mam psiaka'}</button>
            <div className="auth-tabs" role="tablist">
              <button role="tab" aria-selected={mode === 'register'} className={mode === 'register' ? 'active' : ''} onClick={() => { setMode('register'); setAuthErr(''); }}>Załóż bezpłatne konto</button>
              <button role="tab" aria-selected={mode === 'login'} className={mode === 'login' ? 'active' : ''} onClick={() => { setMode('login'); setAuthErr(''); }}>Mam już konto</button>
            </div>
            <h2 style={{ marginTop: 4 }}>{mode === 'register' ? 'Zacznij za darmo' : 'Witaj ponownie'}</h2>
            <p className="muted" style={{ marginTop: -4 }}>{mode === 'register' ? 'Plan FREE bez karty. Dane synchronizują się między telefonem a komputerem.' : 'Zaloguj się, a Twoje psy i mioty będą czekać tam, gdzie je zostawiłeś.'}</p>
            <form onSubmit={e => { e.preventDefault(); submitAuth(); }} noValidate>
              <Field label="Adres e-mail">
                <div className="input-ico"><Mail size={18} /><input type="email" autoComplete="email" value={email} onChange={e => setEmail(e.target.value)} placeholder="np. ania@hodowla.pl" /></div>
              </Field>
              <Field label="Hasło" hint={mode === 'register' ? 'Co najmniej 8 znaków.' : undefined}>
                <div className="input-ico"><Lock size={18} /><input type={showPw ? 'text' : 'password'} autoComplete={mode === 'register' ? 'new-password' : 'current-password'} value={password} onChange={e => setPassword(e.target.value)} placeholder={mode === 'register' ? 'Wymyśl hasło' : 'Twoje hasło'} /><button type="button" className="icon-btn" aria-label={showPw ? 'Ukryj hasło' : 'Pokaż hasło'} onClick={() => setShowPw(s => !s)}>{showPw ? <EyeOff size={18} /> : <Eye size={18} />}</button></div>
              </Field>
              {mode === 'login' && <div style={{ textAlign: 'right', marginTop: -4 }}><a href="#" onClick={e => e.preventDefault()} style={{ fontSize: 13, fontWeight: 700 }}>Nie pamiętasz hasła?</a></div>}
              {authErr && <div className="badge danger" style={{ marginTop: 8 }}>{authErr}</div>}
              <button type="submit" className="btn" style={{ width: '100%', marginTop: 12, height: 48 }}>{mode === 'register' ? 'Załóż konto' : 'Zaloguj się'}</button>
            </form>
            <div className="auth-or"><span>lub</span></div>
            <button className="btn google" onClick={google}><GoogleMark /> {mode === 'register' ? 'Zarejestruj się kontem Google' : 'Zaloguj się kontem Google'}</button>
            <div className="muted" style={{ fontSize: 12, display: 'flex', gap: 6, alignItems: 'flex-start', marginTop: 12 }}><ShieldCheck size={16} style={{ flexShrink: 0, marginTop: 1 }} /><span>{mode === 'register' ? 'Zakładając konto akceptujesz regulamin i politykę prywatności. Dane hodowli nie są udostępniane nikomu bez Twojej zgody.' : 'Prototyp: logowanie jest symulowane, konto i synchronizacja pojawią się razem z backendem.'}</span></div>
          </div>
        )}

        {step === 'details' && (
          <div className="auth card">
            <button className="btn ghost sm" onClick={() => setStep('auth')} style={{ alignSelf: 'flex-start', marginLeft: -8 }}><ArrowLeft size={16} /> Logowanie</button>
            <h2>{module === 'breeder' ? 'Dane hodowli' : 'Twoje dane'}</h2>
            <p className="muted" style={{ marginTop: -4 }}>{provider === 'google' ? 'Konto Google połączone.' : `Konto: ${email.trim()}`} Jeszcze tylko kilka pól i zaczynamy.</p>
            <Field label="Twoje imię"><input value={name} onChange={e => setName(e.target.value)} placeholder="np. Ania" autoFocus /></Field>
            {module === 'breeder' && <>
              <Field label="Nazwa hodowli"><input value={kennel} onChange={e => setKennel(e.target.value)} placeholder="np. z Zielonego Wzgórza" /></Field>
              <Field label="Numer hodowli (opcjonalnie)"><input value={kennelNo} onChange={e => setKennelNo(e.target.value)} /></Field>
            </>}
            {provider === 'google' && <Field label="Adres e-mail konta Google"><input type="email" value={email} onChange={e => setEmail(e.target.value)} placeholder="np. ania@gmail.com" /></Field>}
            <button className="btn" style={{ width: '100%', height: 48 }} disabled={!name.trim()} onClick={finish}>Zaczynamy</button>
          </div>
        )}
      </div>
    </div>
  );
}
