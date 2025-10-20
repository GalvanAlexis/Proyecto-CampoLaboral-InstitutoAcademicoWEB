<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completar Perfil de Profesor</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Completar Perfil de Profesor</h1>
            <p class="text-muted">Por favor, completa tus datos personales para continuar</p>
        </div>

        <div class="form-container">
            <form method="post" action="<?= site_url('profesores/completarPerfil') ?>" class="crud-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="nombre_completo" class="form-label">Nombre Completo:</label>
                    <input type="text" 
                           id="nombre_completo" 
                           name="Nombre_Completo" 
                           class="form-input" 
                           placeholder="Ej: Juan Pérez García"
                           required>
                </div>

                <div class="form-group">
                    <label for="dni" class="form-label">DNI:</label>
                    <input type="text" 
                           id="dni" 
                           name="DNI" 
                           class="form-input" 
                           placeholder="Ej: 12345678"
                           pattern="[0-9]{7,8}"
                           title="Debe contener 7 u 8 dígitos"
                           required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" 
                           id="email" 
                           name="Email" 
                           class="form-input" 
                           placeholder="Ej: profesor@instituto.com"
                           required>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <strong>Importante:</strong> Estos datos se usarán en tu perfil de profesor y para asignarte a turnos de carreras.
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Guardar Perfil
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?= $this->endSection() ?>
</body>

</html>
