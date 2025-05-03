<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['is_admin'] != 1) {
    http_response_code(403);
    echo json_encode(["status" => "erro", "mensagem" => "Acesso negado"]);
    exit;
}

require_once("conexao.php");

$data = json_decode(file_get_contents("php://input"), true);
$id = (int)$data['id'];

$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode([
  "status" => $stmt->affected_rows > 0 ? "ok" : "falha"
]);
