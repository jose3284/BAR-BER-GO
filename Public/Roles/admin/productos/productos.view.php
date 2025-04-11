

<section>
    <h2>Agregar producto</h2>
    <form action="index.php?c=Producto&f=crear" method="POST" enctype="multipart/form-data">
        <input type="text" name="Nombre" placeholder="Nombre del producto" required>
        <input type="number" name="Cantidad" placeholder="Cantidad" required>
        <input type="number" name="Precio" placeholder="Precio" required>
        <select name="id_categoria" required>
            <option value="">Seleccione una categoría</option>
            <?php if (!empty($categorias)): ?>
    <?php foreach ($categorias as $categoria): ?>
        <option value="<?= $categoria->getIdCategoria(); ?>"><?= $categoria->getCategoria(); ?></option>
    <?php endforeach; ?>
<?php endif; ?>
        </select>
        <input type="file" name="imagen" accept="image/*" required>
        <button type="submit">Guardar</button>
    </form>
</section>

<hr>

<section>
    <h2>Listado de productos</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><img src="uploads/<?= $producto->getImagen(); ?>" width="60"></td>
                    <td><?= $producto->getProductoName(); ?></td>
                    <td><?= $producto->getCantidad(); ?></td>
                    <td>$<?= $producto->getPrecio(); ?></td>
                    <td><?= $producto->getIdCategoria(); ?></td>
                    <td>
                        <a href="index.php?c=Producto&f=editar&id=<?= $producto->getIdProducto(); ?>">✏️ Editar</a> |
                        <a href="index.php?c=Producto&f=eliminar&id=<?= $producto->getIdProducto(); ?>" onclick="return confirm('¿Estás seguro de eliminar este producto?')">🗑️ Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="6">No hay productos registrados.</td></tr>
<?php endif; ?>
        </tbody>
    </table>
</section>

