<?php
session_start();
require_once("php/conexao.php");

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

$email = $conn->real_escape_string($_SESSION['email']);
$result = $conn->query("SELECT is_admin FROM usuarios WHERE email = '$email'");
$user = $result->fetch_assoc();

if ((int)$user['is_admin'] != 1) {
    header("Location: welcome.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Gerenciar Usuários</title>
  <link rel="stylesheet" href="css/admin.css">
  <script src="js/admin.js" defer></script>
</head>
<body>
  <div class="container">
  <p><a href="index.php"><button class="admin-btn">Voltar para Home</button></a></p>
    <h2>Gerenciar Usuários</h2>
    <table id="tabelaUsuarios">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Resetar Senha</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</body>
</html>
