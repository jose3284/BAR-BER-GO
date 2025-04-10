document.addEventListener('DOMContentLoaded', (event) => {
    const submitButton = document.querySelector('.submit-button');
    const apiUrl = 'http://localhost:8000/api/cita'; // URL de la API REST

    submitButton.addEventListener('click', () => {
        const nombre = document.getElementById('nombre').value;
        const celular = document.getElementById('celular').value;
        const correo = document.getElementById('correo').value;
        const fecha = document.getElementById('fecha').value;
        const hora = document.getElementById('hora').value;

        if (!nombre || !celular || !correo || !fecha || !hora) {
            alert('Por favor, complete todos los campos');
            return;
        }

        const cita = {
            nombre: nombre,
            celular: celular,
            correo: correo,
            fecha: fecha,
            hora: hora
        };

        fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(cita)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Cita agendada:', data);
            alert('Tu cita ha sido agendada correctamente');
            window.location.href = '/BackEnd/Controllers/Dashboard.php';
        })
        .catch(error => {
            console.error('Error al agendar la cita:', error);
            alert('Hubo un error al agendar la cita. Intenta nuevamente');
        });
    });
});
