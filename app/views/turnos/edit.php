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
                    <select id="turno" name="Turno" class="form-input" required>
                        <option value="">-- Selecciona un turno --</option>
                        <option value="Mañana" <?= $turno['Turno'] == 'Mañana' ? 'selected' : '' ?>>Mañana</option>
                        <option value="Tarde" <?= $turno['Turno'] == 'Tarde' ? 'selected' : '' ?>>Tarde</option>
                        <option value="Noche" <?= $turno['Turno'] == 'Noche' ? 'selected' : '' ?>>Noche</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_profesor" class="form-label">Profesor:</label>
                    <select id="id_profesor" name="ID_Profesor" class="form-input" required>
                        <option value="">-- Selecciona un profesor --</option>
                        <?php if (!empty($profesores)): ?>
                            <?php foreach ($profesores as $p): ?>
                                <option value="<?= esc($p['ID_Profesor']) ?>" <?= $p['ID_Profesor'] == $turno['ID_Profesor'] ? 'selected' : '' ?>><?= esc($p['Nombre_Completo']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_carrera" class="form-label">Carrera:</label>
                    <select id="id_carrera" name="ID_Carrera" class="form-input" required>
                        <option value="">-- Selecciona una carrera --</option>
                        <?php if (!empty($carreras)): ?>
                            <?php foreach ($carreras as $c): ?>
                                <option value="<?= esc($c['ID_Carrera']) ?>" <?= $c['ID_Carrera'] == $turno['ID_Carrera'] ? 'selected' : '' ?>><?= esc($c['Nombre_Carrera']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
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