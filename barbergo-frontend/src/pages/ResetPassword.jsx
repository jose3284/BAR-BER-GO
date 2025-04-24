import React, { useState } from 'react';
import { useLocation, Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import logo from '../assets/images/logo.png';
import '../assets/css/AuthForm.css';

const ResetPassword = () => {
  const location = useLocation();
  const navigate = useNavigate();

  const [Correo, setCorreo] = useState(location.state?.Correo || '');
  const [token, setToken] = useState('');
  const [newPassword, setNewPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [mensaje, setMensaje] = useState('');
  const [error, setError] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    setMensaje('');
    setError('');

    if (newPassword !== confirmPassword) {
      setError('Las contraseñas no coinciden');
      return;
    }

    try {
      await axios.post('http://localhost:8000/api/reset-password', {
        Correo,
        token,
        new_password: newPassword,
        new_password_confirmation: confirmPassword,
      });

      setMensaje('Contraseña actualizada correctamente. Redirigiendo...');
      setTimeout(() => navigate('/login'), 2000);
    } catch (err) {
      setError(err.response?.data?.message || 'Error al restablecer contraseña');
    }
  };

  return (
    <div className="body fondo">
      {/* Encabezado */}
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
        <h2>Restablecer Contraseña</h2>
        {mensaje && <p className="auth-success">{mensaje}</p>}
        {error && <p className="auth-error">{error}</p>}

        <input
          type="email"
          name="Correo"
          placeholder="Correo electrónico"
          value={Correo}
          onChange={(e) => setCorreo(e.target.value)}
          required
        />
        <input
          type="text"
          name="token"
          placeholder="Token de recuperación"
          value={token}
          onChange={(e) => setToken(e.target.value)}
          required
        />
        <input
          type="password"
          name="new_password"
          placeholder="Nueva contraseña"
          value={newPassword}
          onChange={(e) => setNewPassword(e.target.value)}
          required
        />
        <input
          type="password"
          name="new_password_confirmation"
          placeholder="Confirmar contraseña"
          value={confirmPassword}
          onChange={(e) => setConfirmPassword(e.target.value)}
          required
        />
        <button type="submit">Cambiar contraseña</button>

        <p className="auth-link">
          ¿Ya tienes cuenta? <Link to="/login">Inicia sesión</Link>
        </p>
      </form>

      {/* Pie de página */}
      <footer className="footer">
        <p>&copy; 2024 BAR_BER_GO.</p>
      </footer>
    </div>
  );
};

export default ResetPassword;
