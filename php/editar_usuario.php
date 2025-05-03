<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['email']) || $_SESSION['is_admin'] != 1) {
    http_response_code(403);
    echo json_encode(["erro" => "Acesso negado"]);
    exit;
}

require_once("conexao.php");

$data = json_decode(file_get_contents("php://input"), true);

$id = (int) $data['id'];
$campo = $data['campo'];
$valor = $data['valor'];

$camposPermitidos = ['nome', 'email', 'senha'];
if (!in_array($campo, $camposPermitidos)) {
    http_response_code(400);
    echo json_encode(["erro" => "Campo inválido"]);
    exit;
}

if ($campo === 'senha') {
    $valor = password_hash($valor, PASSWORD_DEFAULT);
}

$stmt = $conn->prepare("UPDATE usuarios SET $campo = ? WHERE id = ?");
$stmt->bind_param("si", $valor, $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(["status" => "ok"]);
    exit;
} else {
    echo json_encode(["status" => "nenhuma alteração"]);
    exit;
}
