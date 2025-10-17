    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Nueva Carrera</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    </head>

    <body>
        <?= $this->extend('templates/layout') ?>
        <?= $this->section('content') ?>

        <div class="crud-container">
            <div class="crud-header">
                <h1 class="crud-title">Nueva Carrera</h1>
            </div>

            <div class="form-container">
                <form method="post" action="<?= site_url('carreras/store') ?>" class="crud-form">
                    <div class="form-group">
                        <label for="Nombre_Carrera" class="form-label">Carrera:</label>
                        <input type="text" id="Nombre_Carrera" name="Nombre_Carrera" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="ID_Categoria" class="form-label">Categoría:</label>
                        <select id="ID_Categoria" name="ID_Categoria" class="form-input" required>
                            <option value="">-- Selecciona una categoría --</option>
                            <?php if (!empty($categorias)): ?>
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?= esc($cat['ID_Categoria']) ?>"><?= esc($cat['Categoria']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            💾 Guardar
                        </button>
                        <a href="<?= site_url('carreras') ?>" class="btn btn-secondary">
                            ⬅️ Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <?= $this->endSection() ?>
    </body>

    </html>
    </body>

    </html>