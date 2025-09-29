<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Profesores</title>
</head>

<body>

    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <h1>Listado de Profesores</h1>

    <a href="<?= site_url('profesores/create') ?>">➕ Nuevo Profesor</a>

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
            <?php if (!empty($profesores)): ?>
                <?php foreach ($profesores as $t): ?>
                    <tr>
                        <td><?= $t['ID_Profesor'] ?></td>
                        <td><?= $t['Nombre_Completo'] ?></td>
                        <td><?= $t['DNI'] ?></td>
                        <td><?= $t['Email'] ?></td>
                        <td>
                            <a href="<?= site_url('profesores/edit/' . $t['ID_Profesor']) ?>">✏️ Editar</a> |
                            <a href="<?= site_url('profesores/delete/' . $t['ID_Profesor']) ?>" onclick="return confirm('¿Seguro que quieres eliminar este profesor?')">🗑️ Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay profesores registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?= $this->endSection() ?>
</body>

</html>