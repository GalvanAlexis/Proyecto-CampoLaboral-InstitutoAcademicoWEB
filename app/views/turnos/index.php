<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de Turnos</title>
</head>
<body>
    <h1>Listado de Turnos</h1>

    <a href="<?= site_url('turnos/create') ?>">➕ Nuevo Turno</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Turno</th>
                <th>ID Profesor</th>
                <th>ID Carrera</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($turnos)): ?>
                <?php foreach ($turnos as $t): ?>
                    <tr>
                        <td><?= $t['ID_Turno'] ?></td>
                        <td><?= $t['Turno'] ?></td>
                        <td><?= $t['ID_Profesor'] ?></td>
                        <td><?= $t['ID_Carrera'] ?></td>
                        <td>
                            <a href="<?= site_url('turnos/edit/'.$t['ID_Turno']) ?>">✏️ Editar</a> | 
                            <a href="<?= site_url('turnos/delete/'.$t['ID_Turno']) ?>" onclick="return confirm('¿Seguro que quieres eliminar este turno?')">🗑️ Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No hay turnos registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
