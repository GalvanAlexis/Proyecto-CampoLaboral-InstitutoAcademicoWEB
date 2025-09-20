<?php
// Conexión
$host = "localhost";
$user = "root";
$password = "";
$dbname = "instituto";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM profesores");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Profesores</title>
</head>
<body>
  <h1>Profesores</h1>
  <a href="crear_profesor_form.php">➕ Agregar profesor</a>
  <table border="1" cellpadding="5">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>DNI</th>
        <th>Email</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nombre']; ?></td>
        <td><?php echo $row['dni']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td>
          <!-- editar.php recibirá el ID por GET -->
          <a href="editar_profesor_form.php?id=<?php echo $row['id']; ?>">Editar</a> | 
          <form action="delete_profesor.php" method="post" style="display:inline;">
            <input type="hidden" name="profId" value="<?php echo $row['id']; ?>">
            <button type="submit">Eliminar</button>
          </form>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
<?php $conn->close(); ?>
