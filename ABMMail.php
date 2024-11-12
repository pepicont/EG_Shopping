<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(!empty($_POST['enviar'])){
    // Recoger datos del formulario
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $asunto = htmlspecialchars($_POST['asunto']);
    $cuerpo = htmlspecialchars($_POST['cuerpo']);

    // Validar el email
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        // Configuración de PHPMailer
        $mail = new PHPMailer(true); // Habilitar excepciones
        try {
            // Usar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Para Gmail
            //$mail->Host = 'smtp.hostinger.com';  // Para Hostinger (descomentar si usas Hostinger)
            $mail->SMTPAuth = true;
            $mail->Username = 'mundoshoppinga@gmail.com';  // Tu correo Gmail o Hostinger
            $mail->Password = 'tu_contraseña_de_aplicación';  // Contraseña de aplicación (si usas Gmail) o la contraseña de Hostinger
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // Usar SSL
            $mail->Port = 465;  // Puerto para SSL

            // De donde proviene el correo
            $mail->setFrom('mundoshoppinga@gmail.com', 'Mundo Shopping');
            $mail->addAddress($email, 'Receiver Name');  // Correo del destinatario
            $mail->Subject = $asunto;
            $mail->msgHTML(file_get_contents('message.html'), __DIR__);  // Si tienes un HTML para el mensaje
            $mail->Body = $cuerpo;  // Cuerpo del mensaje

            // Enviar el correo
            $mail->send();
            header("Location: index.php"); // Redirigir al index después de enviar
            exit();
        } catch (Exception $e) {
            echo 'Error de mail: ' . $mail->ErrorInfo;
        }
    } else {
        echo "Correo electrónico inválido.";
    }
}
?>
