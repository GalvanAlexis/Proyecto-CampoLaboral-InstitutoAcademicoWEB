<?php
header('Content-Type: application/json');
include 'config.php';

$id = $_POST['id'] ?? '';
$categoryName = $_POST['categoryName'] ?? '';

if (empty($id) || empty($categoryName)) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE Categorias SET Categoria = ? WHERE ID_Categoria = ?");
    $stmt->execute([$categoryName, $id]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo json_encode(['success' => false, 'message' => 'La categoría ya existe']);
    } else {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>