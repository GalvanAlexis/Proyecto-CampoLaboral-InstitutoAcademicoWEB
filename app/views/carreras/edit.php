    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Editar Carrera</title>
        <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    </head>

    <body>
        <?= $this->extend('templates/layout') ?>
        <?= $this->section('content') ?>

        <div class="crud-container">
            <div class="crud-header">
                <h1 class="crud-title">Editar Carrera</h1>
            </div>

            <div class="form-container">
                <form method="post" action="<?= site_url('carreras/update/' . $carreras['ID_Carrera']) ?>" class="crud-form">
                    <div class="form-group">
                        <label for="Nombre_Carrera" class="form-label">Carrera:</label>
                        <input type="text" id="Nombre_Carrera" name="Nombre_Carrera" class="form-input" value="<?= esc($carreras['Nombre_Carrera']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="ID_Categoria" class="form-label">Categoría:</label>
                        <select id="ID_Categoria" name="ID_Categoria" class="form-input" required>
                            <option value="">-- Selecciona una categoría --</option>
                            <?php if (!empty($categorias)): ?>
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?= esc($cat['ID_Categoria']) ?>" <?= $cat['ID_Categoria'] == $carreras['ID_Categoria'] ? 'selected' : '' ?>><?= esc($cat['Categoria']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            ✅ Actualizar
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