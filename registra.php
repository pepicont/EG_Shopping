<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
// Incluye el archivo de autoload de Composer para cargar PHPMailer
include_once("funciones.php");
?>
<!DOCTYPE html>
<html lang="es">
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
  $entro = 0;
  ?>
  
</header>
<body>


<div class="container">
    <form method="POST">
        <div class="form-group">
          <label for="email" >Email</label>
          <input type="email" class="form-control" name="email" id="email" required placeholder="Ingrese su email">
          
        </div>
        <div class="form-group">
          <label for="contrasena">Contraseña</label>
          <input type="password" class="form-control" name="contrasena" required id="contrasena" placeholder="*********">
        </div>
        <div class="form-group">
          <label for="contrasena2">Repetir contraseña</label>
          <input type="password" class="form-control" name="contrasena2" required id="contrasena2" placeholder="*********">
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
  if(!empty($_POST['registrarse'])) {
    $email=trim($_POST['email']);
    $contrasena=$_POST['contrasena'];
    $contrasena2=$_POST['contrasena2'];
    $nombre=trim($_POST['nombre']);
    $apellido=trim($_POST['apellido']);
    $fechaNacimiento=trim($_POST['fechaNacimiento']);
    $tipoUsuario=$_POST['tipoUsuario'];
    if ($contrasena==$contrasena2 and $contrasena!=""){
      if (mailExiste($email)==FALSE){
        $contrasenaEncriptada = password_hash($contrasena, PASSWORD_DEFAULT);
      if($tipoUsuario=='cliente'){
        $categoriaCliente='inicial';
        $estado=0;
      }else{
        //Enviamos el mail para que confirme el admin al dueño de local

        $entro = 1;
        $categoriaCliente='';
        $estado=1;
      }
      $query = "INSERT INTO usuarios (nombreUsuario,claveUsuario,categoriaCliente,tipoUsuario,nombre,apellido,fechaNacimiento,estado)	
      values ('$email','$contrasenaEncriptada', '$categoriaCliente', '$tipoUsuario', '$nombre','$apellido','$fechaNacimiento','$estado')";
      consultaSQL($query) or die (mysqli_error($link));?>
      <div class="container d-flex" style="justify-content:center">
        <?php 
      echo '<div class="alert alert-success mt-3  " style="width: fit-content" role="alert">
                                Usuario registrado con éxito. 
                                <a href="index.php"> Iniciar sesión</a>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> ';
      ?>
    </div> <?php
      } else{?>
        <div class="container d-flex" style="justify-content:center">
          <?php 
        echo '<div class="alert alert-warning mt-3  " style="width: fit-content" role="alert">
                                  El mail ingresado ya está registrado 
                                  
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div> ';
        ?>
      </div> <?php
      }
    }else{?>
    <div class="container d-flex" style="justify-content:center" >
    <?php echo '<div class="alert alert-danger mt-3 mx-auto" style="width: fit-content" role="alert">
                                Las contraseñas ingresadas no coinciden
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
    ?>
    </div> 
    
    <?php }
  }

if($entro == 1){
  ?>
          <form id="autoSubmitForm" action="ABMMail.php" method="post" style="display:none;">
            <input type="hidden" name="asunto" value="Confirmación de registro de dueño local.">
            <input type="hidden" name="email" value="<?php echo($email)?>">
            <input type="hidden" name="cuerpo" value="Se ha registrado un nuevo dueño de local. 
            De nombre: <?php echo($nombre)?>. 
            Apellido: <?php echo($apellido)?>. 
            Fecha de nacimiento: <?php echo($fechaNacimiento)?>.
            https://egshopping.store/login.php">
            <input type="submit" name="enviar" value="confirma">
          </form>
          <script type="text/javascript">
            document.getElementById('autoSubmitForm').submit();
          </script>

<?php
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