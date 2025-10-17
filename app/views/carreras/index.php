    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Listado de Carreras</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    </head>

    <body>
        <?= $this->extend('templates/layout') ?>
        <?= $this->section('content') ?>

        <div class="crud-container">
            <div class="crud-header">
                <h1 class="crud-title">Listado de Carreras</h1>
                <a href="<?= site_url('carreras/create') ?>" class="btn btn-primary">
                    <span class="btn-icon">➕</span>
                    Nueva Carrera
                </a>
            </div>

            <div class="table-container">
                <table class="crud-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Carrera</th>
                            <th>Categoría</th>
                            <th class="actions-column">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($carreras)): ?>
                            <?php foreach ($carreras as $t): ?>
                                <tr>
                                    <td><?= $t['ID_Carrera'] ?></td>
                                    <td><?= $t['Nombre_Carrera'] ?></td>
                                    <td><?= isset($t['Nombre_Categoria']) ? esc($t['Nombre_Categoria']) : esc($t['ID_Categoria']) ?></td>
                                    <td class="actions-cell">
                                        <a href="<?= site_url('carreras/edit/' . $t['ID_Carrera']) ?>" class="btn btn-sm btn-edit" title="Editar">
                                            ✏️ Editar
                                        </a>
                                        <a href="<?= site_url('carreras/delete/' . $t['ID_Carrera']) ?>"
                                            class="btn btn-sm btn-delete"
                                            onclick="return confirm('¿Seguro que quieres eliminar esta carrera?')"
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
                                    <p>No hay carreras registradas.</p>
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
    </body>

    </html>