<?php

// Verificar si hay una cookie para mantener la sesión iniciada
ini_set('session.cookie_lifetime',0);
if(isset($_COOKIE['mantenerSesionIniciada']) && $_COOKIE['mantenerSesionIniciada'] == 'si') {
  session_start();
  $_SESSION['usuario'] = $_COOKIE['usuario'];
  header("Location:home.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<header>
  <?php
  include("header.html");
  ?>
</header>
<body>
    <div class="container">
    <form action="login.php" method="POST">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email" required>
          
        </div>
        <div class="form-group">
          <label for="contrasena">Contraseña</label>
          <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="*********" required>
        </div>
        <div class="form-group form-check">
            <input type="hidden" name="mantenerSesionIniciada" value="no"> <!-- Valor por default del checkbox -->
            <input type="checkbox" class="form-check-input" id="mantenerSesionIniciada" name="mantenerSesionIniciada" value="si">
          <label class="form-check-label" for="mantenerSesionIniciada">Mantener sesión iniciada</label>
        </div>
        <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary col-3" >Iniciar sesión</button>
       
        </div>
      </form>
      <a href="registra.php">Crear cuenta</a> <!-- Te lleva a la página de creación de cuenta register.php-->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php 
    include("conexiones/conexion.inc");
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $email = $_POST['email'];
      $contrasena = $_POST['contrasena'];
      $contrasenaEncriptada = password_hash($contrasena, PASSWORD_DEFAULT);
      $mantenerSesionIniciada = $_POST['mantenerSesionIniciada'];
      $query = "SELECT * FROM usuarios WHERE nombreUsuario='$email' ";
      $vResultado = mysqli_query($link, $query) or die (mysqli_error($link));
      $fila = mysqli_fetch_array($vResultado);
      if(mysqli_num_rows($vResultado) == 0) {
      echo ("Usuario Inexistente, intentelo de nuevo o registrese <br>");}
      else{
        if (password_verify($contrasena, $fila['claveUsuario'])){
          $tipoUsuario=$fila['tipoUsuario'];
          if ($tipoUsuario=='cliente'){
              $categoriaCliente=$fila['categoriaCliente'];
          }
          if($mantenerSesionIniciada=='no'){
            
          }else{
            
            setcookie('mantenerSesionIniciada','si',time()+(60*60*24*365));
            setcookie('usuario',$email,time()+(60*60*24*365));
          }
          
          $_SESSION['codigo']=$fila['codUsuario'];
          $_SESSION['usuario']=$email;
          $_SESSION['contrasena']=$contrasenaEncriptada;
          $_SESSION['tipoUsuario']=$tipoUsuario;
          $_SESSION['categoriaCliente']=$categoriaCliente;
          echo '<meta http-equiv="refresh" content="0;url=home.php">';
          exit();
        }else{
          echo("Contrasena incorrecta");
        }
        }
      }
    ?>
</body>
<footer>
<?php
  include("footer.html");
  ?>
</footer>
</html>