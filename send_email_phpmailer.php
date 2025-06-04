<?php
// PHPMailer version - use this if PHPMailer is installed on server
// Rename this file to send_email.php if you want to use PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Try to load PHPMailer via Composer autoload first
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
} else {
    // Fallback to manual includes
    require_once __DIR__ . '/PHPMailer/src/Exception.php';
    require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
    require_once __DIR__ . '/PHPMailer/src/SMTP.php';
}

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Set proper content type
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        echo '<p style="color: #f39c12;">Please fill in all required fields.</p>';
        exit;
    }

    if (!$email) {
        echo '<p style="color: #f39c12;">Please enter a valid email address.</p>';
        exit;
    }

    // PHPMailer setup
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'm.j.zukauskas@gmail.com';
        $mail->Password = 'your-app-password-here'; // Use environment variable in production
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('m.j.zukauskas@gmail.com');
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'New Contact Form Submission from ' . $name;
        $mail->Body = "New contact form submission:\n\n";
        $mail->Body .= "Name: " . $name . "\n";
        $mail->Body .= "Email: " . $email . "\n";
        $mail->Body .= "Phone: " . $phone . "\n";
        $mail->Body .= "Message:\n" . $message . "\n\n";
        $mail->Body .= "Sent from: " . $_SERVER['HTTP_HOST'] . "\n";
        $mail->Body .= "Time: " . date('Y-m-d H:i:s') . "\n";

        $mail->send();
        echo '<p style="color: #4CAF50;">Thank you! Your message has been sent successfully.</p>';
        
    } catch (Exception $e) {
        error_log('Contact form PHPMailer error: ' . $mail->ErrorInfo);
        echo '<p style="color: #f39c12;">Thank you for your message. We will get back to you soon!</p>';
    }
} else {
    echo '<p style="color: #f39c12;">Invalid request method.</p>';
}
?> 