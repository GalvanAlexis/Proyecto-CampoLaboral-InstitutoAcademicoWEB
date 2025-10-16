<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Editar Inscripción</h4>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form method="post" action="<?= site_url('inscripciones/update/' . $inscripcion['ID_Alumno'] . '/' . $inscripcion['ID_Carrera'] . '/' . $inscripcion['ID_Turno']) ?>">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">Alumno</label>
                            <input type="text" class="form-control" readonly value="<?php 
                                $alumno = array_filter($alumnos, fn($a) => $a['ID_Alumno'] == $inscripcion['ID_Alumno']);
                                echo esc(reset($alumno)['Nombre_Completo'] ?? 'N/A');
                            ?>">
                            <small class="form-text text-muted">El alumno no puede ser modificado</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Carrera</label>
                            <input type="text" class="form-control" readonly value="<?php 
                                $carrera = array_filter($carreras, fn($c) => $c['ID_Carrera'] == $inscripcion['ID_Carrera']);
                                echo esc(reset($carrera)['Nombre_Carrera'] ?? 'N/A');
                            ?>">
                            <small class="form-text text-muted">La carrera no puede ser modificada</small>
                        </div>

                        <div class="mb-3">
                            <label for="ID_Turno" class="form-label">Turno <span class="text-danger">*</span></label>
                            <select name="ID_Turno" id="ID_Turno" class="form-select" required>
                                <?php foreach ($turnos as $turno): ?>
                                    <?php if ($turno['ID_Carrera'] == $inscripcion['ID_Carrera']): ?>
                                        <option value="<?= esc($turno['ID_Turno']) ?>" <?= $turno['ID_Turno'] == $inscripcion['ID_Turno'] ? 'selected' : '' ?>>
                                            <?= esc($turno['Turno']) ?><?= !empty($turno['Profesor_Nombre']) ? ' - Prof. ' . esc($turno['Profesor_Nombre']) : '' ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text text-muted">Solo se muestran turnos de la carrera actual</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('inscripciones') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Volver
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-1"></i>Actualizar Inscripción
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
