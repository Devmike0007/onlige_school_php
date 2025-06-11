<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$mail = new PHPMailer(true);

try {
    // Configuration du serveur SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'onligneschool@gmail.com';
    $mail->Password = 'jibhwigateornnnn'; // ⚠️ mot de passe d'application SANS espaces
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    // Expéditeur et destinataire
    $mail->setFrom('espoircompagnie0001@gmail.com', 'Michee');
    $mail->addAddress($_POST['email'],'');

    // Contenu
    $link = 'http://localhost/onligne_school/membre/verification.php?token=' . urlencode($token) . '&email=' . urlencode($_POST['email']);

    $mail->isHTML(true);
    $mail->Subject = 'Confirmation de votre adresse email';

    $mail->Body = '
        <div style="font-family: Arial, sans-serif; color: #333; padding: 20px;">
            <h2 style="color: #2c77f0;">Confirmation de votre adresse email</h2>
            <p>Bonjour,</p>
            <p>Merci de vous être inscrit. Pour finaliser votre inscription, veuillez confirmer votre adresse email en cliquant sur le bouton ci-dessous :</p>
            <p style="margin: 20px 0;">
                <a href="' . $link . '" style="background-color: #2c77f0; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                    Confirmer votre email
                </a>
            </p>
            <p>Si vous n\'avez pas demandé cette inscription, vous pouvez ignorer ce message.</p>
            <p style="margin-top: 30px;">Cordialement,<br>L’équipe de votre école</p>
        </div>';
    // Envoi
    $mail->send();
} catch (Exception $e) {
    echo '❌ Erreur lors de l\'envoi : ' . $mail->ErrorInfo;
}
?>
