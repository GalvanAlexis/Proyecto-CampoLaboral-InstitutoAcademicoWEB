<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Categorías</title>
</head>

<body>

    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <h1>Listado de Categorías</h1>

    <a href="<?= site_url('categorias/create') ?>">➕ Nueva Categoría</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID_Categoria</th>
                <th>Categoria</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($categorias)): ?>
                <?php foreach ($categorias as $t): ?>
                    <tr>
                        <td><?= $t['ID_Categoria'] ?></td>
                        <td><?= $t['Categoria'] ?></td>
                        <td>
                            <a href="<?= site_url('categorias/edit/' . $t['ID_Categoria']) ?>">✏️ Editar</a> |
                            <a href="<?= site_url('categorias/delete/' . $t['ID_Categoria']) ?>" onclick="return confirm('¿Seguro que quieres eliminar esta categoría?')">🗑️ Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay categorías registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?= $this->endSection() ?>
</body>

</html>