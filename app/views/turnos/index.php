<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Turnos</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Listado de Turnos</h1>
            <a href="<?= site_url('turnos/create') ?>" class="btn btn-primary">
                <span class="btn-icon">➕</span>
                Nuevo Turno
            </a>
        </div>

        <div class="table-container">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Turno</th>
                        <th>ID Profesor</th>
                        <th>ID Carrera</th>
                        <th class="actions-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($turnos)): ?>
                        <?php foreach ($turnos as $t): ?>
                            <tr>
                                <td><?= esc($t['ID_Turno']) ?></td>
                                <td><?= esc($t['Turno']) ?></td>
                                <td><?= esc($t['ID_Profesor']) ?></td>
                                <td><?= esc($t['ID_Carrera']) ?></td>
                                <td class="actions-cell">
                                    <a href="<?= site_url('turnos/edit/' . $t['ID_Turno']) ?>" class="btn btn-sm btn-edit" title="Editar">
                                        ✏️ Editar
                                    </a>
                                    <a href="<?= site_url('turnos/delete/' . $t['ID_Turno']) ?>"
                                        class="btn btn-sm btn-delete"
                                        onclick="return confirm('¿Seguro que quieres eliminar este turno?')"
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
                                <p>No hay turnos registrados.</p>
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