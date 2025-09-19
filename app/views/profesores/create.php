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
    $stmt = $conn->prepare("INSERT INTO profesores (id, nombre, dni, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $id, $nombre, $dni, $email);

    if ($stmt->execute()) {
        echo "Profesor agregado correctamente";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Faltan datos";
}

$conn->close();
?>
