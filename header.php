<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("funciones.php");
existecookie();
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
    <?php /* $ruta=__DIR__; 
        $ruta=str_replace("\\", "/", $ruta);
        echo "$ruta"; */
        if(!isset($lugar)){
            $lugar="";
        }
        if($lugar=="admin" or $lugar=="duenoLocal" or $lugar=="cliente")
            $ruta="../";
        else{
            $ruta="";
        }

    ?>

    <!-- navbar del mobile -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
        <div class="container-fluid mx-auto px-auto" style="background-color: white; margin-top:-10px; border-bottom:2px solid violet; ">
            <a class="navbar-brand" href="<?php echo("$ruta");?>index.php"><img src= "<?php echo("$ruta");?>assets/Mundo_Shopping.png"alt="Mundo Shopping"></a>
            <?php /* Si el usuario no está logueado, le muestra el botón de igresar sesión */
                if($login==FALSE){

             ?>
             <?php if (!defined('HEADER_INCLUDED')) { ?> 
                <a href="<?php echo("$ruta");?>login.php" class="login-button ms-auto d-lg-none">Iniciar sesión</a>
            <?php } ?>
            
            <?php } else{

                   if($tipoUsuario=="duenoLocal")
                        $mostrarUsuario="Dueño de local";
                    if($tipoUsuario=="cliente")
                        $mostrarUsuario="Cliente";
                    if($tipoUsuario=="administrador")
                        $mostrarUsuario="Administrador";
                    ?>
                    <a href='#' class='user-info ms-auto d-lg-none'><?php if($tipoUsuario=="cliente"){?><img src="<?php echo("$ruta"."assets/$categoriaCliente.png"); ?>" style="max-width:30px; max-height:30px; margin-right:7px;" alt="categoría del cliente"><?php } echo $mostrarUsuario ?></a>
                    <?php
            } ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-lg-30 mx-auto px-auto  ">
                    <li class="nav-item ">
                        <a class="nav-link active" aria-current="page" href="#">Locales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Promocioness</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Acerca de</a>
                    </li>
                    
                </ul>
                
                <?php if($login==TRUE){?>
                <a style="float:right; margin-right: 20px;" href='#' class='user-info ms-auto d-none d-lg-block'><?php if($tipoUsuario=="cliente"){?><img src="<?php echo("$ruta"."assets/$categoriaCliente.png");?>" style="max-width:30px; max-height:30px; margin-right:7px;" alt="categoría del cliente"><?php } echo $mostrarUsuario ?></a>
                <?php } ?>
                <ul class="navbar-nav   <?php if($login==FALSE){ echo("d-none");} ?>">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cuenta
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>

                            <li><a class="dropdown-item" href="<?php echo("$ruta");?>logOut.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            
            <?php 
            
            if (!defined('HEADER_INCLUDED')) { ?> 
                <a href="<?php echo("$ruta");?>login.php" class="login-button ms-auto d-none d-lg-block  <?php if($login==TRUE){ echo("d-lg-none");} ?>">Iniciar sesión</a>
            <?php } ?> 
            
            
        </div>
    </nav>

    
    
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>