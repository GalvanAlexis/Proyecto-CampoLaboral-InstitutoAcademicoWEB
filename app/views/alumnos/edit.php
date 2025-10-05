<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar Alumno</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Editar Alumno</h1>
        </div>

        <div class="form-container">
            <form method="post" action="<?= site_url('alumnos/update/' .$alumno['ID_Alumno']) ?>" class="crud-form">
                <div class="form-group">
                    <label for="Nombre_Completo" class="form-label">Alumno:</label>
                    <input type="text" id="Nombre_Completo" name="Nombre_Completo" class="form-input" value="<?= esc($alumno['Nombre_Completo']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="DNI" class="form-label">DNI:</label>
                    <input type="number" id="DNI" name="DNI" class="form-input" value="<?= esc($alumno['DNI']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" id="email" name="email" class="form-input" value="<?= esc($alumno['Email']) ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        ✅ Actualizar
                    </button>
                    <a href="<?= site_url('alumnos') ?>" class="btn btn-secondary">
                        ⬅️ Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?= $this->endSection() ?>
</body>

</html>