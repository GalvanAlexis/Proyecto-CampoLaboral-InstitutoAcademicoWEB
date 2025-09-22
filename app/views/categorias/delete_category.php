<?php
header('Content-Type: application/json');
include 'config.php';

$id = $_POST['id'] ?? '';

if (empty($id)) {
    echo json_encode(['success' => false, 'message' => 'ID de categoría no proporcionado']);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM Categorias WHERE ID_Categoria = ?");
    $stmt->execute([$id]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>