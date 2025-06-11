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
    $mail->setFrom($_POST['email'], $_POST['nom']);
    $mail->addReplyTo($_POST['email'], $_POST['nom']);
    $mail->addAddress('onligneschool@gmail.com', 'Onligne_School'); // Adresse du destinataire

    // Contenu
    $mail->isHTML(true);
    $mail->Subject = "INFORMATION SUR L'ECOLE";
    $mail->Body = $_POST['message'];

    // Envoi
    $mail->send();
} catch (Exception $e) {
    echo '❌ Erreur lors de l\'envoi : ' . $mail->ErrorInfo;
}
?>
