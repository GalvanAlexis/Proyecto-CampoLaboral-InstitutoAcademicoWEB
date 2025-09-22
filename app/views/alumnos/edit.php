<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Alumno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Alumno</h1>
        <a href="/alumnos" class="btn btn-secondary mb-3">Volver</a>
        <?php if(session()->getFlashdata('errors')):?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif;?>
        <form action="/alumnos/update/<?= $alumno['ID_Alumno'] ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="Nombre_Completo">Nombre Completo</label>
                <input type="text" class="form-control" name="Nombre_Completo" value="<?= old('Nombre_Completo', $alumno['Nombre_Completo']) ?>">
            </div>
            <div class="form-group">
                <label for="DNI">DNI</label>
                <input type="text" class="form-control" name="DNI" value="<?= old('DNI', $alumno['DNI']) ?>">
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" class="form-control" name="Email" value="<?= old('Email', $alumno['Email']) ?>">
            </div>
            <button type="submit" class="btn btn-warning">Actualizar</button>
        </form>
    </div>
</body>
</html>