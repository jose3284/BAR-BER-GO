import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Landing from './pages/Landing';
import Login from './pages/Login';
import Register from './pages/Register';
import ForgotPassword from './pages/ForgotPassword';
import ResetPassword from './pages/ResetPassword'; 
import ClienteDashboard from './pages/dashboards/ClienteDashboard';
import BarberoDashboard from './pages/dashboards/BarberoDashboard';
import AdminDashboard from './pages/dashboards/AdminDashboard';
import VendedorDashboard from './pages/dashboards/VendedorDashboard';
import CrudUsuarios from './pages/cruds/CrudUsuarios';
import CrudRoles from './pages/cruds/CrudRoles';
import CrudCategorias from './pages/cruds/CrudCategoria';
import CrudProductos from './pages/cruds/CrudProductos';
import CrudMetodosPago from './pages/cruds/CrudMetodosPago';
import CrudCitas from './pages/cruds/CrudCitas';
import CrudRecibos from './pages/cruds/CrudRecibos';
import AgendarCita from './pages/AgendarCita';
import TiendaVirtual from './pages/TiendaVirtual';
import CrudCitas2 from './pages/cruds/CrudCitas2';
import CrudCategorias2 from './pages/cruds/CrudCategoria2';
import CrudProductos2 from './pages/cruds/CrudProductos2';
import CrudRecibos2 from './pages/cruds/CrudRecibos2';

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Landing />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/forgot-password" element={<ForgotPassword />} />
        <Route path="/reset-password" element={<ResetPassword />} /> 
        <Route path="/cliente-dashboard" element={<ClienteDashboard />} />
        <Route path="/barbero-dashboard" element={<BarberoDashboard />} />
        <Route path="/admin-dashboard" element={<AdminDashboard />} />
        <Route path="/vendedor-dashboard" element={<VendedorDashboard />} />
        <Route path="/usuarios" element={<CrudUsuarios />} /> 
        <Route path="/rol"element={<CrudRoles/>}/>
        <Route path="/categoria"element={<CrudCategorias/>}/>
        <Route path="/producto"element={<CrudProductos/>}/>
        <Route path="/metodos-pago"element={<CrudMetodosPago/>}/>
        <Route path="/citas"element={<CrudCitas/>}/>
        <Route path="/recibos"element={<CrudRecibos/>}/>
        <Route path="/agendar-cita"element={<AgendarCita/>}/>
        <Route path="/tienda-virtual"element={<TiendaVirtual/>}/>
        <Route path="/citas2"element={<CrudCitas2/>}/>
        <Route path="/recibos2"element={<CrudRecibos2/>}/>
        <Route path="/categoria2"element={<CrudCategorias2/>}/>
        <Route path="/producto2"element={<CrudProductos2/>}/>

      </Routes>
    </Router>   
  );
}

export default App;


