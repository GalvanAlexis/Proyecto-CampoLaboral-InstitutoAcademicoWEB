<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nuevo Usuario</title>
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>
    <h1>Nuevo Usuario</h1>

    <form method="post" action="<?= site_url('usuarios/store') ?>">
        <label>Email:</label><br>
        <input type="text" name="Email" required><br><br>

        <label>Contraseña:</label><br>
        <input type="text" name="password" required><br><br>

        <label>ID Rol:</label><br>
        <input type="number" name="ID_Rol" required><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="<?= site_url('usuarios') ?>">⬅️ Volver al listado</a>
    <?= $this->endSection() ?>
</body>
</html>
