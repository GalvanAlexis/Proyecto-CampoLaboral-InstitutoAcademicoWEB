<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscribirse en una Carrera</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="container">
        <h1 class="my-4">Inscribirse en una Carrera</h1>
        <p class="text-muted">Seleccione la carrera y el turno en el que desea inscribirse</p>

        <?php if (!empty(session()->getFlashdata('error'))): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (!empty(session()->getFlashdata('message'))): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
        <?php endif; ?>

        <form method="post" action="<?= site_url('alumnos/inscribirse') ?>">
            <?= csrf_field() ?>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="ID_Carrera" class="form-label">Carrera <span class="text-danger">*</span></label>
                    <select id="ID_Carrera" name="ID_Carrera" class="form-select" required>
                        <option value="">-- Seleccione una carrera --</option>
                        <?php foreach ($carreras as $c): ?>
                            <option value="<?= esc($c['ID_Carrera']) ?>"><?= esc($c['Nombre_Carrera']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="form-text text-muted">Seleccione primero la carrera para ver los turnos disponibles</small>
                </div>

                <div class="col-md-6">
                    <label for="ID_Turno" class="form-label">Turno <span class="text-danger">*</span></label>
                    <select id="ID_Turno" name="ID_Turno" class="form-select" required>
                        <option value="">-- Seleccione un turno --</option>
                        <?php foreach ($turnos as $t): ?>
                            <option data-carrera="<?= esc($t['ID_Carrera']) ?>" value="<?= esc($t['ID_Turno']) ?>">
                                <?= esc($t['Turno']) ?><?= !empty($t['Profesor_Nombre']) ? ' - Prof. ' . esc($t['Profesor_Nombre']) : '' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="form-text text-muted">Los turnos mostrados corresponden a la carrera seleccionada</small>
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check me-1"></i>Confirmar Inscripción
                </button>
                <a href="<?= site_url('/') ?>" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i>Cancelar
                </a>
            </div>
        </form>
    </div>

    <script>
        // Filtrar turnos por carrera seleccionada
        (function(){
            const carreraSelect = document.getElementById('ID_Carrera');
            const turnoSelect = document.getElementById('ID_Turno');

            function filterTurnos(){
                const carrera = carreraSelect.value;
                let hasVisibleOptions = false;
                
                for (const opt of turnoSelect.options){
                    if (!opt.value) {
                        opt.style.display = '';
                        continue;
                    }
                    
                    const shouldShow = (carrera === '' || opt.dataset.carrera === carrera);
                    opt.style.display = shouldShow ? '' : 'none';
                    if (shouldShow) hasVisibleOptions = true;
                }
                
                // Reset turno selection when carrera changes
                turnoSelect.value = '';
                
                // Deshabilitar select de turno si no hay carrera seleccionada
                turnoSelect.disabled = (carrera === '');
            }

            carreraSelect.addEventListener('change', filterTurnos);

            // Inicializar filtrado
            filterTurnos();
        })();
    </script>

    <?= $this->endSection() ?>
</body>
</html>