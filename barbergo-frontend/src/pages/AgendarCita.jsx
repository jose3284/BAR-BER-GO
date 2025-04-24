import React, { useState } from 'react';
import axios from 'axios';
import '../assets/css/ClienteDashboard.css';
import logo from '../assets/images/logo.png';
import { Link } from 'react-router-dom';

const AgendarCita = () => {
  const [formData, setFormData] = useState({
    nombre: '',
    celular: '',
    correo: '',
    fecha: '',
    hora: ''
  });

  const [mensaje, setMensaje] = useState('');

  const horarioApertura = "10:00";
  const horarioCierre = "21:00";

  const handleChange = (e) => {
    setFormData({ 
      ...formData, 
      [e.target.name]: e.target.value 
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const hoy = new Date();
    const citaFechaHora = new Date(`${formData.fecha}T${formData.hora}`);

    // Validar que la cita no sea en el pasado
    if (citaFechaHora <= hoy) {
      setMensaje('No puedes agendar una cita en el pasado.');
      return;
    }

    // Validar que la hora esté dentro del horario permitido
    if (formData.hora < horarioApertura || formData.hora > horarioCierre) {
      setMensaje(`Las citas solo pueden ser entre las ${horarioApertura} y las ${horarioCierre}.`);
      return;
    }

    try {
      await axios.post('http://localhost:8000/api/cita', formData);
      setMensaje('¡Cita agendada exitosamente!');
      setFormData({
        nombre: '',
        celular: '',
        correo: '',
        fecha: '',
        hora: ''
      });
    } catch (error) {
      setMensaje('Error al agendar la cita. Revisa los datos ingresados.');
    }
  };

  return (
    <div className="body">
      <header className="encabezado">
        <img src={logo} alt="Logo" />
        <nav>
          <ul>
            <li><Link to="/cliente-dashboard"><h3>Volver al Dashboard</h3></Link></li>
          </ul>
        </nav>
      </header>

      <main className="d-flex justify-content-center align-items-center vh-100 bg-dark text-white">
        <div className="d-flex p-5 bg-secondary rounded shadow-lg" style={{ gap: '40px' }}>
          {/* Formulario a la izquierda */}
          <div style={{ minWidth: '300px' }}>
            <h2 className="text-center mb-4">Agendar Cita</h2>
            <form onSubmit={handleSubmit}>
              <div className="mb-3">
                <input 
                  type="text" 
                  name="nombre" 
                  className="form-control" 
                  placeholder="Nombre" 
                  value={formData.nombre} 
                  onChange={handleChange} 
                  required 
                />
              </div>
              <div className="mb-3">
                <input 
                  type="text" 
                  name="celular" 
                  className="form-control" 
                  placeholder="Celular" 
                  value={formData.celular} 
                  onChange={handleChange} 
                  required 
                />
              </div>
              <div className="mb-3">
                <input 
                  type="email" 
                  name="correo" 
                  className="form-control" 
                  placeholder="Correo" 
                  value={formData.correo} 
                  onChange={handleChange} 
                  required 
                />
              </div>
              <div className="mb-3">
                <input 
                  type="date" 
                  name="fecha" 
                  className="form-control" 
                  value={formData.fecha} 
                  onChange={handleChange} 
                  required 
                  min={new Date().toISOString().split("T")[0]} 
                />
              </div>
              <div className="mb-3">
                <input 
                  type="time" 
                  name="hora" 
                  className="form-control" 
                  value={formData.hora} 
                  onChange={handleChange} 
                  required 
                  min={horarioApertura} 
                  max={horarioCierre} 
                />
              </div>
              <button type="submit" className="btn btn-warning w-100">Agendar Cita</button>
              {mensaje && <div className="alert alert-info mt-3 text-center">{mensaje}</div>}
            </form>
          </div>

          {/* Logo a la derecha */}
          <div className="d-flex align-items-center justify-content-center">
            <img src={logo} alt="Logo" style={{ maxWidth: '300px', maxHeight: '300px' }} />
          </div>
        </div>
      </main>

      <footer className="footer">
        <p>&copy; 2024 BAR_BER_GO.</p>
      </footer>
    </div>
  );
};

export default AgendarCita;
