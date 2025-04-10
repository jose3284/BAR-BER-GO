<main class="contenido-citas">
    <br><br><br>
    <h2>Citas agendadas</h2>

    <?php if (!empty($citas)): ?>
        
        <table class="tabla-citas">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th> <!-- Nueva columna -->
                </tr>
            </thead>
            <tbody>
    <?php foreach ($citas as $cita): ?>
        <tr>
            <td><?= htmlspecialchars($cita['nombre']) ?></td>
            <td><?= htmlspecialchars($cita['fecha']) ?></td>
            <td><?= htmlspecialchars($cita['hora']) ?></td>
            <td>
                <a href="editar_cita.php?id=<?= $cita['id'] ?>" class="btn-editar">Editar</a>
                <a href="eliminar_cita.php?id=<?= $cita['id'] ?>" class="btn-eliminar" onclick="return confirm('¿Seguro que quieres eliminar esta cita?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
        </table>
    <?php else: ?>
        <p>No hay citas agendadas.</p>
    <?php endif; ?>
</main>
