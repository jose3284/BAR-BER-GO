<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud barberos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="/BAR-BER-GO/css/crud.css">
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
                <th scope="col">Primer Apellido</th>
                <th scope="col">Segundo Apellido</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            <?php
            require '../html/php/conexion.php';

            // Obtener todos los clientes
            $sql = "SELECT * FROM cliente";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $row['idCliente'] . "</th>";
                    echo "<td>" . $row['Nombre'] . "</td>";
                    echo "<td>" . $row['P_apellido'] . "</td>";
                    echo "<td>" . $row['S_apellido'] . "</td>";
                    echo "<td>" . $row['Contraseña'] . "</td>";
                    echo "<td>" . $row['Correo'] . "</td>";
                    echo "<td>";
                    echo "<a href='./php/editar_cliente.php?idCliente=" . $row['idCliente'] . "' class='btn btn-success'>Editar</a>";
                    
                    // Mostrar botón según el estado de bloqueo
                    if ($row['bloqueado'] == 1) {
                        echo "<button type='button' class='btn btn-warning' onclick='toggleBlock(" . $row['idCliente'] . ", false)'>Desbloquear</button>";
                    } else {
                        echo "<button type='button' class='btn btn-danger' onclick='toggleBlock(" . $row['idCliente'] . ", true)'>Bloquear</button>";
                    }
                    
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No se encontraron registros.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Pie de página -->
<footer class="bg-light text-center text-lg-start mt-4">
    <div class="text-center p-3">
        © 2024 BAR-BER-GO.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
crossorigin="anonymous"></script>

<script>
    function toggleBlock(idCliente, shouldBlock) {
        const action = shouldBlock ? 'bloquear_usuario.php' : 'desbloquear_usuario.php';
        fetch(`../html/php/${action}?idCliente=${idCliente}`, { method: 'GET' })
            .then(response => response.text())
            .then(data => {
                alert(data); // Mostrar el mensaje de respuesta
                location.reload(); // Recargar la página para ver los cambios
            })
            .catch(error => console.error('Error:', error));
    }
</script>
</body>
</html>




