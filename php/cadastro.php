<?php
// php/cadastro.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha
$is_admin = 0; //Define como false, ou seja, usuário normal.

$sql = "INSERT INTO usuarios (nome, email, senha, is_admin) VALUES ('$nome', '$email', '$senha', '$is_admin')";

if ($conn->query($sql) === TRUE) {
    header("Refresh: 3;url=../index.html"); // Redireciona para index.html após 2 segundos
    echo "Cadastro realizado com sucesso! Redirecionando para a página de login...";
    exit;
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>