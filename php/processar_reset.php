<?php
// php/processar_reset.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if ($nova_senha !== $confirmar_senha) {
        echo "As senhas não coincidem.";
        exit;
    }

    // Verificar se o token é válido e não expirou
    $sql = "SELECT id FROM usuarios WHERE reset_token = ? AND reset_token_expiry > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $user_id = $user['id'];

        // Hash da nova senha
        $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

        // Atualizar a senha e invalidar o token
        $update_sql = "UPDATE usuarios SET senha = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssi", $senha_hash, $user_id);

        if ($update_stmt->execute()) {
            echo "Senha redefinida com sucesso! Você pode fazer login agora.";
            // Redirecionar para a página de login após alguns segundos
            header("Refresh: 3;url=../index.html");
            exit;
        } else {
            echo "Erro ao redefinir a senha.";
            // Log do erro para depuração
        }
        $update_stmt->close();
    } else {
        echo "Link de redefinição inválido ou expirado.";
    }
    $stmt->close();
}
$conn->close();
?>