<?php
session_start();

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
        $_SESSION['email'] = $email;
        $_SESSION['is_admin'] = $row['is_admin'];
        if ($row['is_admin'] == 1) {
            header("Location: ../welcome.php");
        } else {
            header("Location: ../welcome.php");
        }
        exit;
    } else {
        header("Location: ../index.php?mensagem=senha_incorreta&email=" . urlencode($email));
        exit;
    }
} else {
    header("Location: ../index.php?mensagem=usuario_nao_encontrado&email=" . urlencode($email));
    exit;
}

$conn->close();
?>
