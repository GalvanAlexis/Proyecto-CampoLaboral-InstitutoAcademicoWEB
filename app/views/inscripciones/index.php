<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="fas fa-clipboard-list me-2"></i>Gestión de Inscripciones</h2>
        <p class="text-muted">Vista de todas las inscripciones realizadas por los alumnos</p>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Alumno</th>
                            <th>Carrera</th>
                            <th>Turno</th>
                            <th>Profesor</th>
                            <th>Fecha Inscripción</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($inscripciones)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                    No hay inscripciones registradas
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($inscripciones as $insc): ?>
                                <tr>
                                    <td><?= esc($insc['Alumno_Nombre'] ?? 'N/A') ?></td>
                                    <td><?= esc($insc['Nombre_Carrera'] ?? 'N/A') ?></td>
                                    <td><span class="badge bg-info"><?= esc($insc['Turno'] ?? 'N/A') ?></span></td>
                                    <td><?= esc($insc['Profesor_Nombre'] ?? 'N/A') ?></td>
                                    <td><?= esc($insc['Fecha_Inscripcion'] ?? 'N/A') ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('inscripciones/edit/' . $insc['ID_Alumno'] . '/' . $insc['ID_Carrera'] . '/' . $insc['ID_Turno']) ?>" 
                                           class="btn btn-sm btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= site_url('inscripciones/delete/' . $insc['ID_Alumno'] . '/' . $insc['ID_Carrera'] . '/' . $insc['ID_Turno']) ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('¿Está seguro de eliminar esta inscripción?')" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
