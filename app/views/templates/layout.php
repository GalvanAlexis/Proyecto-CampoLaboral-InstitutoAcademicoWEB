<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Sistema Académico') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url('/') ?>">Instituto</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('alumnos') ?>">Alumnos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('profesores') ?>">Profesores</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('carreras') ?>">Carreras</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('turnos') ?>">Turnos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('categorias') ?>">Categorías</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('usuarios') ?>">Usuarios</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido dinámico -->
    <div class="container">
        <?= $this->renderSection('content') ?>
    </div>

    <footer class="bg-light text-center py-3 mt-5">
        <p class="mb-0">&copy; <?= date('Y') ?> Instituto Académico</p>
    </footer>
</body>
</html>
