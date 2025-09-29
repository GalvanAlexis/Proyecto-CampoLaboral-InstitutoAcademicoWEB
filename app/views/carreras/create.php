<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nueva Carrera</title>
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>
    <h1>Nueva Carrera</h1>

    <form method="post" action="<?= site_url('carreras/store') ?>">
        <label>Carrera:</label><br>
        <input type="text" name="Nombre_Carrera" required><br><br>

        <label>ID Categoría:</label><br>
        <input type="number" name="ID_Categoria" required><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="<?= site_url('carreras') ?>">⬅️ Volver al listado</a>
    <?= $this->endSection() ?>
</body>
</html>
