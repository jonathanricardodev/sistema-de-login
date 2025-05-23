<?php
session_start();
if (isset($_SESSION['email'])) {
    header("Location: welcome.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm" action="php/login.php" method="post">
            <input type="email" name="email" placeholder="Email" required id="emailInput">
            <input type="password" name="senha" placeholder="Senha" required id="senhaInput">
            <button type="submit">Entrar</button>
        </form>
        <p><a href="cadastro.html">Criar conta</a></p>
        <p><a href="recuperar_senha.html">Recuperar senha</a></p>
    </div>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const mensagem = urlParams.get('mensagem');
        const email = urlParams.get('email');

        if (email) {
            document.getElementById('emailInput').value = email;
        }

        if (mensagem === 'senha_incorreta') {
            alert('Senha incorreta.');
            senhaInput.style.borderColor = 'red';
            senhaInput.classList.add('shake');
            senhaInput.addEventListener('animationend', () => {
                senhaInput.classList.remove('shake');
            });
        } else if (mensagem === 'usuario_nao_encontrado') {
            alert('Usuário não encontrado.');
            emailInput.style.borderColor = 'red';
            emailInput.classList.add('shake');
            emailInput.addEventListener('animationend', () => {
                emailInput.classList.remove('shake');
            });
            
        }
    </script>
    <script src="js/script.js"></script>
</body>
</html>