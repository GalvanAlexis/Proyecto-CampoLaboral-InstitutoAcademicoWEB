<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>

    <h2>Registrar Usuario</h2>
    <form method="post" action="/usuarios/store">
        <label>Nombre de usuario:</label>
        <input type="text" name="username" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Contraseña:</label>
        <input type="password" name="password" required><br>

        <label>Rol:</label>
        <select name="group" required>
            <?php foreach ($groups as $key => $group): ?>
                <option value="<?= esc($key) ?>"><?= esc($group['title']) ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Registrar</button>
    </form>

    <?= $this->endSection() ?>
</body>
</html>
