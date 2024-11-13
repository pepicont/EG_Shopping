<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once("funciones.php");
existecookie();
if (isset($_SESSION['tipoUsuario'])){
    $usuario=$_SESSION['usuario'];
    $tipoUsuario=$_SESSION['tipoUsuario'];
    if ($tipoUsuario=='cliente'){
        $categoriaCliente=$_SESSION['categoriaCliente'];}
    
    $login=TRUE;
} else{
    $tipoUsuario="noRegistrado";
    $login=FALSE;
    
}

?>
    <?php /* $ruta=__DIR__; 
        $ruta=str_replace("\\", "/", $ruta);
        echo "$ruta"; */
        if(empty($lugar)){
            $lugar="";
        }
        if($lugar=="admin" or $lugar=="duenoLocal" or $lugar=="cliente" or $lugar=="noRegistrado")
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
                <a href="<?php echo("$ruta");?>login.php" class="login-button ms-auto d-lg-none ">Iniciar sesión</a>
            <?php } ?>
            
            <?php } else{

                   if($tipoUsuario=="duenoLocal")
                        $mostrarUsuario="Dueño de local";
                    if($tipoUsuario=="cliente")
                        $mostrarUsuario=$_SESSION['nombre'];
                    if($tipoUsuario=="administrador")
                        $mostrarUsuario="Administrador";
                    if($lugar=='index' or $lugar=='perfil'){
                        $ruta3=""; }
                    else{
                        $ruta3="../";}
                    ?>
                    <a href='<?php echo $ruta3?>perfil.php' class='user-info ms-auto d-lg-none'><?php if($tipoUsuario=="cliente"){?><img src="<?php echo("$ruta"."assets/{$categoriaCliente}img.png"); ?>" style="max-width:30px; max-height:30px; margin-right:7px;" alt="categoría del cliente"><?php } echo $mostrarUsuario ?></a>
                    <?php
            } ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-lg-30 mx-auto px-auto  " >
                    <?php if($login==FALSE){
                        if($lugar=="index" or $lugar=="login" or $lugar=="registra"){
                        $ruta2="noRegistrado/";}else {
                        $ruta2="";}
                           
                    ?>
                    
                    <li class="nav-item ">
                        <a class="nav-link" aria-current="page" href="<?php echo $ruta2 ?>verLocales.php">Locales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $ruta2 ?>verDescuentos.php">Descuentos</a>
                    </li>

                    <?php } else{?>

                    <?php if($tipoUsuario=="duenoLocal"){?>
                        <?php if($lugar=="index" or $lugar=="perfil")
                                $ruta2="duenoLocales/";
                            else
                                $ruta2="";

                            ?>
                    <li class="nav-item ">
                        <a class="nav-link" aria-current="page" href="<?php echo $ruta2; ?>gestionDescuentos.php">Gestion de descuentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $ruta2; ?>verInformeDescuento.php">Informe descuentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $ruta2; ?>verSolicitudDescuentos.php">Solicitud descuentos</a>
                    </li>

                    <?php } if($tipoUsuario=="administrador"){?>
                    <?php if($lugar=="index" or $lugar=="perfil")
                                $ruta2="Admin/";
                            else
                                $ruta2="";

                            ?>

                    <li class="nav-item ">
                        <a class="nav-link" aria-current="page" href="<?php echo $ruta2; ?>informeDescuentos.php">Informe descuentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $ruta2; ?>gestionarDescuentos.php">Gestionar descuentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $ruta2; ?>gestionarNovedades.php">Gestionar novedades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $ruta2; ?>gestionarLocales.php">Gestionar locales</a>
                    </li>

                    <?php } if($tipoUsuario=="cliente"){?>
                        <?php if($lugar=="index" or $lugar=="perfil"){
                                $ruta2="Cliente/";
                                }
                            else
                                $ruta2="";

                            ?>

                    <li class="nav-item ">
                        <a class="nav-link" aria-current="page" href="<?php echo $ruta2; ?>verDescuentos.php">Descuentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $ruta2; ?>verDescuentosUtilizados.php">Descuentos utilizados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $ruta2; ?>verNovedades.php">Novedades</a>
                    </li>
                    <?php }}?>
                </ul>
                
                <?php if($login==TRUE){
                    if($lugar=='index' or $lugar=='perfil')
                        $ruta3=""; 
                    else
                        $ruta3="../";?>
                  
                    
                <a style="float:right; margin-right: 20px;" href='<?php echo $ruta3 ?>perfil.php' class='user-info ms-auto d-none d-lg-block'><?php if($tipoUsuario=="cliente"){?><img src="<?php echo("$ruta"."assets/{$categoriaCliente}img.png");?>" style="max-width:30px; max-height:30px; margin-right:7px;" alt="categoría del cliente"><?php } echo $mostrarUsuario ?></a>
                <?php } ?>
                <ul class="navbar-nav   <?php if($login==FALSE){ echo("d-none");} ?>">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cuenta
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <?php if ($lugar=="index" or $lugar=="perfil")
                                        $ruta2="";
                                    else 
                                        $ruta2="../";?>
                            <li><a class="dropdown-item" href="<?php echo $ruta2 ?>perfil.php">Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>

                            <li><a class="dropdown-item" href="<?php echo("$ruta2");?>logOut.php">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            
            <?php 
            
            if (!defined('HEADER_INCLUDED')) { ?> 
                <a href="<?php echo("$ruta");?>login.php" class="login-button ms-auto d-none d-lg-block   <?php if($login==TRUE){ echo("d-lg-none");} ?>">Iniciar sesión</a>
            <?php } ?> 
            
            
        </div>
    </nav>  
