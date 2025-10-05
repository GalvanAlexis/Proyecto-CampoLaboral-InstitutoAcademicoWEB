<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Listado de Categorías</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Listado de Categorías</h1>
            <a href="<?= site_url('categorias/create') ?>" class="btn btn-primary">
                <span class="btn-icon">➕</span>
                Nueva Categoría
            </a>
        </div>

        <div class="table-container">
            <table class="crud-table">
                <thead>
                    <tr>
                        <th>ID Categoria</th>
                        <th>Categoria</th>
                        <th class="actions-column">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($categorias)): ?>
                        <?php foreach ($categorias as $t): ?>
                            <tr>
                                <td><?= esc($t['ID_Categoria']) ?></td>
                                <td><?= esc($t['Categoria']) ?></td>
                                <td class="actions-cell">
                                    <a href="<?= site_url('categorias/edit/' . $t['ID_Categoria']) ?>" class="btn btn-sm btn-edit" title="Editar">
                                        ✏️ Editar
                                    </a>
                                    <a href="<?= site_url('categorias/delete/' . $t['ID_Categoria']) ?>"
                                        class="btn btn-sm btn-delete"
                                        onclick="return confirm('¿Seguro que quieres eliminar esta categoría?')"
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
                                <p>No hay categorías registradas.</p>
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