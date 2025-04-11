<?php

require_once __DIR__ . '/Database.php';

class Producto
{
    private $dbh;
    private $id_categoria;
    private $categoria;
    private $id_producto;
    private $producto_name;
    private $cantidad;
    private $precio;
    private $imagen;


    
    public function __construct() {
        try {
            $this->dbh = DataBase::connection();                
            $args = func_get_args();
            $num = func_num_args();
            if (method_exists($this, $f = '__construct' . $num)) {
                call_user_func_array([$this, $f], $args);
            }
        } catch (Exception $e) {
            die("❌ Constructor error: " . $e->getMessage());
        }
    }


    // Constructor opcional
    public function __construct7($id_categoria = null, $categoria = null, $id_producto = null, $producto_name = null, $cantidad = null, $precio = null,$imagen = null)
    {
        $this->id_categoria = $id_categoria;
        $this->categoria = $categoria;
        $this->id_producto = $id_producto;
        $this->producto_name = $producto_name;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->imagen = $imagen;
    }

    // Getters
    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function getIdProducto()
    {
        return $this->id_producto;
    }

    public function getProductoName()
    {
        return $this->producto_name;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getPrecio()
    {
        return $this->precio;
    }
    public function getImagen(){

        return $this->imagen;
    }

    // Setters
    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }

    public function setProductoName($producto_name)
    {
        $this->producto_name = $producto_name;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    public function setImagen($imagen){

        $this->imagen = $imagen;
    }

 # Crear categoria

    public function create_categoria() {

            try {
                $sql = 'INSERT INTO categoria VALUES (:id_categoria,:categoria)';
                $stmt = $this->dbh->prepare($sql);
                $stmt->bindValue('id_categoria', $this->getIdCategoria());
                $stmt->bindValue('categoria', $this->getCategoria());
                $stmt->execute();
            } catch (Exception $e) {
                die($e->getMessage());
            }
    }

    # Buscar categorias 

    public function readCategorias() {
        try {
            $categoriaList = [];
            $sql = 'SELECT * FROM categoria';
            $stmt = $this->dbh->query($sql);
    
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $categoria) {
                $categoriaObj = new Producto();
                $categoriaObj->setIdCategoria($categoria['id_categoria']);
                $categoriaObj->setCategoria($categoria['categoria_name']);
                $categoriaList[] = $categoriaObj;
            }
    
            return $categoriaList;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    # Actualizar categorias

    public function updateCategoria(){
        try {
            $sql = 'UPDATE categoria SET
                        id_categoria = :Id_categoria,
                        categoria = :categoria
                    WHERE id_categoria = :Id_categoria';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('Id_categoria', $this->getIdCategoria());
            $stmt->bindValue('categoria', $this->getCategoria());
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    # Eliminar categoria

    public function deleteCategoria($id_categoria){
        try {
            $sql = 'DELETE FROM categoria WHERE id_categoria = :Id_categoria';
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindValue('Id_categoria', $id_categoria);
            $stmt->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    # Crear producto

    public function create_producto() {
        try {
            $sql = 'INSERT INTO productos (Nombre, Cantidad, Precio, id_categoria, imagen) 
                    VALUES (:Nombre, :Cantidad, :Precio, :id_categoria, :imagen)';
    
            $stmt = $this->dbh->prepare($sql);
    
            $success = $stmt->execute([
                ':Nombre' => $this->getProductoName(),
                ':Cantidad' => $this->getCantidad(),
                ':Precio' => $this->getPrecio(),
                ':id_categoria' => $this->getIdCategoria(),
                ':imagen' => $this->getImagen()
            ]);
    
            if ($success) {
                echo "✅ Producto creado correctamente.";
            } else {
                echo "❌ Error al crear Producto.";
            }
        } catch (PDOException $e) {
            die("❌ Error en create_producto(): " . $e->getMessage());
        }
    }
    
    public function read_producto() {
        try {
            $productoList = [];
            $sql = 'SELECT * FROM producto';
            $stmt = $this->dbh->query($sql);
    
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $producto) {
                $productoObj = new Producto();
                $productoObj->setIdProducto($producto['idProducto']);
                $productoObj->setProductoName($producto['Nombre']);
                $productoObj->setCantidad($producto['Cantidad']);
                $productoObj->setPrecio($producto['Precio']);
                $productoObj->setIdCategoria($producto['id_categoria']);
    
                // Si tienes columna imagen:
                if (isset($producto['imagen'])) {
                    $productoObj->setImagen($producto['imagen']);
                }
    
                $productoList[] = $productoObj;
            }
    
            return $productoList;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function getproducto_byid_categoria($id_categoria) {
        try {
            // Aseguramos que el valor sea entero por seguridad
            $id_categoria = intval($id_categoria);
    
            // Consulta preparada para evitar inyecciones SQL
            $query = "SELECT * FROM productos WHERE id_categoria = :id_categoria";
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $stmt->execute();
    
            // Obtenemos todos los productos como array asociativo
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $productos ?: []; // Devuelve array vacío si no hay resultados
        } catch (PDOException $e) {
            // En entorno de desarrollo puedes imprimir el error
            // En producción es mejor registrarlo y devolver un mensaje genérico
            return ['error' => 'Error al obtener productos por categoría.'];
        }
    }
    
    public function update_producto() {
        try {
            $sql = 'UPDATE producto SET
                        idProducto = :idProducto,
                        Nombre = :Nombre,
                        Cantidad = :Cantidad,
                        Precio = :Precio,
                        imagen = :imagen,
                        id_categoria = :id_categoria,
                    WHERE idProducto = :idProducto';
    
            $stmt = $this->dbh->prepare($sql);
    
            // Asegurar que los nombres de los parámetros coincidan con la base de datos
            $stmt->bindValue(':idProducto', $this->getIdProducto(), PDO::PARAM_INT);
            $stmt->bindValue(':Nombre', $this->getProductoName(), PDO::PARAM_STR);
            $stmt->bindValue(':Cantidad', $this->getCantidad(), PDO::PARAM_INT);
            $stmt->bindValue(':Precio', $this->getPrecio(), PDO::PARAM_INT);
            $stmt->bindValue(':imagen', $this->getImagen(), PDO::PARAM_STR);
            $stmt->bindValue(':id_categoria', $this->getIdCategoria(), PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                echo "✅ Producto actualizado correctamente.";
            } else {
                echo "❌ Error al actualizar Producto.";
            }
        } catch (Exception $e) {
            die("❌ Error en update_producto(): " . $e->getMessage());
        }
    }
    public function delete_producto($id_producto) {  
         try {
        $sql = 'DELETE FROM producto WHERE idProducto = :IdProducto';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue('IdProducto', $id_producto);
        $stmt->execute();
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

}
