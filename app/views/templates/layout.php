<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Sistema de Gestión Académica') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body>
    <!-- Navbar Superior -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center" href="<?= site_url('/') ?>">
                <i class="fas fa-graduation-cap me-2"></i>
                <span class="fw-bold">Instituto Académico</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php
                        $user = auth()->user();
                        $isAdmin = auth()->loggedIn() && $user && method_exists($user, 'inGroup') && $user->inGroup('admin');
                    ?>

                    <?php if ($isAdmin): ?>
                        <!-- Admin: menú con dropdowns organizados -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarGestion" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-users-cog me-1"></i>Gestión Personas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarGestion">
                                <li><a class="dropdown-item" href="<?= site_url('alumnos') ?>"><i class="fas fa-user-graduate me-2"></i>Alumnos</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('profesores') ?>"><i class="fas fa-chalkboard-teacher me-2"></i>Profesores</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= site_url('usuarios') ?>"><i class="fas fa-users me-2"></i>Usuarios</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarAcademico" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-graduation-cap me-1"></i>Académico
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarAcademico">
                                <li><a class="dropdown-item" href="<?= site_url('carreras') ?>"><i class="fas fa-book me-2"></i>Carreras</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('categorias') ?>"><i class="fas fa-tags me-2"></i>Categorías</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('turnos') ?>"><i class="fas fa-clock me-2"></i>Turnos</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= site_url('inscripciones') ?>"><i class="fas fa-clipboard-list me-2"></i>Inscripciones</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('logout') ?>"><i class="fas fa-sign-out-alt me-1"></i>Cerrar sesión</a></li>

                    <?php elseif (auth()->loggedIn()): ?>
                        <!-- Usuario autenticado no-admin: si es alumno mostrar enlaces apropiados -->
                        <?php if ($user && method_exists($user, 'inGroup') && $user->inGroup('alumno')): ?>
                            <li class="nav-item"><a class="nav-link" href="<?= site_url('carreras') ?>"><i class="fas fa-book me-1"></i>Carreras</a></li>
                            <?php if (! session()->get('ID_Alumno')): ?>
                                <li class="nav-item"><a class="nav-link" href="<?= site_url('alumnos/completarPerfil') ?>"><i class="fas fa-user-edit me-1"></i>Completar perfil</a></li>
                            <?php else: ?>
                                <li class="nav-item"><a class="nav-link" href="<?= site_url('alumnos/editarPerfil') ?>"><i class="fas fa-id-card me-1"></i>Datos personales</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= site_url('alumnos/inscribirse') ?>"><i class="fas fa-clipboard-list me-1"></i>Inscribirse</a></li>
                            <?php endif; ?>
                            <li class="nav-item"><a class="nav-link" href="<?= site_url('logout') ?>"><i class="fas fa-sign-out-alt me-1"></i>Cerrar sesión</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="<?= site_url('carreras') ?>"><i class="fas fa-book me-1"></i>Carreras</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= site_url('turnos') ?>"><i class="fas fa-clock me-1"></i>Turnos</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= site_url('logout') ?>"><i class="fas fa-sign-out-alt me-1"></i>Cerrar sesión</a></li>
                        <?php endif; ?>

                    <?php else: ?>
                        <!-- Visitante: enlaces a secciones de la landing -->
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('/') ?>#about"><i class="fas fa-info-circle me-1"></i>Sobre</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('/') ?>#carreras"><i class="fas fa-book me-1"></i>Carreras</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('/') ?>#cta"><i class="fas fa-edit me-1"></i>Inscribirse</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('login') ?>"><i class="fas fa-sign-in-alt me-1"></i>Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="main-content">
        <div class="container-fluid px-4 py-4">
            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container-fluid px-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">
                        <i class="fas fa-copyright me-1"></i>
                        <?= date('Y') ?> Instituto Académico - Sistema de Gestión
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">
                        <i class="fas fa-code me-1"></i>
                        Desarrollado con <i class="fas fa-heart text-danger"></i>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>