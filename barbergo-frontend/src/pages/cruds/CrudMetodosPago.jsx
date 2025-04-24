import React, { useEffect, useState } from 'react';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../../assets/css/AdminDashboard.css';
import logo from '../../assets/images/logo.png';
import { Link } from 'react-router-dom';

const CrudMetodosPago = () => {
  const [metodos, setMetodos] = useState([]);
  const [formData, setFormData] = useState({
    Metodo_pago: ''
  });
  const [editId, setEditId] = useState(null);

  useEffect(() => {
    fetchMetodos();
  }, []);

  const fetchMetodos = async () => {
    const response = await axios.get('http://localhost:8000/api/metodo-pago');
    setMetodos(response.data);
  };

  const handleChange = e => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async e => {
    e.preventDefault();
    if (editId) {
      await axios.put(`http://localhost:8000/api/metodo-pago/${editId}`, formData);
      setEditId(null);
    } else {
      await axios.post('http://localhost:8000/api/metodo-pago', formData);
    }
    fetchMetodos();
    setFormData({ Metodo_pago: '' });
  };

  const handleEdit = metodo => {
    setFormData({ Metodo_pago: metodo.Metodo_pago });
    setEditId(metodo.id);
  };

  const handleDelete = async id => {
    await axios.delete(`http://localhost:8000/api/metodo-pago/${id}`);
    fetchMetodos();
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
        <h2 className="text-center text-white mb-4">CRUD de Métodos de Pago</h2>
        <form onSubmit={handleSubmit} className="bg-dark p-4 rounded mb-4 text-white">
          <div className="mb-3">
            <input
              type="text"
              name="Metodo_pago"
              placeholder="Nombre del Método de Pago"
              className="form-control"
              value={formData.Metodo_pago}
              onChange={handleChange}
              required
            />
          </div>
          <button type="submit" className="btn btn-warning">
            {editId ? 'Actualizar Método' : 'Guardar Método'}
          </button>
        </form>

        <table className="table table-dark table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Método de Pago</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {metodos.map(metodo => (
              <tr key={metodo.id}>
                <td>{metodo.id}</td>
                <td>{metodo.Metodo_pago}</td>
                <td>
                  <button className="btn btn-info btn-sm me-2" onClick={() => handleEdit(metodo)}>Editar</button>
                  <button className="btn btn-danger btn-sm" onClick={() => handleDelete(metodo.id)}>Eliminar</button>
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

export default CrudMetodosPago;
