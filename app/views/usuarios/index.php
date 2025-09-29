<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
</head>

<body>

    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <h1>Listado de Usuarios</h1>

    <a href="<?= site_url('usuarios/create') ?>">➕ Nuevo Usuario</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>ID_Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($usuarios)): ?>
                <?php foreach ($usuarios as $t): ?>
                    <tr>
                        <td><?= $t['ID_Usuario'] ?></td>
                        <td><?= $t['Email'] ?></td>
                        <td><?= $t['ID_Rol'] ?></td>
                        <td>
                            <a href="<?= site_url('usuarios/edit/' . $t['ID_Usuario']) ?>">✏️ Editar</a> |
                            <a href="<?= site_url('usuarios/delete/' . $t['ID_Usuario']) ?>" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">🗑️ Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay usuarios registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?= $this->endSection() ?>
</body>

</html>