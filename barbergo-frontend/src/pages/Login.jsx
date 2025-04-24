import React, { useState } from 'react';
import axios from 'axios';
import '../assets/css/Login.css';
import logo from '../assets/images/logo.png';
import { Link, useNavigate } from 'react-router-dom';

const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [mensaje, setMensaje] = useState('');
  const navigate = useNavigate();

  const handleLogin = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://localhost:8000/api/login', {
        Correo: email,
        Pass: password
      });
  
      console.log('Respuesta:', response.data);
  
      localStorage.setItem('token', response.data.access_token);
  
      const rol = response.data.user?.id_roles;
  
      switch (rol) {
        case 1:
          navigate('/admin-dashboard');
          break;
        case 2:
          navigate('/barbero-dashboard');
          break;
        case 3:
          navigate('/vendedor-dashboard');
          break;
        case 4:
          navigate('/cliente-dashboard');
          break;
        default:
          navigate('/dashboard');
      }
  
    } catch (error) {
      console.error('Login error:', error);
      if (error.response) {
        setMensaje(error.response.data.message || 'Correo o contraseña incorrectos');
      } else {
        setMensaje('Error al conectar con el servidor');
      }
    }
  };
  

  return (
    <div className="Body fondo">
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

      {/* Contenido principal */}
      <div className="login-container">
        <h2>Iniciar Sesión</h2>
        <form onSubmit={handleLogin}>
          <div className="form-group">
            <label>Correo:</label>
            <input
              type="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
            />
          </div>

          <div className="form-group">
            <label>Contraseña:</label>
            <input
              type="password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              required
            />
          </div>

          {mensaje && <p className="mensaje-error">{mensaje}</p>}

          <button type="submit">Ingresar</button>
        </form>

        <div className="login-links">
          <p>¿No tienes cuenta? <Link to="/register">Regístrate</Link></p>
          <p><Link to="/forgot-password">¿Olvidaste tu contraseña?</Link></p>
        </div>
      </div>

      {/* Pie de página */}
      <footer className="footer">
        <p>&copy; 2024 BAR_BER_GO.</p>
      </footer>
    </div>
  );
};

export default Login;
