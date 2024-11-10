<?php
    if(!empty($_POST['enviar'])){
   require 'vendor/autoload.php';
   use PHPMailer\PHPMailer\PHPMailer;
   $mail = new PHPMailer;
   $mail->isSMTP();
   $mail->SMTPDebug = 2;
   $mail->Host = 'smtp.hostinger.com';
   $mail->Port = 587;
   $mail->SMTPAuth = true;
   $mail->Username = 'EG_SHOPPING@yahoo.com';
   $mail->Password = '6qAGB$Hhtq&@ma+';
   $mail->setFrom('EG_SHOPPING@yahoo.com', 'Mundo Shopping');
   $mail->addReplyTo('EG_SHOPPING@yahoo.com', 'Your Name');
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