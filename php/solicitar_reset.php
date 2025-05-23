<?php
// php/solicitar_reset.php

// ... (seu código de conexão ao banco de dados) ...
require '../vendor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usuarios";

// Estabelecer a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", time() + 3600);

        $update_sql = "UPDATE usuarios SET reset_token = ?, reset_token_expiry = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssi", $token, $expiry, $user_id);

        if ($update_stmt->execute()) {
            $reset_link = "http://localhost/redefinir_senha.php?token=" . $token;
            $subject = "Recuperação de Senha";
            $body = "Clique no link abaixo para redefinir sua senha:\n\n" . $reset_link . "\n\nEste link é válido por 1 hora.";
            $from_email = 'example_email@gmail.com';
            $from_name = 'Sistema de Login Impacta';
            $smtp_username = 'example_email@gmail.com';
            $smtp_password = 'password';

            // *** CRIANDO A INSTÂNCIA DO PHPMailer AQUI ***
            $mail = new PHPMailer(true);

            try {
                // Configurações do Servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = $smtp_username;
                $mail->Password = $smtp_password;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Remetente e Destinatário
                $mail->setFrom($from_email, $from_name);
                $mail->addAddress($email);
                $mail->isHTML(false);
                $mail->CharSet = 'UTF-8'; // Adicione esta linha
                $mail->Subject = $subject;
                $mail->Body = $body;

                $mail->send();
                echo "Um link de recuperação de senha foi enviado para o seu e-mail.";

            } catch (Exception $e) {
                echo "Erro ao enviar o e-mail de recuperação: {$mail->ErrorInfo}";
            }
        } else {
            echo "Erro ao salvar o token de recuperação.";
        }
        $update_stmt->close();
    } else {
        echo "O e-mail fornecido não foi encontrado em nosso sistema.";
    }
    $stmt->close();
}
$conn->close();
?>