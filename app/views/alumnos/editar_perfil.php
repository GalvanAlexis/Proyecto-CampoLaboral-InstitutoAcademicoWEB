<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Datos Personales</h2>
    <p class="text-muted">Actualice su información personal</p>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <?php if (isset($validation) && $validation->getErrors()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($validation->getErrors() as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('alumnos/editarPerfil') ?>">
    <?= csrf_field() ?>

    <div class="form-group mb-3">
        <label for="Nombre_Completo">Nombre completo</label>
        <input type="text" name="Nombre_Completo" id="Nombre_Completo" class="form-control" value="<?= esc(old('Nombre_Completo', $alumno['Nombre_Completo'] ?? '')) ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="DNI">DNI</label>
        <input type="text" name="DNI" id="DNI" class="form-control" value="<?= esc(old('DNI', $alumno['DNI'] ?? '')) ?>" required>
    </div>

    <div class="form-group mb-3">
        <label for="Email">Email</label>
        <input type="email" name="Email" id="Email" class="form-control" value="<?= esc(old('Email', $alumno['Email'] ?? '')) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary mt-3">
        <i class="fas fa-save me-1"></i>Guardar cambios
    </button>
    <a href="<?= site_url('alumnos/inscribirse') ?>" class="btn btn-secondary mt-3">
        <i class="fas fa-times me-1"></i>Cancelar
    </a>

    </form>
</div>

<?= $this->endSection() ?>
