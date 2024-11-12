<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
// Incluye el archivo de autoload de Composer para cargar PHPMailer

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="estilos/style1.css" rel="stylesheet">
</head>
<header>
  <?php
  $lugar="registra";
  include("header.php");
  include_once("funciones.php");
  ?>
  
</header>
<body>


<div class="container">
    <form action="registra.php" method="POST">
        <div class="form-group">
          <label for="email" required>Email</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese su email">
          
        </div>
        <div class="form-group">
          <label for="contrasena" required>Contraseña</label>
          <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="*********">
        </div>
        <div class="form-group">
          <label for="contrasena2" required>Repetir contraseña</label>
          <input type="password" class="form-control" name="contrasena2" id="contrasena2" placeholder="*********">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre </label>
          <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Juan">
        </div>
        <div class="form-group">
            <label for="apellido">Apellido </label>
          <input type="text" class="form-control" name="apellido" id="apellido" required placeholder="Perez">
        </div>
        <div class="form-group">
          Fecha de nacimiento: <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control" required>
        </div>
        <div class="form-group">
          Tipo de usuario: </br>
          <label for="cliente" >Cliente</label><input id="cliente" type="radio" name="tipoUsuario" value="cliente" required>   
          <label for="duenoLocal">Dueño de local</label><input id="duenoLocal" name="tipoUsuario" value="duenoLocal" type="radio" required>
          
        </div>
        <div class="d-flex justify-content-center">
        <input type="submit" name="registrarse" class="btn btn-primary col-3" value="Registrarse">
        </div>
      </form>
</div>
<?php 
  include_once("funciones.php");
  if(!empty($_POST['registrarse'])) {
    $email=trim($_POST['email']);
    
    $contrasena=trim($_POST['contrasena']);
    $contrasena2=trim($_POST['contrasena2']);
    $nombre=trim($_POST['nombre']);
    $apellido=trim($_POST['apellido']);
    $fechaNacimiento=trim($_POST['fechaNacimiento']);
    $tipoUsuario=trim($_POST['tipoUsuario']);
    if ($contrasena==$contrasena2 and $contrasena!=""){
      if (mailExiste($email)==FALSE){
        $contrasenaEncriptada = password_hash($contrasena, PASSWORD_DEFAULT);
      if($tipoUsuario=='cliente'){
        $categoriaCliente='inicial';
        $estado=0;
      }else{
        //Enviamos el mail para que confirme el admin al dueño de local

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
          $mail->Subject = "Nueva solicitud de dueno de local";  // Asunto (tomado desde el formulario)
          $mail->Body = "Nombre: $nombre $apellido \n email: $email";  // Cuerpo del mensaje (tomado desde el formulario)
  
          // Enviar correo
          $mail->SMTPDebug = 2; // Habilita depuración para ver detalles del proceso
          $mail->send();
          if($_POST['lugar']=='registra'){
              header("Location: registra.php");  // Redirige a la página de registro después de enviar el correo
              exit();  // Sale del script
          } else {
              header("Location: index.php");  // Redirige a la página principal después de enviar el correo
              exit();  // Sale del script
          }
        } catch (Exception $e) {
            echo 'Error de mail: ' . $mail->ErrorInfo;  // Muestra un mensaje de error si no se pudo enviar
        }
        $categoriaCliente='';
        $estado=1;
        echo "<form id='hiddenForm' action='index.php' method='POST' style='display:none;'>
        <input type='hidden' name='asunto' value='Nuevo cliente registrado'>
        <input type='hidden' name='cuerpo' value='Cliente: $nombre,$apellido. 
        Su mail es: $mail.
        Fecha de nacimiento: $fechaNacimiento.'>
        <input type='hidden' name='lugar' value='registra'>
        </form>";
    echo "<script>document.getElementById('hiddenForm').submit();</script>";
      }
      $query = "INSERT INTO usuarios (nombreUsuario,claveUsuario,categoriaCliente,tipoUsuario,nombre,apellido,fechaNacimiento,estado)	
      values ('$email','$contrasenaEncriptada', '$categoriaCliente', '$tipoUsuario', '$nombre','$apellido','$fechaNacimiento','$estado')";
      consultaSQL($query) or die (mysqli_error($link));
      
      echo("Usuario registrado con éxito");
      echo ("<A href='index.php'>Iniciar sesión</A>");
      } else{
        echo("El mail ingresado ya está registrado");
      }
    }else{
      echo ("Las contraseñas ingresadas no coinciden");
    }
  }

      

?>
</body>
<footer>
<?php
  include("footer.php");
  ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
