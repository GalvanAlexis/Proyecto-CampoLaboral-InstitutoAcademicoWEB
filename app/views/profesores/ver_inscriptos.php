<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos Inscriptos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h2><i class="fas fa-users"></i> Alumnos Inscriptos</h2>
            <a href="<?= site_url('profesores/misTurnos') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver a Mis Turnos
            </a>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-graduation-cap"></i> <?= esc($turno['Nombre_Carrera']) ?>
                </h5>
                <p class="card-text">
                    <strong>Horario:</strong> 
                    <span class="badge badge-<?= $turno['Turno'] == 'Mañana' ? 'warning' : ($turno['Turno'] == 'Tarde' ? 'info' : 'dark') ?>">
                        <?= esc($turno['Turno']) ?>
                    </span>
                </p>
            </div>
        </div>

        <?php if (empty($inscriptos)): ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> No hay alumnos inscriptos en este turno aún.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-user"></i> Nombre Completo</th>
                            <th><i class="fas fa-id-card"></i> DNI</th>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <th><i class="fas fa-calendar"></i> Fecha Inscripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inscriptos as $inscripto): ?>
                            <tr>
                                <td><?= esc($inscripto['Nombre_Completo']) ?></td>
                                <td><?= esc($inscripto['DNI']) ?></td>
                                <td>
                                    <a href="mailto:<?= esc($inscripto['Email']) ?>">
                                        <?= esc($inscripto['Email']) ?>
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    $fecha = new DateTime($inscripto['Fecha_Inscripcion']);
                                    echo $fecha->format('d/m/Y H:i');
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="alert alert-secondary">
                <i class="fas fa-info-circle"></i> 
                <strong>Total de inscriptos:</strong> <?= count($inscriptos) ?> alumno<?= count($inscriptos) != 1 ? 's' : '' ?>
            </div>
        <?php endif; ?>
    </div>
    <?= $this->endSection() ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
