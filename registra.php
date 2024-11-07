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
        <button type="submit" class="btn btn-primary col-3" >Registrarse</button>
       
        </div>
      </form>
</div>
<?php 
  include_once("funciones.php");
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email=$_POST['email'];
    $contrasena=$_POST['contrasena'];
    $contrasena2=$_POST['contrasena2'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $fechaNacimiento=$_POST['fechaNacimiento'];
    $tipoUsuario=$_POST['tipoUsuario'];
    if ($contrasena==$contrasena2){
      if (mailExiste($email)==FALSE){
        $contrasenaEncriptada = password_hash($contrasena, PASSWORD_DEFAULT);
      if($tipoUsuario=='cliente'){
        $categoriaCliente='inicial';
        $estado=0;
      }else{
        $categoriaCliente='';
        $estado=1;
      }
      
      $query = "INSERT INTO usuarios (nombreUsuario,claveUsuario,categoriaCliente,tipoUsuario,nombre,apellido,fechaNacimiento,estado)	

      values ('$email','$contrasenaEncriptada', '$categoriaCliente', '$tipoUsuario', '$nombre','$apellido','$fechaNacimiento','$estado')";
      consultaSQL($query) or die (mysqli_error($link));
      echo("Usuario registrado con éxito");
      echo ("<A href='login.php'>Iniciar sesión</A>");
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
