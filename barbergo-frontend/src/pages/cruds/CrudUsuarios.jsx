import React, { useEffect, useState } from 'react';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../../assets/css/AdminDashboard.css';
import logo from '../../assets/images/logo.png';
import { FaBars } from 'react-icons/fa';
import { Link } from 'react-router-dom';

const CrudUsuarios = () => {
  const [usuarios, setUsuarios] = useState([]);
  const [formData, setFormData] = useState({
    Nombre: '',
    P_apellido: '',
    S_apellido: '',
    Pass: '',
    Correo: '',
    id_roles: '',
    userState: true,
  });
  const [editId, setEditId] = useState(null);

  useEffect(() => {
    fetchUsuarios();
  }, []);

  const fetchUsuarios = async () => {
    const response = await axios.get('http://localhost:8000/api/usuarios');
    setUsuarios(response.data);
  };

  const handleChange = e => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: name === 'userState' ? value === 'true' : value });
  };

  const handleSubmit = async e => {
    e.preventDefault();
    if (editId) {
      await axios.put(`http://localhost:8000/api/usuarios/${editId}`, formData);
      setEditId(null);
    } else {
      await axios.post('http://localhost:8000/api/usuarios', formData);
    }
    fetchUsuarios();
    setFormData({ Nombre: '', P_apellido: '', S_apellido: '', Pass: '', Correo: '', id_roles: '', userState: true });
  };

  const handleEdit = usuario => {
    setFormData({
      Nombre: usuario.Nombre,
      P_apellido: usuario.P_apellido,
      S_apellido: usuario.S_apellido,
      Pass: '',
      Correo: usuario.Correo,
      id_roles: usuario.id_roles,
      userState: usuario.userState,
    });
    setEditId(usuario.idUsuario);
  };

  const handleDelete = async id => {
    await axios.delete(`http://localhost:8000/api/usuarios/${id}`);
    fetchUsuarios();
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
        <h2 className="text-center text-white mb-4">CRUD de Usuarios</h2>
        <form onSubmit={handleSubmit} className="bg-dark p-4 rounded mb-4 text-white">
          <div className="row g-3">
            <div className="col-md-6">
              <input type="text" name="Nombre" placeholder="Nombre" className="form-control" value={formData.Nombre} onChange={handleChange} required />
            </div>
            <div className="col-md-6">
              <input type="text" name="P_apellido" placeholder="Primer Apellido" className="form-control" value={formData.P_apellido} onChange={handleChange} required />
            </div>
            <div className="col-md-6">
              <input type="text" name="S_apellido" placeholder="Segundo Apellido" className="form-control" value={formData.S_apellido} onChange={handleChange} />
            </div>
            <div className="col-md-6">
              <input type="email" name="Correo" placeholder="Correo" className="form-control" value={formData.Correo} onChange={handleChange} required />
            </div>
            <div className="col-md-6">
              <input type="password" name="Pass" placeholder="Contraseña" className="form-control" value={formData.Pass} onChange={handleChange} />
            </div>
            <div className="col-md-3">
              <input type="number" name="id_roles" placeholder="ID Rol" className="form-control" value={formData.id_roles} onChange={handleChange} required />
            </div>
            <div className="col-md-3">
              <select name="userState" className="form-control" value={formData.userState} onChange={handleChange}>
                <option value={true}>Activo</option>
                <option value={false}>Inactivo</option>
              </select>
            </div>
          </div>
          <button type="submit" className="btn btn-warning mt-3">{editId ? 'Actualizar Usuario' : 'Guardar Usuario'}</button>
        </form>

        <table className="table table-dark table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Rol</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {usuarios.map(usuario => (
              <tr key={usuario.idUsuario}>
                <td>{usuario.idUsuario}</td>
                <td>{usuario.Nombre} {usuario.P_apellido}</td>
                <td>{usuario.Correo}</td>
                <td>{usuario.id_roles}</td>
                <td>{usuario.userState ? 'Activo' : 'Inactivo'}</td>
                <td>
                  <button className="btn btn-info btn-sm me-2" onClick={() => handleEdit(usuario)}>Editar</button>
                  <button className="btn btn-danger btn-sm" onClick={() => handleDelete(usuario.idUsuario)}>Eliminar</button>
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

export default CrudUsuarios;

