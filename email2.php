<?php
require_once("private/phpmailer/class.phpmailer.php");
require_once("private/phpmailer/class.smtp.php");
require_once("private/phpmailer/language/phpmailer.lang-it.php");

$to_name = "FR";
$to = "federico.rizzo@auto1.com";
//$to = "Fed Rizzo <synestematic@gmail.com>";
$subject = "Mail Test at ".strftime("%T", time());
$message = "Test message";
$message = wordwrap($message,70);
$from_name = "Fed Rizzo";
$from = "synestematic@gmail.com";

$mail = new PHPMailer();
$mail->FromName = $from_name;
$mail->From = $from;
$mail->AddAddress($to, $to_name);
$mail->Subject = $subject;
$mail->Body = $message;

$result = $mail->Send();
echo $result ? 'Messaggio inviato' : 'Error' ;

?>
