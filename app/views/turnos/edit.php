<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar Turno</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Editar Turno</h1>
        </div>

        <div class="form-container">
            <form method="post" action="<?= site_url('turnos/update/' . $turno['ID_Turno']) ?>" class="crud-form">
                <div class="form-group">
                    <label for="turno" class="form-label">Turno:</label>
                    <input type="text" id="turno" name="Turno" class="form-input" value="<?= esc($turno['Turno']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="id_profesor" class="form-label">ID Profesor:</label>
                    <input type="number" id="id_profesor" name="ID_Profesor" class="form-input" value="<?= esc($turno['ID_Profesor']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="id_carrera" class="form-label">ID Carrera:</label>
                    <input type="number" id="id_carrera" name="ID_Carrera" class="form-input" value="<?= esc($turno['ID_Carrera']) ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        ✅ Actualizar
                    </button>
                    <a href="<?= site_url('turnos') ?>" class="btn btn-secondary">
                        ⬅️ Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?= $this->endSection() ?>
</body>

</html>