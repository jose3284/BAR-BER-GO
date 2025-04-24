import React from 'react';
import logo from '../../assets/images/logo.png';
import videoCita from '../../assets/images/juancho.mp4';
import barbero1 from '../../assets/images/JUAN DIEGO.png';
import barbero2 from '../../assets/images/barbero.jpg';
import producto1 from '../../assets/images/pomada.jpeg';
import producto2 from '../../assets/images/aceite.avif';
import producto3 from '../../assets/images/productos.jpeg';
import corteCabello from '../../assets/images/corte_cabello.jpg';
import arregloBarba from '../../assets/images/arreglo_barba.png';
import decoloracion from '../../assets/images/decoloracion.jpg';
import afeitado from '../../assets/images/afeitado.jpg';
import '../../assets/css/ClienteDashboard.css';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

const ClienteDashboard = () => {
  const navigate = useNavigate();

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

  return (
    <div className="Body">
      {/* Encabezado */}
      <header className="encabezado">
        <img id="bar" src={logo} alt="Logo" />
        <nav>
          <ul>
            <li><h3>Bienvenido, Cliente</h3></li>
            <li>
              <button onClick={handleLogout} className="logout-btn">
                Cerrar sesión
              </button>
            </li>
          </ul>
        </nav>
      </header>

      {/* Contenido principal */}
      <main className="main-content">

        <div className="card">
          <h2>Agendar Cita</h2>
          <video src={videoCita} controls autoPlay loop muted />
          <button onClick={() => navigate('/agendar-cita')}>Ir a Agendar</button>
        </div>

        <div className="card">
          <h2>Tienda</h2>
          <img src={producto3} alt="Producto" />
          <p>Disfruta de nuestros productos desde la comodidad de tu casa. </p>
          <button onClick={() => navigate('/tienda-virtual')}>Ir a Tienda</button>
        </div>
      </main>

      {/* Barberos */}
      <section className="info-section">
        <h2>Nuestros Barberos</h2>
        <div className="info-cards">
          <div className="info-card">
            <img src={barbero1} alt="Barbero Juan" />
            <h4>Juan Pérez</h4>
            <p>Especialista en cortes modernos y degradados.</p>
          </div>
          <div className="info-card">
            <img src={barbero2} alt="Barbero Diego" />
            <h4>Diego Gómez</h4>
            <p>Experto en barbas y afeitados tradicionales.</p>
          </div>
        </div>
      </section>

      {/* Productos */}
      <section className="info-section">
        <h2>Productos Destacados</h2>
        <div className="info-cards">
          <div className="info-card">
            <img src={producto1} alt="Producto 1" />
            <h4>Pomada Styling</h4>
            <p>Fijación fuerte con aroma a coco.</p>
          </div>
          <div className="info-card">
            <img src={producto2} alt="Producto 2" />
            <h4>Aceite para Barba</h4>
            <p>Hidratación profunda y brillo natural.</p>
          </div>
        </div>
      </section>

      <div className="promocional-section">
        {[
          {
            title: 'Estilo Inigualable',
            description: 'Cortes que reflejan tu estilo y resaltan tu singularidad.',
          },
          {
            title: 'Confianza Renovada',
            description: 'Mejora tu estilo y tu confianza con nuestros servicios.',
          },
          {
            title: 'Productos de Calidad',
            description: 'Cuidamos tu piel y barba con productos de primera.',
          },
          {
            title: 'Experiencia Premium',
            description: 'Servicio exclusivo cada vez que nos visitas.',
          },
        ].map((item, idx) => (
          <div className="elementor-element" key={idx}>
            <div className="elementor-icon-box-wrapper">
              <div className="elementor-icon-box-content">
                <h3 className="elementor-icon-box-title">{item.title}</h3>
                <p className="elementor-icon-box-description">{item.description}</p>
              </div>
            </div>
          </div>
        ))}
      </div>

      <section className="servicios">
        <h2>Servicios que Ofrecemos</h2>
        <div className="servicio-lista">
          <div className="servicio-item">
            <img src={corteCabello} alt="Corte de Cabello" />
            <h3>Corte de Cabello</h3>
            <p>Cortes personalizados para tu estilo único.</p>
          </div>
          <div className="servicio-item">
            <img src={arregloBarba} alt="Arreglo de Barba" />
            <h3>Arreglo de Barba</h3>
            <p>Mantén tu barba con recortes e hidratación.</p>
          </div>
          <div className="servicio-item">
            <img src={decoloracion} alt="Decoloración" />
            <h3>Decoloraciones capilares</h3>
            <p>Transforma tu look con colores únicos.</p>
          </div>
          <div className="servicio-item">
            <img src={afeitado} alt="Afeitado Profesional" />
            <h3>Afeitado Profesional</h3>
            <p>Afeitado tradicional para una piel suave.</p>
          </div>
        </div>
      </section>

      {/* Mapa */}
      <section className="map-section">
        <h2>Visítanos</h2>
        <iframe
          title="Ubicación"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.985448010591!2d-74.08363968467645!3d4.609710043791897!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f99a4fa9a1d19%3A0xb6cdd315b2fd2f95!2sBogotá!5e0!3m2!1ses!2sco!4v1680470587284!5m2!1ses!2sco"
          width="100%"
          height="300"
          style={{ border: 0, borderRadius: '12px' }}
          allowFullScreen=""
          loading="lazy"
        ></iframe>
      </section>

      {/* Pie de página */}
      <footer className="footer">
        <p>&copy; 2024 BAR_BER_GO.</p>
      </footer>
    </div>
  );
};

export default ClienteDashboard;
