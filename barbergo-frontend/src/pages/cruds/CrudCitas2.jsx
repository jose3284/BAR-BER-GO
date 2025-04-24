import React, { useEffect, useState } from 'react';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../../assets/css/AdminDashboard.css';
import logo from '../../assets/images/logo.png';
import { Link } from 'react-router-dom';

const CrudCitas2 = () => {
  const [citas, setCitas] = useState([]);
  const [formData, setFormData] = useState({
    nombre: '',
    celular: '',
    correo: '',
    fecha: '',
    hora: ''
  });
  const [editId, setEditId] = useState(null);

  useEffect(() => {
    fetchCitas();
  }, []);

  const fetchCitas = async () => {
    const response = await axios.get('http://localhost:8000/api/cita');
    setCitas(response.data);
  };

  const handleChange = e => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async e => {
    e.preventDefault();
    if (editId) {
      await axios.put(`http://localhost:8000/api/cita/${editId}`, formData);
      setEditId(null);
    } else {
      await axios.post('http://localhost:8000/api/cita', formData);
    }
    fetchCitas();
    setFormData({ nombre: '', celular: '', correo: '', fecha: '', hora: '' });
  };

  const handleEdit = cita => {
    setFormData({
      nombre: cita.nombre,
      celular: cita.celular,
      correo: cita.correo,
      fecha: cita.fecha,
      hora: cita.hora
    });
    setEditId(cita.id);
  };

  const handleDelete = async id => {
    await axios.delete(`http://localhost:8000/api/cita/${id}`);
    fetchCitas();
  };

  return (
    <div className="body">
      <header className="encabezado">
        <img src={logo} alt="Logo" />
        <nav>
          <ul><li><Link to="/barbero-dashboard"><h3>Volver al Dashboard</h3></Link></li></ul>
        </nav>
      </header>

      <main className="container mt-5">
        <h2 className="text-center text-white mb-4">CRUD de Citas</h2>
        <form onSubmit={handleSubmit} className="bg-dark p-4 rounded mb-4 text-white">
          <div className="mb-3">
            <input type="text" name="nombre" placeholder="Nombre" className="form-control" value={formData.nombre} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <input type="text" name="celular" placeholder="Celular" className="form-control" value={formData.celular} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <input type="email" name="correo" placeholder="Correo" className="form-control" value={formData.correo} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <input type="date" name="fecha" className="form-control" value={formData.fecha} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <input type="time" name="hora" className="form-control" value={formData.hora} onChange={handleChange} required />
          </div>
          <button type="submit" className="btn btn-warning">
            {editId ? 'Actualizar Cita' : 'Guardar Cita'}
          </button>
        </form>

        <table className="table table-dark table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Celular</th>
              <th>Correo</th>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {citas.map(cita => (
              <tr key={cita.id}>
                <td>{cita.id}</td>
                <td>{cita.nombre}</td>
                <td>{cita.celular}</td>
                <td>{cita.correo}</td>
                <td>{cita.fecha}</td>
                <td>{cita.hora}</td>
                <td>
                  <button className="btn btn-info btn-sm me-2" onClick={() => handleEdit(cita)}>Editar</button>
                  <button className="btn btn-danger btn-sm" onClick={() => handleDelete(cita.id)}>Eliminar</button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </main>

      <footer className="footer">
        <p>&copy; 2024 BAR_BER_GO.</p>
      </footer>
    </div>
  );
};

export default CrudCitas2;
