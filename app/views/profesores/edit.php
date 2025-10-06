<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Profesor</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Editar Profesor</h1>
        </div>

        <div class="form-container">
            <form method="post" action="<?= site_url('profesor/update/' .$profesor['ID_Profesor']) ?>" class="crud-form">
                <div class="form-group">
                    <label for="Nombre_Completo" class="form-label">Profesor:</label>
                    <input type="text" id="Nombre_Completo" name="Nombre_Completo" class="form-input" value="<?= esc($profesor['Nombre_Completo']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="DNI" class="form-label">DNI:</label>
                    <input type="number" id="DNI" name="DNI" class="form-input" value="<?= esc($profesor['DNI']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" id="email" name="email" class="form-input" value="<?= esc($profesor['Email']) ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        ✅ Actualizar
                    </button>
                    <a href="<?= site_url('profesores') ?>" class="btn btn-secondary">
                        ⬅️ Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?= $this->endSection() ?>
</body>
</html>
