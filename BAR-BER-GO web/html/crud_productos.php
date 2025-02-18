<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
</head>
<body>
<header class="encabezado">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <img id="bar" src="../imagenes/bar-ber-go.png" alt="Logo" class="img-fluid">
            </div>
        </nav>
    </div>
</header>
<br><br>
<div class="container mt-4">
    <div class="col-md-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Agregar</button>
    </div>
    <br><br>
    <table class="table table-striped-columns">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Categoria del producto</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            <?php
            require '../html/crud_administrador/conexion.php';

            $sql = "SELECT * FROM producto";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $row['idProducto'] . "</th>";
                    echo "<td>" . $row['Nombre'] . "</td>";
                    echo "<td>" . $row['Cantidad'] . "</td>";
                    echo "<td>" . $row['Precio'] . "</td>";
                    echo "<td>";
                    switch ($row['Categoria_id']) {
                        case 1: echo 'Corte de cabello'; break;
                        case 2: echo 'Afeitado'; break;
                        case 3: echo 'Corte de barba y cejas'; break;
                        case 4: echo 'Coloracion'; break;
                        case 5: echo 'Tienda'; break;
                        default: echo 'Sin categoría';
                    }
                    echo "</td>";
                    echo "<td>";
                    echo "<a href='./crud_productos/editar_producto.php?idProducto=" . $row['idProducto'] . "' class='btn btn-success'>Editar</a>";
                    
                    if ($row['bloqueado'] == 1) {
                        echo "<button type='button' class='btn btn-warning' onclick='toggleBlock(" . $row['idProducto'] . ", false)'>Desbloquear</button>";
                    } else {
                        echo "<button type='button' class='btn btn-danger' onclick='toggleBlock(" . $row['idProducto'] . ", true)'>Bloquear</button>";
                    }
                    
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No se encontraron registros.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal para agregar producto -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="mb-3">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="Cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="Cantidad" name="Cantidad" required>
                    </div>
                    <div class="mb-3">
                        <label for="Precio" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="Precio" name="Precio" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria producto</label>
                        <select class="form-select" id="categoria" name="categoria" required>
                            <option value="" disabled selected>Seleccione un tipo de producto</option>
                            <option value="1">Corte de cabello</option>
                            <option value="2">Afeitado</option>
                            <option value="3">Corte de barba y cejas</option>
                            <option value="4">Coloracion</option>
                            <option value="5">Tienda</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar producto</button>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="bg-light text-center text-lg-start mt-4">
    <div class="text-center p-3">
        © 2024 BAR-BER-GO.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
crossorigin="anonymous"></script>

<script>
    document.getElementById('addUserForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        fetch('../html/crud_productos/agregar_producto.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload();
        })
        .catch(error => console.error('Error:', error));
    });

    function toggleBlock(idProducto, shouldBlock) {
        const action = shouldBlock ? 'bloquear_producto.php' : 'desbloquear_producto.php';
        fetch(`../html/crud_productos/${action}?idProducto=${idProducto}`, { method: 'GET' })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(error => console.error('Error:', error));
    }
</script>
</body>
</html>
