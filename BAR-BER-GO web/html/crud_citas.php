<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
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
        <button type="button" class="btn btn-primary" id="addBtn">Agregar</button>
    </div>
    <br><br>
    <table class="table table-striped-columns">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Celular</th>
                <th scope="col">Email</th>
                <th scope="col">Fecha de Creación</th>
                <th scope="col">Fecha de Actualización</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            <!-- Aquí se cargarán los datos de la API -->
        </tbody>
    </table>
</div>

<!-- Modal para agregar usuario -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Agregar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <!-- Campos del formulario de agregar usuario -->
                    <div class="mb-3">
                        <label for="addNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="addNombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="addCelular" class="form-label">Celular</label>
                        <input type="text" class="form-control" id="addCelular" required>
                    </div>
                    <div class="mb-3">
                        <label for="addEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="addEmail" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar usuario -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <div class="mb-3">
                        <label for="editNombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="editNombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCelular" class="form-label">Celular</label>
                        <input type="text" class="form-control" id="editCelular" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para eliminar usuario -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Eliminar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este usuario?</p>
                <input type="hidden" id="deleteId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="deleteUser()">Eliminar</button>
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
    let editingUserId = null;

    // Función para cargar los datos de la API y mostrar en la tabla
    function loadUsers() {
        fetch('http://localhost:8000/api/agendamientos')  // Cambia la URL con la de tu API
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('userTableBody');
                tableBody.innerHTML = '';  // Limpiar la tabla antes de agregar los nuevos datos

                data.forEach(user => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <th scope="row">${user.id}</th>
                        <td>${user.nombre}</td>
                        <td>${user.celular}</td>
                        <td>${user.email}</td>
                        <td>${new Date(user.created_at).toLocaleString()}</td>
                        <td>${new Date(user.updated_at).toLocaleString()}</td>
                        <td>
                            <button class="btn btn-warning" onclick="openEditModal(${user.id})">Editar</button>
                            <button class="btn btn-danger" onclick="openDeleteModal(${user.id})">Eliminar</button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error al cargar los usuarios:', error));
    }

    // Llamada inicial para cargar los usuarios al cargar la página
    window.onload = function() {
        loadUsers();
    };

    // Abre el modal de edición y carga los datos del usuario
    function openEditModal(id) {
        fetch(`http://localhost:8000/api/agendamientos/${id}`)
            .then(response => response.json())
            .then(user => {
                document.getElementById('editNombre').value = user.nombre;
                document.getElementById('editCelular').value = user.celular;
                document.getElementById('editEmail').value = user.email;
                editingUserId = user.id;
                
                var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                editModal.show();
            })
            .catch(error => console.error('Error al cargar los datos para editar:', error));
    }

    // Procesar el formulario de edición
    document.getElementById('editUserForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const nombre = document.getElementById('editNombre').value;
        const celular = document.getElementById('editCelular').value;
        const email = document.getElementById('editEmail').value;

        const updatedUser = { nombre, celular, email };

        // Enviar los cambios a la API
        fetch(`http://localhost:8000/api/agendamientos/${editingUserId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(updatedUser)
        })
        .then(response => response.json())
        .then(data => {
            loadUsers();
            alert('Usuario actualizado con éxito');
            window.location.reload();  // Recargar la página
            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.hide();
        })
        .catch(error => console.error('Error al actualizar el usuario:', error));
    });

    // Abre el modal de eliminación
    function openDeleteModal(id) {
        document.getElementById('deleteId').value = id;
        
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    // Función para eliminar un usuario
    function deleteUser() {
        const id = document.getElementById('deleteId').value;
        
        fetch(`http://localhost:8000/api/agendamientos/${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            loadUsers();
            alert('Usuario eliminado con éxito');
            window.location.reload();  // Recargar la página
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.hide();
        })
        .catch(error => console.error('Error al eliminar el usuario:', error));
    }

    // Redirigir al hacer clic en el botón Agregar
    document.getElementById('addBtn').addEventListener('click', function() {
        window.location.href = "http://127.0.0.1:5500/html/citas.html";  // Reemplaza con la URL a donde deseas redirigir
    });
</script>

</body>
</html>
