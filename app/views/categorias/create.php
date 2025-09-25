<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nuevo Categoría</title>
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>
    <h1>Nueva Categoría</h1>

    <form method="post" action="<?= site_url('categorias/store') ?>">
        <label>Categoría:</label><br>
        <input type="text" name="Categoria" required><br><br>
        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="<?= site_url('categorias') ?>">⬅️ Volver al listado</a>
    <?= $this->endSection() ?>
</body>
</html>
