<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require "vendor/autoload.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405); // Send a 405 error
    die("405 Method Not Allowed");
}

$name = $_POST["name"] ?? '';
$email = $_POST["email"] ?? '';
$message = $_POST["message"] ?? '';

// Validate input
if (empty($name) || empty($email) || empty($message)) {
    die("All fields are required.");
}

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Gmail credentials
    $mail->Username = "atat6903@gmail.com";
    $mail->Password = "Igsk tcfx jmep tyns"; // Use App Password Igsk tcfx jmep tyns

    // Email headers
    $mail->setFrom($email, $name);
    $mail->addAddress("atat6903@gmail.com"); // Your Gmail (Recipient)

    // Email content
    $mail->isHTML(true);
    $mail->Subject = "New Message from Contact Form";
    $mail->Body = "<strong>Name:</strong> {$name} <br> 
                   <strong>Email:</strong> {$email} <br> 
                   <strong>Message:</strong> <p>{$message}</p>";

    // Send email
    if ($mail->send()) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email.";
    }
} catch (Exception $e) {
    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
}
?>
