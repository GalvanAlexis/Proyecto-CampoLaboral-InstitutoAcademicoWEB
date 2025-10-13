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
    <?php $auth = auth(); ?>

    <!-- Navbar -->
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
<<<<<<< HEAD
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('alumnos') ?>">
                            <i class="fas fa-user-graduate me-1"></i>Alumnos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('profesores') ?>">
                            <i class="fas fa-chalkboard-teacher me-1"></i>Profesores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('carreras') ?>">
                            <i class="fas fa-book me-1"></i>Carreras
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('turnos') ?>">
                            <i class="fas fa-clock me-1"></i>Turnos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('categorias') ?>">
                            <i class="fas fa-tags me-1"></i>Categorías
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('usuarios') ?>">
                            <i class="fas fa-users me-1"></i>Usuarios
                        </a>
                    </li>
                    <?php if (auth()->loggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('logout') ?>">
                                <i class="fas fa-sign-out-alt me-1"></i>Cerrar sesión
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('login') ?>">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
=======
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('alumnos') ?>">Alumnos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('profesores') ?>">Profesores</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('carreras') ?>">Carreras</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('turnos') ?>">Turnos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('categorias') ?>">Categorías</a></li>

                    <?php if ($auth->isLoggedIn()): ?>
                        <?php if ($auth->user()->inGroup('admin')): ?>
                            <li class="nav-item"><a class="nav-link" href="<?= site_url('usuarios') ?>">Usuarios</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('logout') ?>">Salir</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('login') ?>">Login</a></li>
>>>>>>> fac8b67554a14ff1fb799d323181c0e914832622
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Contenido Principal -->
    <main class="main-content">
        <div class="container-fluid px-4 py-4">
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