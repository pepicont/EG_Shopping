<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(!empty($_POST['enviar'])){


   $mail = new PHPMailer();
   $mail->isSMTP();
   $mail->SMTPDebug = 0; // Set to 0 for no debug output, 1 for errors and messages
   $mail->Host = 'smtp.hostinger.com';
   $mail->Port = 465; // Use 465 for SSL or 587 for TLS
   $mail->SMTPAuth = true;
   $mail->Username = 'eg_shopping@egshopping.store';
   $mail->Password = '6qAGB$Hhtq&@ma+';
   $mail->setFrom('eg_shopping@egshopping.store', 'Mundo Shopping');
   /*$mail->addReplyTo('EG_SHOPPING@yahoo.com', 'Your Name');*/
   $mail->addAddress($_POST['email'], 'Receiver Name');
   $mail->Subject = $_POST['asunto'];
   $mail->msgHTML(file_get_contents('message.html'), __DIR__);
   $mail->Body = $_POST['cuerpo'];
   //$mail->addAttachment('attachment.txt');
   if (!$mail->send()) {
       echo 'Error de mail: ' . $mail->ErrorInfo;
   } else {
       exit(header("Location: index.php"));}}
?>