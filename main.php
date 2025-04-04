<?php
$to = 'destinatario@example.com'; // Substitua pelo e-mail de teste
$subject = 'Teste de Envio de E-mail PHP';
$message = 'Este é um e-mail de teste enviado pelo PHP.';
$headers = 'From: seu_email@gmail.com' . "\r\n" .
           'Reply-To: seu_email@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'E-mail enviado com sucesso!';
} else {
    echo 'Falha ao enviar o e-mail.';
}
?>