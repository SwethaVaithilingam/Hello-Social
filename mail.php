<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If using Composer

// Manually include PHPMailer if not using Composer
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // $name = htmlspecialchars($_POST['con_name']);
    // $phone = htmlspecialchars($_POST['con_phone']);
    // $email = filter_var($_POST['con_email'], FILTER_SANITIZE_EMAIL);
    // $company = htmlspecialchars($_POST['con_company']);
    // $message = htmlspecialchars($_POST['con_msg']);

    $name = 'razeen';
    $phone = '34234234423';
    $email = 'razeen@gmail';
    $company = 'razeen';
    $message = 'razeen';

    // Validate fields
    if (empty($name) || empty($phone) || empty($email) || empty($message)) {
        die("Please fill in all required fields.");
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // cPanel Email SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'mail.hellosocial.com'; // Change to your cPanel mail server
        $mail->SMTPAuth = true;
        $mail->Username = 'developer@hellosocial.in'; // Your cPanel email
        $mail->Password = 'tl7nGjbLiAu;'; // Your cPanel email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS (or PHPMailer::ENCRYPTION_SMTPS for SSL)
        $mail->Port = 465; // 465 for SSL, 587 for TLS

        // Recipients
        $mail->setFrom($mail->Username, 'Hello social'); // Sender
        $mail->addAddress('makerrazeen2301@gmail.com', 'Razeen'); // Receiver (your email)

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission from $name";
        $mail->Body = "
            <h2>Contact Form Details</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Company:</strong> $company</p>
            <p><strong>Message:</strong><br> $message</p>
        ";

        // Send email
        if ($mail->send()) {
            echo "Message sent successfully!";
        } else {
            echo "Message could not be sent.";
        }
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid Request.";
}
?>