import React, { useEffect, useState } from 'react';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../../assets/css/AdminDashboard.css';
import logo from '../../assets/images/logo.png';
import { Link } from 'react-router-dom';

const CrudCategorias = () => {
  const [categorias, setCategorias] = useState([]);
  const [formData, setFormData] = useState({ categoria: '' });
  const [editId, setEditId] = useState(null);

  useEffect(() => {
    fetchCategorias();
  }, []);

  const fetchCategorias = async () => {
    const response = await axios.get('http://localhost:8000/api/categorias');
    setCategorias(response.data);
  };

  const handleChange = e => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async e => {
    e.preventDefault();
    if (editId) {
      await axios.put(`http://localhost:8000/api/categorias/${editId}`, formData);
      setEditId(null);
    } else {
      await axios.post('http://localhost:8000/api/categorias', formData);
    }
    fetchCategorias();
    setFormData({ categoria: '' });
  };

  const handleEdit = categoria => {
    setFormData({ categoria: categoria.categoria });
    setEditId(categoria.id);
  };

  const handleDelete = async id => {
    await axios.delete(`http://localhost:8000/api/categorias/${id}`);
    fetchCategorias();
  };

  return (
    <div className="body">
      <header className="encabezado">
        <img src={logo} alt="Logo" />
        <nav>
          <ul><li><Link to="/vendedor-dashboard"><h3>Volver al Dashboard</h3></Link></li></ul>
        </nav>
      </header>

      <main className="container mt-5">
        <h2 className="text-center text-white mb-4">CRUD de Categorías</h2>
        <form onSubmit={handleSubmit} className="bg-dark p-4 rounded mb-4 text-white">
          <div className="mb-3">
            <input type="text" name="categoria" placeholder="Nombre de la Categoría" className="form-control" value={formData.categoria} onChange={handleChange} required />
          </div>
          <button type="submit" className="btn btn-warning">
            {editId ? 'Actualizar Categoría' : 'Guardar Categoría'}
          </button>
        </form>

        <table className="table table-dark table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre de la Categoría</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {categorias.map(categoria => (
              <tr key={categoria.id}>
                <td>{categoria.id}</td>
                <td>{categoria.categoria}</td>
                <td>
                  <button className="btn btn-info btn-sm me-2" onClick={() => handleEdit(categoria)}>Editar</button>
                  <button className="btn btn-danger btn-sm" onClick={() => handleDelete(categoria.id)}>Eliminar</button>
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

export default CrudCategorias;
