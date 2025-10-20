<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Registrar Usuario</h1>
        </div>

        <div class="form-container">
            <form method="post" action="<?= site_url('usuarios/store') ?>" class="crud-form">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="username" class="form-label">Nombre de usuario:</label>
                    <input type="text" id="username" name="username" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="group" class="form-label">Rol:</label>
                    <select id="group" name="group" class="form-input" required>
                        <option value="">-- Selecciona un rol --</option>
                        <?php foreach ($groups as $key => $group): ?>
                            <option value="<?= esc($key) ?>"><?= esc($group['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Registrar
                    </button>
                    <a href="<?= site_url('usuarios') ?>" class="btn btn-secondary">
                        ⬅️ Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <?= $this->endSection() ?>
</body>

</html>
