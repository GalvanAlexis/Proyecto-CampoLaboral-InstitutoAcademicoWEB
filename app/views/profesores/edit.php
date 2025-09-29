<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Profesor</title>
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>
    <h1>Editar Profesor</h1>

    <form method="post" action="<?= site_url('profesores/update/'.$profesor['ID_Profesor']) ?>">
        <label>Profesor:</label><br>
        <input type="text" name="Nombre_Completo" value="<?= $profesor['Nombre_Completo'] ?>" required><br><br>

        <label>DNI:</label><br>
        <input type="number" name="DNI" value="<?= $profesor['DNI'] ?>" required><br><br>

        <label>Email:</label><br>
        <input type="text" name="email" value="<?= $profesor['Email'] ?>" required><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="<?= site_url('profesores') ?>">⬅️ Volver al listado</a>

    <?= $this->endSection() ?>
</body>
</html>
