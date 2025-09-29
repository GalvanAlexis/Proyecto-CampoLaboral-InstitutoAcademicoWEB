<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Alumnos</title>
</head>

<body>

    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <h1>Listado de Alumnos</h1>

    <a href="<?= site_url('alumnos/create') ?>">➕ Nuevo Alumno</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($alumnos)): ?>
                <?php foreach ($alumnos as $t): ?>
                    <tr>
                        <td><?= $t['ID_Alumno'] ?></td>
                        <td><?= $t['Nombre_Completo'] ?></td>
                        <td><?= $t['DNI'] ?></td>
                        <td><?= $t['Email'] ?></td>
                        <td>
                            <a href="<?= site_url('alumnos/edit/' . $t['ID_Alumno']) ?>">✏️ Editar</a> |
                            <a href="<?= site_url('alumnos/delete/' . $t['ID_Alumno']) ?>" onclick="return confirm('¿Seguro que quieres eliminar este alumno?')">🗑️ Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay alumnos registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?= $this->endSection() ?>
</body>

</html>