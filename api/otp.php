<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    $to = $email;
    $from = "basudevpanda009@gmail.com";
    $fromName = "basudev coder";
    $subject = "OTP AUTHENTICATION";
    $message = "Your OTP is: " . $otp;
    $headers = "From: $fromName <$from>\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "Successful";
    } else {
        echo "Failed to send email.";
    }
}
?>

<form action="" method="post">
    <input type="email" name="email" placeholder="Enter your email" required><br>
    <input type="number" name="otp" placeholder="Enter OTP" required><br>
    <button type="submit">Send OTP</button>
</form>