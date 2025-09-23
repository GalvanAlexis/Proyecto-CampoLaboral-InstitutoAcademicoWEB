<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Turno</title>
</head>
<body>
    <?= $this->extend('templates/layout') ?>
    <?= $this->section('content') ?>
    <h1>Editar Turno</h1>

    <form method="post" action="<?= site_url('turnos/update/'.$turno['ID_Turno']) ?>">
        <label>Turno:</label><br>
        <input type="text" name="Turno" value="<?= $turno['Turno'] ?>" required><br><br>

        <label>ID Profesor:</label><br>
        <input type="number" name="ID_Profesor" value="<?= $turno['ID_Profesor'] ?>" required><br><br>

        <label>ID Carrera:</label><br>
        <input type="number" name="ID_Carrera" value="<?= $turno['ID_Carrera'] ?>" required><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <br>
    <a href="<?= site_url('turnos') ?>">⬅️ Volver al listado</a>

    <?= $this->endSection() ?>
</body>
</html>
