<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Alumno</title>
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>
    <h1>Editar Alumno</h1>

    <form method="post" action="<?= site_url('alumnos/update/'.$alumno['ID_Alumno']) ?>">
        <label>Alumno:</label><br>
        <input type="text" name="Nombre_Completo" value="<?= $alumno['Nombre_Completo'] ?>" required><br><br>

        <label>DNI:</label><br>
        <input type="number" name="DNI" value="<?= $alumno['DNI'] ?>" required><br><br>

        <label>Email:</label><br>
        <input type="text" name="email" value="<?= $alumno['Email'] ?>" required><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="<?= site_url('alumnos') ?>">⬅️ Volver al listado</a>

    <?= $this->endSection() ?>
</body>
</html>
