<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Alumnos</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Listado de Alumnos</h1>
            <a href="<?= site_url('alumnos/create') ?>" class="btn btn-primary">
                <span class="btn-icon">➕</span>
                Nuevo Alumno
            </a>
        </div>

        <div class="table-container">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Email</th>
                        <th class="actions-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($alumnos)): ?>
                        <?php foreach ($alumnos as $t): ?>
                            <tr>
                                <td><?= esc($t['ID_Alumno']) ?></td>
                                <td><?= esc($t['Nombre_Completo']) ?></td>
                                <td><?= esc($t['DNI']) ?></td>
                                <td><?= esc($t['Email']) ?></td>
                                <td class="actions-cell">
                                    <a href="<?= site_url('alumnos/edit/' . $t['ID_Alumno']) ?>" class="btn btn-sm btn-edit" title="Editar">
                                        ✏️ Editar
                                    </a>
                                    <a href="<?= site_url('alumnos/delete/' . $t['ID_Alumno']) ?>"
                                        class="btn btn-sm btn-delete"
                                        onclick="return confirm('¿Seguro que quieres eliminar este alumno?')"
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
                                <p>No hay alumnos registrados.</p>
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