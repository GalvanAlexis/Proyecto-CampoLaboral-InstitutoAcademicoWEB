<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Nueva Inscripción</h4>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('inscripciones/store') ?>">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="ID_Alumno" class="form-label">Alumno <span class="text-danger">*</span></label>
                            <select name="ID_Alumno" id="ID_Alumno" class="form-select" required>
                                <option value="">-- Seleccione un alumno --</option>
                                <?php foreach ($alumnos as $alumno): ?>
                                    <option value="<?= esc($alumno['ID_Alumno']) ?>" <?= old('ID_Alumno') == $alumno['ID_Alumno'] ? 'selected' : '' ?>>
                                        <?= esc($alumno['Nombre_Completo']) ?> (DNI: <?= esc($alumno['DNI']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="ID_Carrera" class="form-label">Carrera <span class="text-danger">*</span></label>
                            <select name="ID_Carrera" id="ID_Carrera" class="form-select" required>
                                <option value="">-- Seleccione una carrera --</option>
                                <?php foreach ($carreras as $carrera): ?>
                                    <option value="<?= esc($carrera['ID_Carrera']) ?>" <?= old('ID_Carrera') == $carrera['ID_Carrera'] ? 'selected' : '' ?>>
                                        <?= esc($carrera['Nombre_Carrera']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text text-muted">Seleccione primero la carrera para filtrar los turnos</small>
                        </div>

                        <div class="mb-3">
                            <label for="ID_Turno" class="form-label">Turno <span class="text-danger">*</span></label>
                            <select name="ID_Turno" id="ID_Turno" class="form-select" required>
                                <option value="">-- Seleccione un turno --</option>
                                <?php foreach ($turnos as $turno): ?>
                                    <option data-carrera="<?= esc($turno['ID_Carrera']) ?>" value="<?= esc($turno['ID_Turno']) ?>" <?= old('ID_Turno') == $turno['ID_Turno'] ? 'selected' : '' ?>>
                                        <?= esc($turno['Turno']) ?><?= !empty($turno['Profesor_Nombre']) ? ' - Prof. ' . esc($turno['Profesor_Nombre']) : '' ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text text-muted">Los turnos mostrados corresponden a la carrera seleccionada</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('inscripciones') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Volver
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Guardar Inscripción
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Filtrar turnos por carrera seleccionada
    (function(){
        const carreraSelect = document.getElementById('ID_Carrera');
        const turnoSelect = document.getElementById('ID_Turno');

        function filterTurnos(){
            const carrera = carreraSelect.value;
            
            for (const opt of turnoSelect.options){
                if (!opt.value) {
                    opt.style.display = '';
                    continue;
                }
                
                const shouldShow = (carrera === '' || opt.dataset.carrera === carrera);
                opt.style.display = shouldShow ? '' : 'none';
            }
            
            // Reset turno selection when carrera changes
            turnoSelect.value = '';
            turnoSelect.disabled = (carrera === '');
        }

        carreraSelect.addEventListener('change', filterTurnos);
        filterTurnos(); // Inicializar
    })();
</script>

<?= $this->endSection() ?>
