<?php
// Contact form email handler
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        echo '<p style="color: #f39c12;">❌ Please fill in all required fields.</p>';
        exit;
    }

    // Check if mail function is available
    if (!function_exists('mail')) {
        echo '<p style="color: #f39c12;">❌ Email service is temporarily unavailable. Please try again later.</p>';
        exit;
    }

    // Prepare email content
    $to = 'm.j.zukauskas@gmail.com';
    $subject = 'Contact Form: New message from ' . $name;
    $email_body = "=== NEW CONTACT FORM MESSAGE ===\n\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Phone: " . $phone . "\n";
    $email_body .= "Message:\n" . $message . "\n\n";
    $email_body .= "=== DETAILS ===\n";
    $email_body .= "Sent from: " . $_SERVER['HTTP_HOST'] . "\n";
    $email_body .= "Date: " . date('Y-m-d H:i:s') . "\n";
    $email_body .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";

    // Email headers (using same format as debug version)
    $headers = "From: noreply@" . $_SERVER['HTTP_HOST'] . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    $mail_result = mail($to, $subject, $email_body, $headers);
    
    if ($mail_result) {
        echo '<p style="color: #4CAF50;">✅ Thank you! Your message has been sent successfully.</p>';
        
        // Log successful emails (optional)
        $log_entry = date('Y-m-d H:i:s') . " - Email sent to: $to from: $email ($name)\n";
        file_put_contents('email_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
        
    } else {
        echo '<p style="color: #f39c12;">❌ Sorry, there was an error sending your message. Please try again.</p>';
        
        // Log failed attempts
        $log_entry = date('Y-m-d H:i:s') . " - Email FAILED to: $to from: $email ($name)\n";
        file_put_contents('email_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
    }
    
} else {
    echo '<p style="color: #f39c12;">❌ Invalid request method.</p>';
}
?>
