<?php
// test_connection.php
include 'config.php';

try {
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM Categorias");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Conexión exitosa. Total de categorías: " . $result['total'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
