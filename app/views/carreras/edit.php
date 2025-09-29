<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Carrera</title>
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>
    <h1>Editar Carrera</h1>

    <form method="post" action="<?= site_url('carreras/update/'.$carreras['ID_Carrera']) ?>">
        <label>Carrera:</label><br>
        <input type="text" name="Nombre_Carrera" value="<?= $carreras['Nombre_Carrera'] ?>" required><br><br>

        <label>ID Categoría:</label><br>
        <input type="number" name="ID_Categoria" value="<?= $carreras['ID_Categoria'] ?>" required><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="<?= site_url('carreras') ?>">⬅️ Volver al listado</a>

    <?= $this->endSection() ?>
</body>
</html>
