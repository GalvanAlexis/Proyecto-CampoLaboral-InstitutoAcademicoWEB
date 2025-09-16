<?php
header('Content-Type: application/json');
include 'config.php';

$categoryName = $_POST['categoryName'] ?? '';

if (empty($categoryName)) {
    echo json_encode(['success' => false, 'message' => 'El nombre de la categoría es requerido']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO Categorias (Categoria) VALUES (?)");
    $stmt->execute([$categoryName]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo json_encode(['success' => false, 'message' => 'La categoría ya existe']);
    } else {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>