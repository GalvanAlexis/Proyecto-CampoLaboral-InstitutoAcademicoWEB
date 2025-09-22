<?php
$host = 'localhost';
$dbname = 'instituto';    // Nombre de tu base de datos
$username = 'root';       // Usuario por defecto de XAMPP
$password = '';           // Contraseña por defecto de XAMPP (vacía)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>