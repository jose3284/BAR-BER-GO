import React, { useEffect, useState } from 'react';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../../assets/css/AdminDashboard.css';
import logo from '../../assets/images/logo.png';
import { Link } from 'react-router-dom';

const CrudRecibos = () => {
  const [recibos, setRecibos] = useState([]);
  const [formData, setFormData] = useState({
    Fecha: '',
    Hora: '',
    Total: '',
    Producto_idProducto: '',
    Metodo_pago_idMetodo_pago: '',
    Usuarios_idUsuario: ''
  });
  const [editId, setEditId] = useState(null);

  useEffect(() => {
    fetchRecibos();
  }, []);

  const fetchRecibos = async () => {
    const response = await axios.get('http://localhost:8000/api/recibos');
    setRecibos(response.data);
  };

  const handleChange = e => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async e => {
    e.preventDefault();
    if (editId) {
      await axios.put(`http://localhost:8000/api/recibos/${editId}`, formData);
      setEditId(null);
    } else {
      await axios.post('http://localhost:8000/api/recibos', formData);
    }
    fetchRecibos();
    setFormData({
      Fecha: '',
      Hora: '',
      Total: '',
      Producto_idProducto: '',
      Metodo_pago_idMetodo_pago: '',
      Usuarios_idUsuario: ''
    });
  };

  const handleEdit = recibo => {
    setFormData({
      Fecha: recibo.Fecha,
      Hora: recibo.Hora,
      Total: recibo.Total,
      Producto_idProducto: recibo.Producto_idProducto,
      Metodo_pago_idMetodo_pago: recibo.Metodo_pago_idMetodo_pago,
      Usuarios_idUsuario: recibo.Usuarios_idUsuario
    });
    setEditId(recibo.id);
  };

  const handleDelete = async id => {
    await axios.delete(`http://localhost:8000/api/recibos/${id}`);
    fetchRecibos();
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
        <h2 className="text-center text-white mb-4">CRUD de Recibos</h2>
        <form onSubmit={handleSubmit} className="bg-dark p-4 rounded mb-4 text-white">
          <div className="mb-3">
            <input type="date" name="Fecha" className="form-control" value={formData.Fecha} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <input type="time" name="Hora" className="form-control" value={formData.Hora} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <input type="number" name="Total" className="form-control" placeholder="Total" value={formData.Total} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <input type="number" name="Producto_idProducto" className="form-control" placeholder="ID Producto" value={formData.Producto_idProducto} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <input type="number" name="Metodo_pago_idMetodo_pago" className="form-control" placeholder="ID Método Pago" value={formData.Metodo_pago_idMetodo_pago} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <input type="number" name="Usuarios_idUsuario" className="form-control" placeholder="ID Usuario" value={formData.Usuarios_idUsuario} onChange={handleChange} required />
          </div>
          <button type="submit" className="btn btn-warning">
            {editId ? 'Actualizar Recibo' : 'Guardar Recibo'}
          </button>
        </form>

        <table className="table table-dark table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Total</th>
              <th>Producto</th>
              <th>Método de Pago</th>
              <th>Usuario</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {recibos.map(recibo => (
              <tr key={recibo.id}>
                <td>{recibo.id}</td>
                <td>{recibo.Fecha}</td>
                <td>{recibo.Hora}</td>
                <td>{recibo.Total}</td>
                <td>{recibo.producto?.Nombre || recibo.Producto_idProducto}</td>
                <td>{recibo.metodo_pago?.Metodo_pago || recibo.Metodo_pago_idMetodo_pago}</td>
                <td>{recibo.usuario?.Nombre || recibo.Usuarios_idUsuario}</td>
                <td>
                  <button className="btn btn-info btn-sm me-2" onClick={() => handleEdit(recibo)}>Editar</button>
                  <button className="btn btn-danger btn-sm" onClick={() => handleDelete(recibo.id)}>Eliminar</button>
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

export default CrudRecibos;
