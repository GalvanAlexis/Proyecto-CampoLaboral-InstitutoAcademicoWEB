<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nuevo Turno</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Nuevo Turno</h1>
        </div>

        <div class="form-container">
            <form method="post" action="<?= site_url('turnos/store') ?>" class="crud-form">
                <div class="form-group">
                    <label for="turno" class="form-label">Turno:</label>
                    <input type="text" id="turno" name="Turno" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="id_profesor" class="form-label">Profesor:</label>
                    <select id="id_profesor" name="ID_Profesor" class="form-input" required>
                        <option value="">-- Selecciona un profesor --</option>
                        <?php if (!empty($profesores)): ?>
                            <?php foreach ($profesores as $p): ?>
                                <option value="<?= esc($p['ID_Profesor']) ?>"><?= esc($p['Nombre_Completo']) ?></option>
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
                                <option value="<?= esc($c['ID_Carrera']) ?>"><?= esc($c['Nombre_Carrera']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Guardar
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