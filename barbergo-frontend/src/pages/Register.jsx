import React, { useState } from 'react';
import axios from 'axios';
import logo from '../assets/images/logo.png';
import { useNavigate, Link } from 'react-router-dom';
import '../assets/css/AuthForm.css';

const Register = () => {
  const [formData, setFormData] = useState({
    Nombre: '',
    P_apellido: '',
    S_apellido: '',
    Correo: '',
    Pass: '',
    id_roles: 4, // Cliente
    userState: false
  });

  const [error, setError] = useState('');
  const navigate = useNavigate();

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({ ...prev, [name]: value }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');
    try {
      await axios.post('http://localhost:8000/api/usuarios', formData);
      navigate('/login');
    } catch (err) {
      setError(err.response?.data?.message || 'Error al registrarse');
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
        <h2>Registro</h2>
        {error && <p className="auth-error">{error}</p>}
        <input type="text" name="Nombre" placeholder="Nombre" onChange={handleChange} required />
        <input type="text" name="P_apellido" placeholder="Primer Apellido" onChange={handleChange} required />
        <input type="text" name="S_apellido" placeholder="Segundo Apellido" onChange={handleChange} />
        <input type="email" name="Correo" placeholder="Correo" onChange={handleChange} required />
        <input type="password" name="Pass" placeholder="Contraseña" onChange={handleChange} required />
        <button type="submit">Registrarse</button>
        <p className="auth-link">
          ¿Ya tienes una cuenta? <Link to="/login">Inicia sesión</Link>
        </p>
      </form>

     {/* Pie de página */}
     <footer className="footer">
     <p>&copy; 2024 BAR_BER_GO.</p>
   </footer>
 </div>
  );
};

export default Register;
