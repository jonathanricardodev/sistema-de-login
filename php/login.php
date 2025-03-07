<?php
// php/login.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($senha, $row['senha'])) {
        session_start();
        $_SESSION['email'] = $email;
        if ($row['is_admin'] == 1) {
            header("Location: ../admin_page.html");
            exit;
        } else {
            header("Location: ../welcome.html");
            exit;
        }
    } else {
        header("Location: ../index.html?mensagem=senha_incorreta&email=" . urlencode($email));
        exit;
    }
} else {
    header("Location: ../index.html?mensagem=usuario_nao_encontrado&email=" . urlencode($email));
    exit;
}

$conn->close();
?>