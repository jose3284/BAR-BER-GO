<?php

class Producto
{
    private $dbh;
    private $id_categoria;
    private $categoria;
    private $id_producto;
    private $producto_name;
    private $cantidad;
    private $precio;


    
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
    public function __construct6($id_categoria = null, $categoria = null, $id_producto = null, $producto_name = null, $cantidad = null, $precio = null)
    {
        $this->id_categoria = $id_categoria;
        $this->categoria = $categoria;
        $this->id_producto = $id_producto;
        $this->producto_name = $producto_name;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
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
            $sql = 'INSERT INTO  (Nombre, Cantidad, Precio, id_categoria) 
                    VALUES (:Nombre, :Cantidad, :Precio, :id_categoria)';
    
            $stmt = $this->dbh->prepare($sql);
    
            // Ejecutar la consulta con un array de parámetros
            $success = $stmt->execute([
                ':Nombre' => $this->getProductoName(),
                ':Cantidad' => $this->getCantidad(),
                ':Precio' => $this->getPrecio(),
                ':id_categoria' => $this ->getIdCategoria ()
            ]);
    
            if ($success) {
                echo "✅ Producto creado correctamente.";
            } else {
                echo "❌ Error al crear Producto.";
            }
        } catch (PDOException $e) {
            die("❌ Error en createProduct(): " . $e->getMessage());
        }
    }
    public function read_producto() {}
    public function getproducto_byid_categoria($id_categoria) {}
    public function update_producto() {}
    public function delete_producto() {}

}
