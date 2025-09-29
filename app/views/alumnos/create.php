<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nuevo Alumno</title>
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>
    <h1>Nuevo Alumno</h1>

    <form method="post" action="<?= site_url('alumnos/store') ?>">
        <label>Alumno:</label><br>
        <input type="text" name="Nombre_Completo" required><br><br>

        <label>DNI:</label><br>
        <input type="number" name="DNI" required><br><br>

        <label>Email:</label><br>
        <input type="text" name="email" required><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="<?= site_url('alumnos') ?>">⬅️ Volver al listado</a>
    <?= $this->endSection() ?>
</body>
</html>
