<?php
$to      = $_POST['email'];
$subject = 'Verify your account!';
$message = 'Click this link to verify you account '.$accessTokenUrl;
$headers = 'From: localhost' . "\r\n" .
    'Reply-To: localhost' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message,$headers);
?>
