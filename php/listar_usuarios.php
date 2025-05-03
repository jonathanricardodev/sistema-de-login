<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['is_admin'] != 1) {
    http_response_code(403);
    echo json_encode(["erro" => "Acesso negado"]);
    exit;
}

require_once("conexao.php");

$result = $conn->query("SELECT id, nome, email FROM usuarios");
$usuarios = [];

while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}

header("Content-Type: application/json");
echo json_encode($usuarios);
