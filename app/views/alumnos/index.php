<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alumnos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Listado de Alumnos</h1>
        <a href="/alumnos/new" class="btn btn-primary mb-3">Crear Nuevo Alumno</a>
        <?php if(session()->getFlashdata('success')):?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif;?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if($alumnos): ?>
                <?php foreach($alumnos as $alumno): ?>
                <tr>
                    <td><?= $alumno['ID_Alumno']; ?></td>
                    <td><?= $alumno['Nombre_Completo']; ?></td>
                    <td><?= $alumno['DNI']; ?></td>
                    <td><?= $alumno['Email']; ?></td>
                    <td>
                        <a href="/alumnos/edit/<?= $alumno['ID_Alumno']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="/alumnos/delete/<?= $alumno['ID_Alumno']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="5">No hay alumnos registrados.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>