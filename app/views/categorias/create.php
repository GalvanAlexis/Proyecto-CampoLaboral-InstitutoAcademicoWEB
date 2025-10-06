<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nueva Categoría</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Nueva Categoría</h1>
        </div>

        <div class="form-container">
            <form method="post" action="<?= site_url('categorias/store') ?>" class="crud-form">
                <div class="form-group">
                    <label for="Categoria" class="form-label">Categoría:</label>
                    <input type="text" id="Categoria" name="Categoria" class="form-input" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Guardar
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
