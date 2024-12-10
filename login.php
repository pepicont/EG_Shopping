<?php

// Verificar si hay una cookie para mantener la sesión iniciada
include_once("session.php"); 
include_once("funciones.php");
if(existecookie()) {
  header("Location:index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="estilos/style1.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="icon" href="assets/favicon-32x32.png">
</head>
<header>
  <?php
  define('HEADER_INCLUDED', TRUE);
  $lugar="login";
  include("header.php");
  ?>
</header>
<body>
    <?php if($login!=TRUE){ ?>
    <div class="container" style="min-height: 30vh; margin-top:2rem;">
    <form action="login.php" method="POST">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email" required>
          
        </div>
        <div class="form-group">
          <label for="contrasena">Contraseña</label>
            <div class="input-group">
            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="*********" required>
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
              <i class="bi bi-eye-slash" id="toggleIcon"></i>
            </button>
            </div>
            <script>
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#contrasena');
            const toggleIcon = document.querySelector('#toggleIcon');

            togglePassword.addEventListener('click', function (e) {
              // Cambia el atributo type del input de password a text, de esta manera cuando sea password
              // se van a poner los asteríscos
              const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
              password.setAttribute('type', type);
              // Cambia el icono del ojo, dando a entender si se muestra o no la contraseña
              toggleIcon.classList.toggle('bi-eye');
              toggleIcon.classList.toggle('bi-eye-slash');
            });
            </script>
        </div>
        <div class="form-group form-check">
            <input type="hidden" name="mantenerSesionIniciada" value="no"> <!-- Valor por default del checkbox -->
            <input type="checkbox" class="form-check-input" id="mantenerSesionIniciada" name="mantenerSesionIniciada" value="si">
          <label class="form-check-label" for="mantenerSesionIniciada">Mantener sesión iniciada</label>
        </div>
        <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary col-3" name="enviar" >Iniciar sesión</button>
        </div>
      </form>
      <a href="registra.php">Crear cuenta</a> <!-- Te lleva a la página de creación de cuenta register.php-->
    </div>
    <?php 
    
    if(isset($_POST['enviar'])) {
      
      $email = trim($_POST['email']);
      $contrasena =$_POST['contrasena'];
      $contrasenaEncriptada =password_hash($contrasena, PASSWORD_DEFAULT);
      //$categoriaCliente = trim($_POST['categoriaCliente']);
      $mantenerSesionIniciada = $_POST['mantenerSesionIniciada'];
      $query = "SELECT * FROM usuarios WHERE nombreUsuario='$email' ";
      $vResultado = consultaSQL($query) or die (mysqli_error($link));
      $fila = mysqli_fetch_array($vResultado);
      if(mysqli_num_rows($vResultado) == 0) {
        ?>
        <div class="container" style="display:flex; justify-content: center">
        <?php echo '<div class="alert alert-warning mt-3"  style="width: fit-content; display:flex; justify-content: center;" role="alert">
                    Usuario Inexistente, intentelo de nuevo o registrese 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';?>
      </div> <?php
      }
      else{
        if($fila['estado']!='1' and $fila['estado']!='2'){
          if (password_verify($contrasena, $fila['claveUsuario'])){
            $tipoUsuario=$fila['tipoUsuario'];
            $idUsuario=$fila['codUsuario'];
            if ($tipoUsuario=='cliente'){
              $_SESSION['categoriaCliente'] = $fila['categoriaCliente'];
              $_SESSION['nombre']=$fila['nombre'];
            }
            if($mantenerSesionIniciada=='no'){
              $_SESSION['usuario'] = $email;
              $_SESSION['tipoUsuario'] = $tipoUsuario;
              $_SESSION['idUsuario'] = $idUsuario;
            }else{
              setcookie('nombre',$fila['nombre'],time()+(60*60*24*365));
              setcookie('mantenerSesionIniciada','si',time()+(60*60*24*365));
              setcookie('usuario',$email,time()+(60*60*24*365));
              setcookie('tipoUsuario',$tipoUsuario,time()+(60*60*24*365));
              setcookie('categoriaCliente',$fila['categoriaCliente'],time()+(60*60*24*365));
              setcookie('idUsuario',$idUsuario,time()+(60*60*24*365));
            }
            /* Esto también lo tenemos que pasar seguro */
            echo '<meta http-equiv="refresh" content="0;url=index.php">';
            exit();
        }else{
          ?>
                <div class="containter px-auto" style="display:flex; justify-content: center">
                <?php echo '<div class="alert alert-danger mx-auto mt-3"  style="width: fit-content; display:flex; justify-content: center;" role="alert">
                    Contraseña incorrecta
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';?>
                </div>
      <?php }       
        
      }else{
        echo '<div class="alert alert-warning mx-auto mt-3"  style="width: fit-content; display:flex; justify-content: center;" role="alert">
                    Usuario no habilitado, contacte con el administrador
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';

      }}}
    }else{
      header("Location:index.php");
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    
</body>
<footer>
<?php
  include("footer.php");
  ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>