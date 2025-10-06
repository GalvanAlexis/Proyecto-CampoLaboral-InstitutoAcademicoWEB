<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Editar Categoría</h1>
        </div>

        <div class="form-container">
            <form method="post" action="<?= site_url('categorias/update/' . $categorias['ID_Categoria']) ?>" class="crud-form">
                <div class="form-group">
                    <label for="Categoria" class="form-label">Categoría:</label>
                    <input type="text" id="Categoria" name="Categoria" class="form-input" value="<?= esc($categorias['Categoria']) ?>" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        ✅ Actualizar
                    </button>
                    <a href="<?= site_url('categorias') ?>" class="btn btn-secondary">
                        ⬅️ Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?= $this->endSection() ?>
</body>

</html>