<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Turnos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h2><i class="fas fa-clock"></i> Mis Turnos</h2>
            <a href="<?= site_url('profesores/crearTurno') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Nuevo Turno
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

        <?php if (empty($turnos)): ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> No tienes turnos asignados aún.
                <a href="<?= site_url('profesores/crearTurno') ?>">Crear tu primer turno</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag"></i> ID</th>
                            <th><i class="fas fa-graduation-cap"></i> Carrera</th>
                            <th><i class="fas fa-clock"></i> Horario</th>
                            <th><i class="fas fa-users"></i> Inscriptos</th>
                            <th><i class="fas fa-cogs"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($turnos as $turno): ?>
                            <tr>
                                <td><?= esc($turno['ID_Turno']) ?></td>
                                <td><?= esc($turno['Nombre_Carrera']) ?></td>
                                <td>
                                    <span class="badge badge-<?= $turno['Turno'] == 'Mañana' ? 'warning' : ($turno['Turno'] == 'Tarde' ? 'info' : 'dark') ?>">
                                        <?= esc($turno['Turno']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-primary">
                                        <?= $turno['cantidad_inscriptos'] ?> alumno<?= $turno['cantidad_inscriptos'] != 1 ? 's' : '' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= site_url('profesores/verInscriptos/' . $turno['ID_Turno']) ?>" 
                                       class="btn btn-sm btn-info" 
                                       title="Ver inscriptos">
                                        <i class="fas fa-eye"></i> Ver Inscriptos
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <?= $this->endSection() ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
