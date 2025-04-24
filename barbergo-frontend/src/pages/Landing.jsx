import React from 'react';
import { Link } from 'react-router-dom';
import '../assets/css/Landing.css';

import logo from '../assets/images/logo.png';
import corteCabello from '../assets/images/corte_cabello.jpg';
import arregloBarba from '../assets/images/arreglo_barba.png';
import decoloracion from '../assets/images/decoloracion.jpg';
import afeitado from '../assets/images/afeitado.jpg';

const Landing = () => {
  return (
    <div className="Body fondo">
      <header className="encabezado">
        <img id="bar" src={logo} alt="Logo" />
        <nav>
          <ul>
            <li>
              <Link to="/login"><h3>Inicio de sesión</h3></Link>
            </li>
          </ul>
        </nav>
      </header>

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

      <section className="mapa">
        <h2>Nuestra Ubicación</h2>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.985448010591!2d-74.08363968467645!3d4.609710043791897!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f99a4fa9a1d19%3A0xb6cdd315b2fd2f95!2sBogotá!5e0!3m2!1ses!2sco!4v1680470587284!5m2!1ses!2sco"
          allowFullScreen
          loading="lazy"
          title="Ubicación"
        ></iframe>
      </section>

      <footer className="footer">
        <p>&copy; 2024 BAR_BER_GO.</p>
      </footer>
    </div>
  );
};

export default Landing;
