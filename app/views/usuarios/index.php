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
                        <th>Nombre de usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha de registro</th>
                        <th>Última sesión</th>
                        <th class="actions-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach ($usuarios as $u): ?>
                            <tr>
                                <td><?= esc($u->id) ?></td>
                                <td><?= esc($u->username) ?></td>
                                <td><?= esc($u->email) ?></td>
                                <td>
                                    <?php
                                        $groups = $u->getGroups();
                                        echo !empty($groups) ? implode(', ', $groups) : 'Sin rol';
                                    ?>
                                </td>
                                <td><?= esc(date('d/m/Y H:i', strtotime($u->created_at))) ?></td>
                                <td>
                                    <?= $u->last_active ? esc(date('d/m/Y H:i', strtotime($u->last_active))) : 'Nunca' ?>
                                </td>
                                <td class="actions-cell">
                                    <a href="<?= site_url('usuarios/edit/' . $u->id) ?>" class="btn btn-sm btn-edit" title="Editar">
                                        ✏️ Editar
                                    </a>
                                    <a href="<?= site_url('usuarios/delete/' . $u->id) ?>"
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
                            <td colspan="7" class="empty-state">
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