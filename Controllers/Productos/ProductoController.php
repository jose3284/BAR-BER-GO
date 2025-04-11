<?php

require_once '/BackEnd/Models/Producto/producto.php';

class ProductoController
{
    private $model;

    public function __construct()
    {
        $this->model = new Producto();
    }

    public function index()
    {
        $productos = $this->model->read_producto();
        $categorias = $this->model->readCategorias(); // <- Usa el nombre correcto del método
    
        include 'Public/Roles/admin/productos/header.view.php';
        include 'Public/Roles/admin/productos/productos.view.php';
        include 'Public/Roles/admin/productos/footer.view.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto = new Producto();
            $producto->setProductoName($_POST['Nombre']);
            $producto->setCantidad($_POST['Cantidad']);
            $producto->setPrecio($_POST['Precio']);
            $producto->setIdCategoria($_POST['id_categoria']);

            // Manejo de imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $ruta = 'Assets/img/';
                $nombreArchivo = basename($_FILES['imagen']['name']);
                $destino = $ruta . $nombreArchivo;

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
                    $producto->setImagen($nombreArchivo); // Solo guarda el nombre
                }
            }

            $producto->create_producto();
            header('Location: index.php?c=Producto');
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $producto = $this->model->getproducto_byid_categoria($id); // Asegúrate de tener este método
            $categorias = $this->model->readCategorias();
            if ($producto) {
                require_once __DIR__ . '/../../Public/Roles/admin/productos/editar_producto.view.php';
                return;
            }
        }
        echo "Producto no encontrado.";
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto = new Producto();
            $producto->setIdProducto($_POST['idProducto']);
            $producto->setProductoName($_POST['Nombre']);
            $producto->setCantidad($_POST['Cantidad']);
            $producto->setPrecio($_POST['Precio']);
            $producto->setIdCategoria($_POST['id_categoria']);

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $ruta = 'Assets/img/';
                $nombreArchivo = basename($_FILES['imagen']['name']);
                $destino = $ruta . $nombreArchivo;
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
                    $producto->setImagen($nombreArchivo);
                }
            }

            $producto->update_producto();
            header('Location: index.php?c=Producto');
        }
    }

    public function destroy()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->delete_producto($id);
            header('Location: index.php?c=Producto');
        }
    }
}
