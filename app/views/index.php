<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content text-center">
            <h1 class="hero-title">
                <i class="fas fa-graduation-cap me-3"></i>
                Sistema de Gestión Académica
            </h1>
            <p class="hero-subtitle">
                Administre de manera eficiente todos los aspectos de su institución educativa
            </p>
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="modules-grid">
        <!-- Alumnos Card -->
        <div class="module-card">
            <div class="module-icon alumnos-color">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="module-content">
                <h3 class="module-title">Alumnos</h3>
                <p class="module-description">
                    Gestione el registro completo de estudiantes, inscripciones y datos académicos
                </p>
                <a href="<?= site_url('alumnos') ?>" class="btn-module alumnos-color">
                    Acceder <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <!-- Profesores Card -->
        <div class="module-card">
            <div class="module-icon profesores-color">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="module-content">
                <h3 class="module-title">Profesores</h3>
                <p class="module-description">
                    Administre el personal docente, asignaciones y datos profesionales
                </p>
                <a href="<?= site_url('profesores') ?>" class="btn-module profesores-color">
                    Acceder <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <!-- Carreras Card -->
        <div class="module-card">
            <div class="module-icon carreras-color">
                <i class="fas fa-book"></i>
            </div>
            <div class="module-content">
                <h3 class="module-title">Carreras</h3>
                <p class="module-description">
                    Configure y administre los planes de estudio y programas académicos
                </p>
                <a href="<?= site_url('carreras') ?>" class="btn-module carreras-color">
                    Acceder <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <!-- Turnos Card -->
        <div class="module-card">
            <div class="module-icon turnos-color">
                <i class="fas fa-clock"></i>
            </div>
            <div class="module-content">
                <h3 class="module-title">Turnos</h3>
                <p class="module-description">
                    Organice los horarios y turnos de clases de la institución
                </p>
                <a href="<?= site_url('turnos') ?>" class="btn-module turnos-color">
                    Acceder <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <!-- Categorías Card -->
        <div class="module-card">
            <div class="module-icon categorias-color">
                <i class="fas fa-tags"></i>
            </div>
            <div class="module-content">
                <h3 class="module-title">Categorías</h3>
                <p class="module-description">
                    Defina categorías y clasificaciones para organizar la información
                </p>
                <a href="<?= site_url('categorias') ?>" class="btn-module categorias-color">
                    Acceder <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <!-- Usuarios Card -->
        <div class="module-card">
            <div class="module-icon usuarios-color">
                <i class="fas fa-users"></i>
            </div>
            <div class="module-content">
                <h3 class="module-title">Usuarios</h3>
                <p class="module-description">
                    Gestione usuarios del sistema, permisos y roles de acceso
                </p>
                <a href="<?= site_url('usuarios') ?>" class="btn-module usuarios-color">
                    Acceder <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Info Section -->
    <div class="info-section mt-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="info-card">
                    <i class="fas fa-shield-alt info-icon"></i>
                    <h4>Seguro y Confiable</h4>
                    <p>Sistema protegido con las mejores prácticas de seguridad</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card">
                    <i class="fas fa-tachometer-alt info-icon"></i>
                    <h4>Rápido y Eficiente</h4>
                    <p>Acceso veloz a toda la información que necesita</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card">
                    <i class="fas fa-mobile-alt info-icon"></i>
                    <h4>Diseño Responsivo</h4>
                    <p>Accesible desde cualquier dispositivo, en cualquier lugar</p>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>
</body>

</html>