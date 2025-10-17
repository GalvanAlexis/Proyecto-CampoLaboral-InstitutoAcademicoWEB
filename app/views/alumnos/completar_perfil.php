<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Completar Perfil</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
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

    <form method="post" action="<?= site_url('alumnos/completarPerfil') ?>">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="Nombre_Completo">Nombre completo</label>
        <input type="text" name="Nombre_Completo" id="Nombre_Completo" class="form-control" value="<?= esc(old('Nombre_Completo', $Nombre_Completo ?? '')) ?>" required>
    </div>

    <div class="form-group">
        <label for="DNI">DNI</label>
        <input type="text" name="DNI" id="DNI" class="form-control" value="<?= esc(old('DNI', $DNI ?? '')) ?>" required>
    </div>

    <div class="form-group">
        <label for="Email">Email</label>
        <input type="email" name="Email" id="Email" class="form-control" value="<?= esc(old('Email', $Email ?? '')) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Guardar y continuar</button>

    </form>
</div>

<?= $this->endSection() ?>
