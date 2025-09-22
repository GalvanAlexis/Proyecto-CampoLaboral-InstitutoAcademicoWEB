<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$dbname = "instituto";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$id     = $_POST['profId'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$dni    = $_POST['dni'] ?? '';
$email  = $_POST['email'] ?? '';

if ($id && $nombre && $dni && $email) {
    $stmt = $conn->prepare("UPDATE profesores SET nombre=?, dni=?, email=? WHERE id=?");
    $stmt->bind_param("sssi", $nombre, $dni, $email, $id);

    if ($stmt->execute()) {
        echo "Profesor actualizado correctamente";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Faltan datos";
}

$conn->close();
?>
