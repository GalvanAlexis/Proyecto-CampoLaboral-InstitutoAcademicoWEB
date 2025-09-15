<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nuevo Turno</title>
</head>
<body>
    <h1>Nuevo Turno</h1>

    <form method="post" action="<?= site_url('turnos/store') ?>">
        <label>Turno:</label><br>
        <input type="text" name="Turno" required><br><br>

        <label>ID Profesor:</label><br>
        <input type="number" name="ID_Profesor" required><br><br>

        <label>ID Carrera:</label><br>
        <input type="number" name="ID_Carrera" required><br><br>

        <button type="submit">Guardar</button>
    </form>

    <br>
    <a href="<?= site_url('turnos') ?>">⬅️ Volver al listado</a>
</body>
</html>
