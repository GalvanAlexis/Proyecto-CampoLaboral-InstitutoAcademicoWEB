<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Inscripciones</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h2><i class="fas fa-clipboard-list"></i> Mis Inscripciones</h2>
            <a href="<?= site_url('alumnos/inscribirse') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Inscripción
            </a>
        </div>

        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('message') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php endif; ?>

        <?php if (empty($inscripciones)): ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> No tienes inscripciones registradas aún.
                <a href="<?= site_url('alumnos/inscribirse') ?>">Realizar tu primera inscripción</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-graduation-cap"></i> Carrera</th>
                            <th><i class="fas fa-chalkboard-teacher"></i> Profesor</th>
                            <th><i class="fas fa-clock"></i> Turno</th>
                            <th><i class="fas fa-calendar"></i> Fecha de Inscripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inscripciones as $inscripcion): ?>
                            <tr>
                                <td>
                                    <strong><?= esc($inscripcion['Nombre_Carrera']) ?></strong>
                                </td>
                                <td>
                                    <?= esc($inscripcion['Profesor_Nombre']) ?>
                                    <?php if (!empty($inscripcion['Profesor_Email'])): ?>
                                        <br>
                                        <small>
                                            <a href="mailto:<?= esc($inscripcion['Profesor_Email']) ?>">
                                                <i class="fas fa-envelope"></i> <?= esc($inscripcion['Profesor_Email']) ?>
                                            </a>
                                        </small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge badge-<?= $inscripcion['Turno'] == 'Mañana' ? 'warning' : ($inscripcion['Turno'] == 'Tarde' ? 'info' : 'dark') ?>">
                                        <?= esc($inscripcion['Turno']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                    $fecha = new DateTime($inscripcion['Fecha_Inscripcion']);
                                    echo $fecha->format('d/m/Y H:i');
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="alert alert-secondary mt-3">
                <i class="fas fa-info-circle"></i> 
                <strong>Total de inscripciones:</strong> <?= count($inscripciones) ?>
            </div>
        <?php endif; ?>
    </div>
    <?= $this->endSection() ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
