import React, { useState } from 'react';
import axios from 'axios';
import logo from '../assets/images/logo.png';
import { Link, useNavigate } from 'react-router-dom'; // <- añadimos useNavigate
import '../assets/css/AuthForm.css';

const ForgotPassword = () => {
  const [Correo, setCorreo] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate(); // <- inicializamos el hook

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');
    try {
      await axios.post('http://localhost:8000/api/forgot-password', { Correo });

      // Redirige al usuario a la página de validación del token
      navigate('/reset-password', { state: { Correo } }); // <- enviamos el correo por el estado
    } catch (err) {
      setError(err.response?.data?.message || 'Error al enviar correo de recuperación');
    }
  };

  return (
    <div className="body fondo">
      <header className="encabezado">
        <img id="bar" src={logo} alt="Logo" />
        <nav>
          <ul>
            <li>
              <Link to="/"><h3>Inicio</h3></Link>
            </li>
          </ul>
        </nav>
      </header>

      <form onSubmit={handleSubmit} className="auth-form">
        <h2>Recuperar contraseña</h2>
        {error && <p className="auth-error">{error}</p>}
        <input
          type="email"
          name="Correo"
          placeholder="Correo electrónico"
          value={Correo}
          onChange={(e) => setCorreo(e.target.value)}
          required
        />
        <button type="submit">Enviar token</button>
        <p className="auth-link">
          ¿Ya tienes cuenta? <Link to="/login">Inicia sesión</Link>
        </p>
      </form>

      <footer className="footer">
        <p>&copy; 2024 BAR_BER_GO.</p>
      </footer>
    </div>
  );
};

export default ForgotPassword;
