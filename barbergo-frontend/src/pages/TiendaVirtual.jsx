import React, { useEffect, useState } from 'react';
import axios from 'axios';
import logo from '../assets/images/logo.png';
import '../assets/css/ClienteDashboard.css';
import { Link } from 'react-router-dom';

const TiendaVirtual = () => {
  const [productos, setProductos] = useState([]);
  const [mensaje, setMensaje] = useState('');

  const usuarioId = 1; // Simulado
  const metodoPagoId = 1; // Simulado

  useEffect(() => {
    const fetchProductos = async () => {
      try {
        const res = await axios.get('http://localhost:8000/api/producto');
        setProductos(res.data);
      } catch (err) {
        console.error('Error al obtener productos', err);
      }
    };
    fetchProductos();
  }, []);

  const comprarProducto = async (producto) => {
    const fecha = new Date();
    const hora = fecha.toTimeString().split(' ')[0].slice(0, 5);

    try {
      await axios.post('http://localhost:8000/api/recibos', {
        Fecha: fecha.toISOString().split('T')[0],
        Hora: hora,
        Total: producto.Precio,
        Producto_idProducto: producto.idProducto,
        Metodo_pago_idMetodo_pago: metodoPagoId,
        Usuarios_idUsuario: usuarioId,
      });
      setMensaje(`¡Compra exitosa! Recibo generado para ${producto.Nombre}`);
    } catch (err) {
      console.error('Error al generar recibo:', err);
      setMensaje('Error al generar el recibo. Intenta de nuevo.');
    }
  };

  return (
    <div className="body">
      <header className="encabezado">
        <img src={logo} alt="Logo" />
        <nav>
          <ul>
            <li><Link to="/cliente-dashboard"><h3>Volver al Dashboard</h3></Link></li>
          </ul>
        </nav>
      </header>

      <main className="container py-5">
        <h2 className="text-center mb-4">Productos Disponibles</h2>
        <div className="row">
          {productos.map((producto) => (
            <div className="col-md-4 mb-4" key={producto.idProducto}>
              <div className="card h-100 shadow" style={{ backgroundColor: '#2c2c2c', color: 'white' }}>
                {producto.imagen && (
                  <img src={producto.imagen} className="card-img-top" alt={producto.Nombre} />
                )}
                <div className="card-body">
                  <h5 className="card-title">{producto.Nombre}</h5>
                  <p className="card-text">Precio: ${producto.Precio}</p>
                  <p className="card-text">Cantidad disponible: {producto.Cantidad}</p>
                  <button className="btn btn-success w-100" onClick={() => comprarProducto(producto)}>
                    Comprar
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
        {mensaje && <div className="alert alert-info text-center mt-4">{mensaje}</div>}
      </main>

      <footer className="footer">
        <p>&copy; 2024 BAR_BER_GO.</p>
      </footer>
    </div>
  );
};

export default TiendaVirtual;
