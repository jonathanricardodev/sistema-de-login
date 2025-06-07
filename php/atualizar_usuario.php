<?php
session_start();
require_once("conexao.php");

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit;
}

$emailAtual = $_SESSION['email'];
$novoEmail = trim($_POST['novo_email']);
$novaSenha = trim($_POST['nova_senha']);

$atualizar = false;
$campos = [];
$valores = [];

// verifica quais campos foram preenchidos
if (!empty($novoEmail)) {
    $campos[] = "email = ?";
    $valores[] = $novoEmail;
    $_SESSION['email'] = $novoEmail;
    $atualizar = true;
}

if (!empty($novaSenha)) {
    $campos[] = "senha = ?";
    $valores[] = password_hash($novaSenha, PASSWORD_DEFAULT);
    $atualizar = true;
}

if ($atualizar) {
    $sql = "UPDATE usuarios SET " . implode(', ', $campos) . " WHERE email = ?";
    $valores[] = $emailAtual;

    $stmt = $conn->prepare($sql);
    $tipos = str_repeat("s", count($valores));
    $stmt->bind_param($tipos, ...$valores);

    if ($stmt->execute()) {
        header("Location: ../perfil.php?sucesso=1");
    } else {
        header("Location: ../perfil.php?erro=1");
    }

    $stmt->close();
} else {
    // Nenhum campo foi preenchido
    header("Location: ../perfil.php?nenhuma_alteracao=1");
}

$conn->close();
