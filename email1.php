<?php

$to = "federico.rizzo@auto1.com";
//$to = "Fed Rizzo <synestematic@gmail.com>";
$subject = "Mail Test at ".strftime("%T", time());
$message = "Test message";
$message = wordwrap($message,70);

$from = "Fed Rizzo <synestematic@gmail.com>";
$headers = "From: {$from}\n";
$headers .= "Reply-To: {$from}\n";
$headers .= "Cc: {$to}\n";
$headers .= "Bcc: {$to}\n";
$headers .= "X-Mailer: PHP/".phpversion()."\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: text/html; charset-iso-8859-1";

$result = mail($to, $subject, $message, $headers);
echo $result ? 'Sen' : "Error" ;

?>
