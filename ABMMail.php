<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';  // Incluye el archivo de autoload de Composer para cargar PHPMailer

if (!empty($_POST['enviar'])){
    $mail = new PHPMailer(true); // Habilita excepciones
    try {
        // Configuración de servidor SMTP
        $mail->isSMTP();  // Usa SMTP
        $mail->Host = 'smtp.hostinger.com';  // Servidor SMTP de Hostinger
        $mail->SMTPAuth = true;  // Habilita autenticación SMTP
        $mail->Username = 'eg_shopping@egshopping.store';  // Tu correo de Hostinger
        $mail->Password = '6qAGB$Hhtq&@ma+';  // Tu contraseña o la contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Usa SSL
        $mail->Port = 465;  // Puerto SMTP para SSL

        // Remitente
        $mail->setFrom('eg_shopping@egshopping.store', 'admin');  // El correo y nombre del remitente
        // Destinatario
        $mail->addAddress('eg_shopping@yahoo.com');  // El correo del destinatario (tomado desde el formulario)
        $mail->Subject = $_POST['asunto']; // Asunto (tomado desde el formulario)
        if ($login==true){
            $correo= $_SESSION['usuario'];
        }
        else{
            $correo= $_POST['email'];
        }
        $mail->Body = "Mail: $correo \n Cuerpo: ".$_POST['cuerpo']."";  // Cuerpo del mensaje (tomado desde el formulario)

        // Enviar correo
        $mail->SMTPDebug = 2; // Habilita depuración para ver detalles del proceso
        $mail->send();
        //if($_POST['lugar']=='registra'){
            //header("Location: registra.php");  // Redirige a la página de registro después de enviar el correo
            //exit();  // Sale del script
        //} else {
            //header("Location: index.php");  // Redirige a la página principal después de enviar el correo
              //exit();
               // Sale del script
        //}
    }catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";}

    }
    


?>
