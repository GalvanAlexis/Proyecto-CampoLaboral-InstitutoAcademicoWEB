<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>
    <h1>Editar Usuario</h1>

    <form method="post" action="<?= site_url('usuarios/update/'.$usuario['ID_Usuario']) ?>">
        <label>Email:</label><br>
        <input type="text" name="Email" value="<?= $usuario['Email'] ?>" required><br><br>

        <label>Contraseña:</label><br>
        <input type="text" name="password" value="<?= $usuario['Password'] ?>" required><br><br>

        <label>ID Rol:</label><br>
        <input type="number" name="ID_Rol" value="<?= $usuario['ID_Rol'] ?>" required><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="<?= site_url('usuarios') ?>">⬅️ Volver al listado</a>

    <?= $this->endSection() ?>
</body>
</html>
