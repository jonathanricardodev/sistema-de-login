<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Redefinir Senha</h2>
        <?php
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            echo '<form id="redefinirSenhaForm" action="php/processar_reset.php" method="post">';
            echo '<input type="hidden" name="token" value="' . $token . '">';
            echo '<input type="password" name="nova_senha" placeholder="Nova Senha" required>';
            echo '<input type="password" name="confirmar_senha" placeholder="Confirmar Nova Senha" required>';
            echo '<button type="submit">Redefinir Senha</button>';
            echo '</form>';
        } else {
            echo '<p>Link de redefinição inválido.</p>';
        }
        ?>
        <p><a href="index.php">Voltar para o login</a></p>
    </div>
    <script src="js/script.js"></script>
</body>
</html>