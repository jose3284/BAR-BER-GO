import React, { useEffect, useState } from 'react';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../../assets/css/AdminDashboard.css';
import logo from '../../assets/images/logo.png';
import { Link } from 'react-router-dom';

const CrudProductos = () => {
  const [productos, setProductos] = useState([]);
  const [formData, setFormData] = useState({
    Nombre: '',
    Cantidad: '',
    Precio: '',
    imagen: '',
    id_categoria: ''
  });
  const [editId, setEditId] = useState(null);

  useEffect(() => {
    fetchProductos();
  }, []);

  const fetchProductos = async () => {
    const response = await axios.get('http://localhost:8000/api/producto');
    setProductos(response.data);
  };

  const handleChange = e => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async e => {
    e.preventDefault();
    if (editId) {
      await axios.put(`http://localhost:8000/api/producto/${editId}`, formData);
      setEditId(null);
    } else {
      await axios.post('http://localhost:8000/api/producto', formData);
    }
    fetchProductos();
    setFormData({ Nombre: '', Cantidad: '', Precio: '', imagen: '', id_categoria: '' });
  };

  const handleEdit = producto => {
    setFormData({
      Nombre: producto.Nombre,
      Cantidad: producto.Cantidad,
      Precio: producto.Precio,
      imagen: producto.imagen,
      id_categoria: producto.id_categoria
    });
    setEditId(producto.idProducto);
  };

  const handleDelete = async id => {
    await axios.delete(`http://localhost:8000/api/producto/${id}`);
    fetchProductos();
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
        <h2 className="text-center text-white mb-4">CRUD de Productos</h2>
        <form onSubmit={handleSubmit} className="bg-dark p-4 rounded mb-4 text-white">
          <div className="mb-3">
            <input type="text" name="Nombre" placeholder="Nombre del Producto" className="form-control" value={formData.Nombre} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <input type="number" name="Cantidad" placeholder="Cantidad" className="form-control" value={formData.Cantidad} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <input type="number" name="Precio" placeholder="Precio" className="form-control" value={formData.Precio} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <input type="text" name="imagen" placeholder="URL de Imagen" className="form-control" value={formData.imagen} onChange={handleChange} />
          </div>
          <div className="mb-3">
            <input type="number" name="id_categoria" placeholder="ID Categoría" className="form-control" value={formData.id_categoria} onChange={handleChange} required />
          </div>
          <button type="submit" className="btn btn-warning">
            {editId ? 'Actualizar Producto' : 'Guardar Producto'}
          </button>
        </form>

        <table className="table table-dark table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Precio</th>
              <th>Imagen</th>
              <th>ID Categoría</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {productos.map(producto => (
              <tr key={producto.idProducto}>
                <td>{producto.idProducto}</td>
                <td>{producto.Nombre}</td>
                <td>{producto.Cantidad}</td>
                <td>{producto.Precio}</td>
                <td><img src={producto.imagen} alt={producto.Nombre} width="50" /></td>
                <td>{producto.id_categoria}</td>
                <td>
                  <button className="btn btn-info btn-sm me-2" onClick={() => handleEdit(producto)}>Editar</button>
                  <button className="btn btn-danger btn-sm" onClick={() => handleDelete(producto.idProducto)}>Eliminar</button>
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

export default CrudProductos;
