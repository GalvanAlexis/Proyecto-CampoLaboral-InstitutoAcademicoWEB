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
                        <label for="ID_Categoria" class="form-label">ID Categoría:</label>
                        <input type="number" id="ID_Categoria" name="ID_Categoria" class="form-input" value="<?= esc($carreras['ID_Categoria']) ?>" required>
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