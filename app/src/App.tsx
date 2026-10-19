import { Navigate, Route, Routes } from 'react-router-dom';
import Layout from './components/Layout';
import { useStore } from './app/store';
import Onboarding from './pages/Onboarding';
import Dashboard from './pages/Dashboard';
import Dogs from './pages/Dogs';
import DogProfile from './pages/DogProfile';
import Litters from './pages/Litters';
import LitterDetail from './pages/LitterDetail';
import PuppyDetail from './pages/PuppyDetail';
import Pregnancy from './pages/Pregnancy';
import Finance from './pages/Finance';
import Reports from './pages/Reports';
import Reminders from './pages/Reminders';
import Settings from './pages/Settings';
import Scan from './pages/Scan';

export default function App() {
  const { state } = useStore();
  if (!state.profile.onboarded) return <Onboarding />;
  const breeder = state.profile.module === 'breeder';
  return (
    <Routes>
      <Route element={<Layout />}>
        <Route index element={<Dashboard />} />
        <Route path="/psy" element={<Dogs />} />
        <Route path="/psy/:id" element={<DogProfile />} />
        {breeder && <Route path="/mioty" element={<Litters />} />}
        {breeder && <Route path="/mioty/:id" element={<LitterDetail />} />}
        {breeder && <Route path="/szczenieta/:id" element={<PuppyDetail />} />}
        {breeder && <Route path="/ciaza/:id" element={<Pregnancy />} />}
        <Route path="/finanse" element={<Finance />} />
        <Route path="/raporty" element={<Reports />} />
        <Route path="/raporty/:kind" element={<Reports />} />
        <Route path="/przypomnienia" element={<Reminders />} />
        <Route path="/ustawienia" element={<Settings />} />
        <Route path="/skanuj" element={<Scan />} />
        <Route path="*" element={<Navigate to="/" replace />} />
      </Route>
    </Routes>
  );
}
