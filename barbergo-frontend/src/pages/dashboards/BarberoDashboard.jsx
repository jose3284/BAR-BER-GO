import React, { useEffect, useState } from 'react';
import { Bar } from 'react-chartjs-2';
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend } from 'chart.js';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import '../../assets/css/AdminDashboard.css';
import logo from '../../assets/images/logo.png';
import { FaBars } from 'react-icons/fa';

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend);

const BarberoDashboard = () => {
  const [stats, setStats] = useState(null);
  const [menuOpen, setMenuOpen] = useState(false);
  const navigate = useNavigate();

  useEffect(() => {
    axios.get('http://localhost:8000/api/citas/estadisticas')
      .then(response => setStats(response.data))
      .catch(error => console.error('Error al obtener estadísticas:', error));
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
    labels: ['Total de Citas', 'Citas Hoy', 'Citas Futuras'],
    datasets: [
      {
        label: 'Estadísticas de Citas',
        data: stats ? [stats.total_citas, stats.citas_hoy, stats.citas_futuras] : [0, 0, 0],
        backgroundColor: ['#36A2EB', '#FF6384', '#4BC0C0'],
      },
    ],
  };

  const handleDownloadPDF = async () => {
    try {
      const response = await axios.get('http://localhost:8000/api/citas/pdf', {
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
      console.error('Error al descargar el PDF:', error);
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
            <li><a href="/citas2">Citas</a></li>
            <li><button onClick={handleLogout} className="logout-btn">Cerrar sesión</button></li>
          </ul>
        </div>
      )}

      <main className="main-content">
        <div style={{ textAlign: 'center', marginTop: '1rem' }}>
          <h2 style={{ marginBottom: '1rem' }}>Bienvenido al sistema de información para la gestión de citas y venta de productos.</h2>
          <img src={logo} alt="Logo" style={{ height: '400px', marginBottom: '1rem' }} />
        </div>

        <div style={{ maxWidth: '700px', margin: '2rem auto', padding: '1rem', background: '#2a2a2a', borderRadius: '12px' }}>
          <Bar data={chartData} options={{ responsive: true, plugins: { legend: { position: 'top' } } }} />
          <div style={{ display: 'flex', justifyContent: 'center', marginTop: '1rem' }}>
            <button onClick={handleDownloadPDF} style={{ backgroundColor: 'gold', border: 'none', padding: '10px 20px', borderRadius: '8px', fontWeight: 'bold', cursor: 'pointer' }}>
              Descargar PDF
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

export default BarberoDashboard;

