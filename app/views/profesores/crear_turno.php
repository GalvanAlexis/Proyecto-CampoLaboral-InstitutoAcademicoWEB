<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Turno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h2><i class="fas fa-clock"></i> Crear Turno</h2>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form action="<?= site_url('profesores/crearTurno') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="ID_Carrera">
                        <i class="fas fa-graduation-cap"></i> Carrera *
                    </label>
                    <select name="ID_Carrera" id="ID_Carrera" class="form-input" required>
                        <option value="">Seleccionar carrera...</option>
                        <?php foreach ($carreras as $carrera): ?>
                            <option value="<?= $carrera['ID_Carrera'] ?>" <?= old('ID_Carrera') == $carrera['ID_Carrera'] ? 'selected' : '' ?>>
                                <?= esc($carrera['Nombre_Carrera']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Turno">
                        <i class="fas fa-clock"></i> Horario *
                    </label>
                    <select name="Turno" id="Turno" class="form-input" required>
                        <option value="">Seleccionar horario...</option>
                        <option value="Mañana" <?= old('Turno') == 'Mañana' ? 'selected' : '' ?>>Mañana</option>
                        <option value="Tarde" <?= old('Turno') == 'Tarde' ? 'selected' : '' ?>>Tarde</option>
                        <option value="Noche" <?= old('Turno') == 'Noche' ? 'selected' : '' ?>>Noche</option>
                    </select>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Crear Turno
                    </button>
                    <a href="<?= site_url('profesores/misTurnos') ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
    <?= $this->endSection() ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
