<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestión</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
        nav { background-color: #667eea; padding: 10px 20px; }
        nav a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
            font-weight: bold;
        }
        nav a:hover { text-decoration: underline; }
        .container { padding: 40px; }
        h1 { color: #333; }
        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 200px;
            text-align: center;
        }
        .card a {
            display: inline-block;
            margin-top: 10px;
            background: #4ecdc4;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
        }
        .card a:hover { background: #3bb3a0; }
    </style>
</head>
<body>

    <nav>
        <a href="<?= site_url('alumnos') ?>">Alumnos</a>
        <a href="<?= site_url('profesores') ?>">Profesores</a>
        <a href="<?= site_url('carreras') ?>">Carreras</a>
        <a href="<?= site_url('turnos') ?>">Turnos</a>
        <a href="<?= site_url('categorias') ?>">Categorías</a>
        <a href="<?= site_url('usuarios') ?>">Usuarios</a>
    </nav>

    <div class="container">
        <h1>Bienvenido al Sistema de Gestión</h1>
        <p>Seleccione un módulo del menú o haga clic en los botones:</p>

        <div class="cards">
            <div class="card">
                <h3>Alumnos</h3>
                <a href="<?= site_url('alumnos') ?>">Ir al CRUD</a>
            </div>
            <div class="card">
                <h3>Profesores</h3>
                <a href="<?= site_url('profesores') ?>">Ir al CRUD</a>
            </div>
            <div class="card">
                <h3>Carreras</h3>
                <a href="<?= site_url('carreras') ?>">Ir al CRUD</a>
            </div>
            <div class="card">
                <h3>Turnos</h3>
                <a href="<?= site_url('turnos') ?>">Ir al CRUD</a>
            </div>
            <div class="card">
                <h3>Categorías</h3>
                <a href="<?= site_url('categorias') ?>">Ir al CRUD</a>
            </div>
            <div class="card">
                <h3>Usuarios</h3>
                <a href="<?= site_url('usuarios') ?>">Ir al CRUD</a>
            </div>
        </div>
    </div>

</body>
</html>
