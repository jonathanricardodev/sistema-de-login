<?php
session_start();
require_once("php/conexao.php");

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

$email = $_SESSION['email'];
$result = $conn->query("SELECT is_admin FROM usuarios WHERE email = '$email'");
$user = $result->fetch_assoc();
$isAdmin = (int)$user['is_admin'] === 1;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bem-vindo</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <h2>Bem-vindo!</h2>

    <?php if ($isAdmin): ?>
      <p>Você está logado como um <strong>usuário administrador</strong>.</p>
      <p>Aqui você pode gerenciar suas informações e realizar outras ações permitidas.</p>
      <p><a href="admin.php"><button class="admin-btn">Ir para página de administração</button></a></p>
    <?php else: ?>
      <p>Você está logado como um <strong>usuário normal</strong>.</p>
      <p>Aqui você pode gerenciar suas informações e realizar outras ações permitidas.</p>
    <?php endif; ?>

    <p><a href="php/logout.php">Sair</a></p>
  </div>
</body>
</html>
