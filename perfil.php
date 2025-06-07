<?php
session_start();
require_once("php/conexao.php");

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Atualizar Dados</h2>
<form id="perfilForm" action="php/atualizar_usuario.php" method="post" onsubmit="return validarFormulario()">
    <label>Email atual:</label>
    <input type="email" value="<?php echo htmlspecialchars($email); ?>" disabled>

    <h3>Alterar Email:</h3>
    <label for="novo_email">Novo email:</label>
    <input type="email" id="novo_email" name="novo_email" placeholder="Novo Email">

    <label for="confirmar_email">Confirmar novo email:</label>
    <input type="email" id="confirmar_email" placeholder="Confirmar Novo Email">

    <h3>Alterar Senha:</h3>
    <label for="nova_senha">Nova senha:</label>
    <input type="password" id="nova_senha" name="nova_senha" placeholder="Nova Senha">

    <label for="confirmar_senha">Confirmar nova senha:</label>
    <input type="password" id="confirmar_senha" placeholder="Confirmar Nova Senha">

    <button type="submit">Atualizar</button>
</form>

    <p><a href="welcome.php">Voltar</a></p>
</div>

<script>
function validarFormulario() {
    const email = document.getElementById("novo_email").value.trim();
    const confirmarEmail = document.getElementById("confirmar_email").value.trim();
    const senha = document.getElementById("nova_senha").value.trim();
    const confirmarSenha = document.getElementById("confirmar_senha").value.trim();

    if (email !== "") {
        if (confirmarEmail === "") {
            alert("Por favor, confirme o novo email.");
            return false;
        }
        if (email !== confirmarEmail) {
            alert("Os e-mails não coincidem.");
            return false;
        }
    }

    if (senha !== "") {
        if (confirmarSenha === "") {
            alert("Por favor, confirme a nova senha.");
            return false;
        }
        if (senha !== confirmarSenha) {
            alert("As senhas não coincidem.");
            return false;
        }
    }

    return true;
}
</script>

<?php
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
    echo "<script>alert('Dados atualizados com sucesso!');</script>";
}
if (isset($_GET['erro'])) {
    echo "<script>alert('Erro ao atualizar dados.');</script>";
}
if (isset($_GET['nenhuma_alteracao'])) {
    echo "<script>alert('Nenhum dado foi alterado.');</script>";
}
?>
</body>
</html>
