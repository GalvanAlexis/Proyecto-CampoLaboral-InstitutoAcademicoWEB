<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Carreras</title>
</head>

<body>

    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <h1>Listado de Carreras</h1>

    <a href="<?= site_url('carreras/create') ?>">➕ Nueva Carrera</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Carrera</th>
                <th>ID Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($carreras)): ?>
                <?php foreach ($carreras as $t): ?>
                    <tr>
                        <td><?= $t['ID_Carrera'] ?></td>
                        <td><?= $t['Nombre_Carrera'] ?></td>
                        <td><?= $t['ID_Categoria'] ?></td>
                        <td>
                            <a href="<?= site_url('carreras/edit/' . $t['ID_Carrera']) ?>">✏️ Editar</a> |
                            <a href="<?= site_url('carreras/delete/' . $t['ID_Carrera']) ?>" onclick="return confirm('¿Seguro que quieres eliminar esta carrera?')">🗑️ Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay carreras registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?= $this->endSection() ?>
</body>

</html>