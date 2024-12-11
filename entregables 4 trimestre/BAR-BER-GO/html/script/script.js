document.addEventListener("DOMContentLoaded", () => {
    fetchUsers();

    document.getElementById('addUserBtn').addEventListener('click', () => {
        openModal('Agregar Cliente');
    });

    document.getElementById('userForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = document.getElementById('userId').value;
        if (id) {
            await updateUser(id);
        } else {
            await addUser();
        }
        closeModal();
        fetchUsers();
    });

    document.getElementById('closeModal').addEventListener('click', closeModal);
});

async function fetchUsers() {
    const response = await fetch('/BAR-BER-GO/html/php/usuarios.php');
    const users = await response.json();
    const tableBody = document.getElementById('userTableBody');
    tableBody.innerHTML = '';

    users.forEach(user => {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${user.idCliente}</td>
            <td>${user.Nombre}</td>
            <td>${user.P_apellido}</td>
            <td>${user.S_apellido}</td>
            <td>${user.Correo}</td>
            <td>
                <button onclick="editUser(${user.idCliente})">Editar</button>
                <button onclick="deleteUser(${user.idCliente})">Eliminar</button>
            </td>
        `;
        tableBody.appendChild(newRow);
    });
}

async function addUser() {
    const nombre = document.getElementById('nombre').value;
    const pApellido = document.getElementById('pApellido').value;
    const sApellido = document.getElementById('sApellido').value;
    const correo = document.getElementById('correo').value;

    await fetch('api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ Nombre: nombre, P_apellido: pApellido, S_apellido: sApellido, Correo: correo })
    });
}

async function editUser(id) {
    const response = await fetch(`api.php?idClient=${id}`);
    const user = await response.json();
    document.getElementById('userId').value = user.idCliente;
    document.getElementById('nombre').value = user.Nombre;
    document.getElementById('pApellido').value = user.P_apellido;
    document.getElementById('sApellido').value = user.S_apellido;
    document.getElementById('correo').value = user.Correo;
    openModal('Editar Cliente');
}

async function updateUser(id) {
    const nombre = document.getElementById('nombre').value;
    const pApellido = document.getElementById('pApellido').value;
    const sApellido = document.getElementById('sApellido').value;
    const correo = document.getElementById('correo').value;

    await fetch('api.php', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ idCliente: id, Nombre: nombre, P_apellido: pApellido, S_apellido: sApellido, Correo: correo })
    });
}

async function deleteUser(id) {
    await fetch(`api.php?idClient=${id}`, {
        method: 'DELETE'
    });
    fetchUsers();
}

function openModal(title) {
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('userModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('userModal').style.display = 'none';
    document.getElementById('userForm').reset();
    document.getElementById('userId').value = '';
}
