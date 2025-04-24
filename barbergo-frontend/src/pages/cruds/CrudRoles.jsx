import React, { useEffect, useState } from 'react';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../../assets/css/AdminDashboard.css';
import logo from '../../assets/images/logo.png';
import { Link } from 'react-router-dom';

const CrudRoles = () => {
  const [roles, setRoles] = useState([]);
  const [formData, setFormData] = useState({ nombre_rol: '' });
  const [editId, setEditId] = useState(null);

  useEffect(() => {
    fetchRoles();
  }, []);

  const fetchRoles = async () => {
    const response = await axios.get('http://localhost:8000/api/roles');
    setRoles(response.data);
  };

  const handleChange = e => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async e => {
    e.preventDefault();
    if (editId) {
      await axios.put(`http://localhost:8000/api/roles/${editId}`, formData);
      setEditId(null);
    } else {
      await axios.post('http://localhost:8000/api/roles', formData);
    }
    fetchRoles();
    setFormData({ nombre_rol: '' });
  };

  const handleEdit = rol => {
    setFormData({ nombre_rol: rol.nombre_rol });
    setEditId(rol.id);
  };

  const handleDelete = async id => {
    await axios.delete(`http://localhost:8000/api/roles/${id}`);
    fetchRoles();
  };

  return (
    <div className="body">
      <header className="encabezado">
        <img src={logo} alt="Logo" />
        <nav>
          <ul><li><Link to="/admin-dashboard"><h3>Volver al Dashboard</h3></Link></li></ul>
        </nav>
      </header>

      <main className="container mt-5">
        <h2 className="text-center text-white mb-4">CRUD de Roles</h2>
        <form onSubmit={handleSubmit} className="bg-dark p-4 rounded mb-4 text-white">
          <div className="mb-3">
            <input type="text" name="nombre_rol" placeholder="Nombre del Rol" className="form-control" value={formData.nombre_rol} onChange={handleChange} required />
          </div>
          <button type="submit" className="btn btn-warning">
            {editId ? 'Actualizar Rol' : 'Guardar Rol'}
          </button>
        </form>

        <table className="table table-dark table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre del Rol</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {roles.map(rol => (
              <tr key={rol.id}>
                <td>{rol.id}</td>
                <td>{rol.nombre_rol}</td>
                <td>
                  <button className="btn btn-info btn-sm me-2" onClick={() => handleEdit(rol)}>Editar</button>
                  <button className="btn btn-danger btn-sm" onClick={() => handleDelete(rol.id)}>Eliminar</button>
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

export default CrudRoles;
