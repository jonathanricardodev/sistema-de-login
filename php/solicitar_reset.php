<?php
// php/solicitar_reset.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Verificar se o e-mail existe no banco de dados
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $user_id = $user['id'];

        // Gerar token único
        $token = bin2hex(random_bytes(32));

        // Definir tempo de expiração (ex: 1 hora)
        $expiry = date("Y-m-d H:i:s", time() + 3600);

        // Salvar token e data de expiração no banco de dados
        $update_sql = "UPDATE usuarios SET reset_token = ?, reset_token_expiry = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssi", $token, $expiry, $user_id);

        if ($update_stmt->execute()) {
            // Enviar e-mail com o link de recuperação
            $reset_link = "http://localhost/redefinir_senha.html?token=" . $token; // Ajuste a URL conforme necessário
            $subject = "Recuperação de Senha";
            $message = "Clique no link abaixo para redefinir sua senha:\n\n" . $reset_link . "\n\nEste link é válido por 1 hora.";
            $headers = "From: jou1989@live.com\r\n"; // Substitua pelo seu e-mail

            // Use a função mail() ou uma biblioteca de envio de e-mails mais robusta
            if (mail($email, $subject, $message, $headers)) {
                echo "Um link de recuperação de senha foi enviado para o seu e-mail.";
            } else {
                echo "Erro ao enviar o e-mail de recuperação.";
                // Log do erro para depuração
            }
        } else {
            echo "Erro ao salvar o token de recuperação.";
            // Log do erro para depuração
        }
        $update_stmt->close();
    } else {
        echo "O e-mail fornecido não foi encontrado em nosso sistema.";
    }
    $stmt->close();
}
$conn->close();
?>