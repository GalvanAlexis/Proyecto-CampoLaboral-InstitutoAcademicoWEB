<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Editar Usuario</h1>
        </div>

        <div class="form-container">
            <form method="post" action="<?= site_url('usuarios/update/' .$usuario->id) ?>" class="crud-form">
                <div class="form-group">
                    <label for="Email" class="form-label">Email:</label>
                    <input type="text" id="Email" name="Email" class="form-input" value="<?= esc($usuario->email) ?>" required>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="text" id="password" name="password" class="form-input" value="<?= esc($usuario->password) ?>" required>
                </div>

                <div class="form-group">
                    <label for="ID_Rol" class="form-label">ID Rol:</label>
                    <input type="number" id="ID_Rol" name="ID_Rol" class="form-input" value="<?= esc($usuario->role) ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        ✅ Actualizar
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