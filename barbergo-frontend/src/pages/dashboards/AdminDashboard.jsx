import React, { useEffect, useState } from 'react';
import { Bar } from 'react-chartjs-2';
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend } from 'chart.js';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import '../../assets/css/AdminDashboard.css';
import logo from '../../assets/images/logo.png';
import { FaBars } from 'react-icons/fa';

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend);

const AdminDashboard = () => {
  const [stats, setStats] = useState(null);
  const [citaStats, setCitaStats] = useState(null);
  const [reciboStats, setReciboStats] = useState(null);
  const [menuOpen, setMenuOpen] = useState(false);
  const navigate = useNavigate();

  useEffect(() => {
    axios.get('http://localhost:8000/api/productos/estadisticas')
      .then(response => setStats(response.data))
      .catch(error => console.error('Error al obtener estadísticas de productos:', error));

    axios.get('http://localhost:8000/api/cita/estadisticas')
      .then(response => setCitaStats(response.data))
      .catch(error => console.error('Error al obtener estadísticas de citas:', error));

    axios.get('http://localhost:8000/api/recibos/estadisticas')
      .then(response => setReciboStats(response.data))
      .catch(error => console.error('Error al obtener estadísticas de recibos:', error));
  }, []);

  const handleLogout = async () => {
    try {
      const token = localStorage.getItem('token');
      await axios.post('http://localhost:8000/api/logout', {}, {
        headers: { Authorization: `Bearer ${token}` },
      });
      localStorage.removeItem('token');
      navigate('/', { replace: true });
    } catch (error) {
      localStorage.removeItem('token');
      navigate('/', { replace: true });
    }
  };

  const chartData = {
    labels: ['Precio Promedio', 'Precio Máximo', 'Precio Mínimo'],
    datasets: [
      {
        label: 'Estadísticas de Precios',
        data: stats ? [stats.precio_promedio, stats.precio_maximo, stats.precio_minimo] : [0, 0, 0],
        backgroundColor: ['#FFD700', '#FFA500', '#FF8C00'],
      },
    ],
  };

  const citasChartData = {
    labels: ['Total Citas', 'Citas Hoy', 'Citas Esta Semana'],
    datasets: [
      {
        label: 'Estadísticas de Citas',
        data: citaStats ? [citaStats.total, citaStats.hoy, citaStats.semana] : [0, 0, 0],
        backgroundColor: ['#87CEFA', '#1E90FF', '#4169E1'],
      },
    ],
  };

  const recibosChartData = {
    labels: ['Total Recibos', 'Monto Total'],
    datasets: [
      {
        label: 'Estadísticas de Recibos',
        data: reciboStats ? [reciboStats.total_recibos, reciboStats.monto_total] : [0, 0],
        backgroundColor: ['#98FB98', '#2E8B57'],
      },
    ],
  };

  const handleDownloadPDF = async () => {
    try {
      const response = await axios.get('http://localhost:8000/api/productos/estadisticas/pdf', {
        responseType: 'blob',
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      });

      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', 'reporte_estadisticas_productos.pdf');
      document.body.appendChild(link);
      link.click();
      link.remove();
    } catch (error) {
      console.error('Error al descargar el PDF de productos:', error);
    }
  };

  const handleDownloadCitasPDF = async () => {
    try {
      const response = await axios.get('http://localhost:8000/api/cita/estadisticas/pdf', {
        responseType: 'blob',
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      });

      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', 'reporte_estadisticas_citas.pdf');
      document.body.appendChild(link);
      link.click();
      link.remove();
    } catch (error) {
      console.error('Error al descargar el PDF de citas:', error);
    }
  };

  const handleDownloadRecibosPDF = async () => {
    try {
      const response = await axios.get('http://localhost:8000/api/recibos/pdf', {
        responseType: 'blob',
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      });

      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', 'reporte_estadisticas_recibos.pdf');
      document.body.appendChild(link);
      link.click();
      link.remove();
    } catch (error) {
      console.error('Error al descargar el PDF de recibos:', error);
    }
  };

  return (
    <div className="body">
      <header className="encabezado">
        <img src={logo} alt="Logo" />
        <FaBars className="menu-icon-right" onClick={() => setMenuOpen(!menuOpen)} />
      </header>

      {menuOpen && (
        <div className="hamburger-menu right">
          <ul>
            <li><a href="/usuarios">Usuarios</a></li>
            <li><a href="/rol">Roles</a></li>
            <li><a href="/categoria">Categorías</a></li>
            <li><a href="/producto">Productos</a></li>
            <li><a href="/metodos-pago">Métodos de pago</a></li>
            <li><a href="/citas">Citas</a></li>
            <li><a href="/recibos">Recibos</a></li>
            <li><button onClick={handleLogout} className="logout-btn">Cerrar sesión</button></li>
          </ul>
        </div>
      )}

      <main className="main-content">
        <div style={{ textAlign: 'center', marginTop: '1rem' }}>
          <h2 style={{ marginBottom: '1rem' }}>Bienvenido al sistema de gestión de citas y productos</h2>
          <img src={logo} alt="Logo" style={{ height: '400px' }} />
        </div>

        <div style={{ maxWidth: '700px', margin: '2rem auto', padding: '1rem', background: '#2a2a2a', borderRadius: '12px' }}>
          <h3 style={{ color: 'white' }}>Estadísticas de Productos</h3>
          <Bar data={chartData} options={{ responsive: true, plugins: { legend: { position: 'top' } } }} />
          <div style={{ display: 'flex', justifyContent: 'center', marginTop: '1rem' }}>
            <button onClick={handleDownloadPDF} style={{ backgroundColor: 'gold', border: 'none', padding: '10px 20px', borderRadius: '8px', fontWeight: 'bold', cursor: 'pointer' }}>
              Descargar PDF
            </button>
          </div>
        </div>

        <div style={{ maxWidth: '700px', margin: '2rem auto', padding: '1rem', background: '#2a2a2a', borderRadius: '12px' }}>
          <h3 style={{ color: 'white' }}>Estadísticas de Citas</h3>
          <Bar data={citasChartData} options={{ responsive: true, plugins: { legend: { position: 'top' } } }} />
          <div style={{ display: 'flex', justifyContent: 'center', marginTop: '1rem' }}>
            <button onClick={handleDownloadCitasPDF} style={{ backgroundColor: '#87CEFA', border: 'none', padding: '10px 20px', borderRadius: '8px', fontWeight: 'bold', cursor: 'pointer', color: '#000' }}>
              Descargar PDF Citas
            </button>
          </div>
        </div>

        <div style={{ maxWidth: '700px', margin: '2rem auto', padding: '1rem', background: '#2a2a2a', borderRadius: '12px' }}>
          <h3 style={{ color: 'white' }}>Estadísticas de Recibos</h3>
          <Bar data={recibosChartData} options={{ responsive: true, plugins: { legend: { position: 'top' } } }} />
          <div style={{ display: 'flex', justifyContent: 'center', marginTop: '1rem' }}>
            <button onClick={handleDownloadRecibosPDF} style={{ backgroundColor: '#98FB98', border: 'none', padding: '10px 20px', borderRadius: '8px', fontWeight: 'bold', cursor: 'pointer', color: '#000' }}>
              Descargar PDF Recibos
            </button>
          </div>
        </div>
      </main>

      <footer className="footer">
        <p>&copy; 2024 BAR_BER_GO.</p>
      </footer>
    </div>
  );
};

export default AdminDashboard;

