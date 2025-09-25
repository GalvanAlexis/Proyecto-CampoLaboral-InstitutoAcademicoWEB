<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>
    <h1>Editar Categoría</h1>

    <form method="post" action="<?= site_url('categorias/update/'.$categorias['ID_Categoria']) ?>">
        <label>Categoría:</label><br>
        <input type="text" name="Categoria" value="<?= $categorias['Categoria'] ?>" required><br><br>
        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="<?= site_url('categorias') ?>">⬅️ Volver al listado</a>

    <?= $this->endSection() ?>
</body>
</html>
