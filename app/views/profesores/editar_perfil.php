<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil de Profesor</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <div class="crud-container">
        <div class="crud-header">
            <h1 class="crud-title">Datos Personales</h1>
            <p class="text-muted">Puedes actualizar tu información personal aquí</p>
        </div>

        <div class="form-container">
            <form method="post" action="<?= site_url('profesores/editarPerfil') ?>" class="crud-form">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="nombre_completo" class="form-label">Nombre Completo:</label>
                    <input type="text" 
                           id="nombre_completo" 
                           name="Nombre_Completo" 
                           class="form-input" 
                           value="<?= esc($profesor['Nombre_Completo']) ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="dni" class="form-label">DNI:</label>
                    <input type="text" 
                           id="dni" 
                           name="DNI" 
                           class="form-input" 
                           value="<?= esc($profesor['DNI']) ?>"
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
                           value="<?= esc($profesor['Email']) ?>"
                           required>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Nota:</strong> Si cambias tu email, asegúrate de que sea uno válido ya que se usará para comunicaciones importantes.
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        ✅ Actualizar Datos
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?= $this->endSection() ?>
</body>

</html>
