<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Usuarios</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Listado de Usuarios</h1>
            <a href="<?= site_url('usuarios/create') ?>" class="btn btn-primary">
                <span class="btn-icon">➕</span>
                Nuevo Usuario
            </a>
        </div>

        <div class="table-container">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>ID Rol</th>
                        <th>Fecha de Registro</th>
                        <th>Última Sesión</th>
                        <th class="actions-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach ($usuarios as $t): ?>
                            <tr>
                                <td><?= $t['ID_Usuario'] ?></td>
                                <td><?= $t['Email'] ?></td>
                                <td><?= $t['ID_Rol'] ?></td>
                                <td><?= $t['fecha_registro'] ?></td>
                                <td><?= $t['ultimo_login'] ?></td>
                                <td class="actions-cell">
                                    <a href="<?= site_url('usuarios/edit/' . $t['ID_Usuario']) ?>" class="btn btn-sm btn-edit" title="Editar">
                                        ✏️ Editar
                                    </a>
                                    <a href="<?= site_url('usuarios/delete/' . $t['ID_Usuario']) ?>"
                                        class="btn btn-sm btn-delete"
                                        onclick="return confirm('¿Seguro que quieres eliminar este usuario?')"
                                        title="Eliminar">
                                        🗑️ Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="empty-state">
                                <div class="empty-icon">📋</div>
                                <p>No hay usuarios registrados.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?= $this->endSection() ?>
</body>

</html>