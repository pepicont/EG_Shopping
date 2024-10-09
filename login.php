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
          <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email">
          
        </div>
        <div class="form-group">
          <label for="contrasena">Contraseña</label>
          <input type="password" class="form-control" id="contrasena" placeholder="*********">
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="mantenerSesionIniciada" name="mantenerSesionIniciada">
          <label class="form-check-label" for="mantenerSesionIniciada">Mantener sesión iniciada</label>
        </div>
        <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary col-3" >Iniciar sesión</button>
       
        </div>
      </form>
      <a href="registra.php">Crear cuenta</a> <!-- Te lleva a la página de creación de cuenta register.php-->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
<footer>
<?php
  include("footer.html");
  ?>
</footer>
</html>