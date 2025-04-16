<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Įtraukti PHPMailer failus
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

// Įjungti klaidų pranešimus
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // PHPMailer nustatymai
    $mail = new PHPMailer(true);
    try {
        // Serverio nustatymai
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Naudok savo SMTP serverį (pvz., smtp.gmail.com)
        $mail->SMTPAuth = true;
        $mail->Username = 'm.j.zukauskas@gmail.com'; // Tavo el. pašto adresas
        $mail->Password = 'zxfj ptvd pbpz yzwf'; // PHPMailer slaptažodis
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Saugumo tipas
        $mail->Port = 587; // SMTP porto numeris

        // Gavėjai
        $mail->setFrom($email, $name);
        $mail->addAddress('m.j.zukauskas@gmail.com'); // Pagrindinis gavėjas

        // Turinio nustatymai
        $mail->isHTML(false);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";

        $mail->send();
        echo '<p>Thank you! Your message has been sent successfully.</p>';
    } catch (Exception $e) {
        echo "<p>Sorry, there was an error sending your message: {$mail->ErrorInfo}</p>";
    }
}
?>
