<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_COOKIE['mantenerSesionIniciada'])) {
    $_SESSION['usuario'] = $_COOKIE['usuario'];
    $_SESSION['tipoUsuario'] = $_COOKIE['tipoUsuario'];
    $_SESSION['categoriaCliente'] = $_COOKIE['categoriaCliente'];}
if (isset($_SESSION['tipoUsuario'])){
    $tipoUsuario=$_SESSION['tipoUsuario'];
    
    if ($tipoUsuario=='cliente'){
        $categoriaCliente=$_SESSION['categoriaCliente'];}
    $usuario=$_SESSION['usuario'];
    $login=TRUE;
} else{
    $login=FALSE;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="estilos/style1.css" rel="stylesheet">
</head>
<body>

    <!-- navbar del mobile -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
        <div class="container-fluid mx-auto px-auto">
            <a class="navbar-brand" href="home.php"><img alt="">*Mundo Shopping*</a>
            <?php /* Si el usuario no está logueado, le muestra el botón de igresar sesión */
                if($login==FALSE){
                    
                
             ?>
            <a href="login.php" class="login-button ms-auto d-lg-none">Iniciar sesión</a>
            <?php } else{
                if($tipoUsuario=='Administrador')
            
                    echo('<a href="perfil.php" class="user-info ms-auto d-lg-none">Administrador</a> ');
            } ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse  px-auto " id="navbarNav">
                <ul class="navbar-nav mx-auto px-auto  ">
                    <li class="nav-item ">
                        <a class="nav-link active" aria-current="page" href="#">Locales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Promociones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Acerca de</a>
                    </li>
                    
                </ul>
               
                <ul class="navbar-nav ms-auto  <?php if($login==FALSE){ echo("d-none");} ?>">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cuenta
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>

                            <li><a class="dropdown-item" href="logOut.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <a href="login.php" class="login-button ms-auto d-none d-lg-block  <?php if($login==TRUE || (basename(__FILE__)=='login.php')){ echo("d-lg-none");} ?>"> <?php $ruta=__FILE__ ;echo(''.$ruta.'')?>Iniciar sesión</a>

            
            
        </div>
    </nav>

    
    
    <div class="container"></div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>