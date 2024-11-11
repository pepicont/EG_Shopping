<?php 
    //Variable $tipoUsuario tiene el usuario que esta usando la página actualmente.
    //Se va a utilizar para mostrar los enlaces de navegación correspondientes a cada tipo de usuario.

    ?>
    <nav aria-label="migas de pan">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a class="migasDePan" href="../index.php">PÁGINA PRINCIPAL</a></li>
<?php 
    //Hasta acá no cambia para todos los usuarios. Siempre van a poder volver
    if($tipoUsuario == "duenoLocal"){
        //Si el usuario es un cliente, dependiendo de que opción haya elegido se le va a mostrar el breadcrumb correspondiente
        switch($estoy) {
            case "gestionDescuentos":
                echo '<li class="breadcrumb-item active" active aria-current="Gestionar Descuentos"><a class="migasDePan" href="gestionDescuentos.php" >GESTION DE DESCUENTOS</a></li>';
            break;
            case "informeDescuentos":
                echo '<li class="breadcrumb-item active" active aria-current="Informe de Descuentos"><a class="migasDePan" href="verInformeDescuentos.php" >INFORME DE DESCUENTOS</a></li>';
            break;
            case "verSolicitudDescuentos":
                echo '<li class="breadcrumb-item active" active aria-current="ver solicitudes de descuentos"><a class="migasDePan" href="verSolicitudDescuentos.php" >SOLICITUDES DE DESCUENTOS</a></li>';
            break;
            default:
                //echo '<li class="breadcrumb-item active" aria-current="page">Inicio</li>';
            break;
        }
    } 
    if($tipoUsuario == "administrador"){
        //Si el usuario es un administrador, dependiendo de que opción haya elegido se le va a mostrar el breadcrumb correspondiente
        switch($estoy) {
            case "gestionarDescuentos":
                echo '<li class="breadcrumb-item active" active aria-current="Gestionar descuentos"><a class="migasDePan" href="gestionarDescuentos.php" >GESTIONAR DESCUENTOS</a></li>';
            break;
            case "gestionarLocales":
                echo '<li class="breadcrumb-item active" active aria-current="gestionar locales"><a class="migasDePan" href="gestionarLocales.php" >GESTIONAR LOCALES</a></li>';
            break;
            case "gestionarNovedades":
                echo '<li class="breadcrumb-item active" active aria-current="gestionar novedades"><a class="migasDePan" href="gestionarNovedades.php" >GESTIONAR NOVEDADES</a></li>';
            break;
            case "informeDescuentos":
                echo '<li class="breadcrumb-item active" active aria-current="informe de descuentos"><a class="migasDePan" href="informeDescuentos.php" >INFORME DE DESCUENTOS</a></li>';
            break;
            default:
                //echo '<li class="breadcrumb-item active" aria-current="page">Inicio</li>';
            break;
        }
    }
    if($tipoUsuario == "cliente"){
        //Si el usuario es un cliente, dependiendo de que opción haya elegido se le va a mostrar el breadcrumb correspondiente
        switch($estoy) {
            case "verDescuentos":
                echo '<li class="breadcrumb-item active" active aria-current="ver descuentos"><a class="migasDePan" href="verDescuentos.php" >DESCUENTOS</a></li>';
            break;
            case "verDescuentosUtilizados":
                echo '<li class="breadcrumb-item active" active aria-current="ver descuentos utilizados"><a class="migasDePan" href="verDescuentosUtilizados.php" >DESCUENTOS UTILIZADOS</a></li>';
            break;
            case "verNovedades":
                echo '<li class="breadcrumb-item active" active aria-current="ver novedades"><a class="migasDePan" href="verNovedades.php" >NOVEDADES</a></li>';
            break;
            default:
                //echo '<li class="breadcrumb-item active" aria-current="page">Inicio</li>';
            break;
        }
    }
    if($tipoUsuario == "noRegistrado"){
        //Si el usuario es un cliente, dependiendo de que opción haya elegido se le va a mostrar el breadcrumb correspondiente
        switch($estoy) {
            case "verDescuentos":
                echo '<li class="breadcrumb-item active" active aria-current="ver descuentos"><a class="migasDePan" href="verDescuentos.php" >DESCUENTOS</a></li>';
            break;
            case "verLocales":
                echo '<li class="breadcrumb-item active" active aria-current="ver locales"><a class="migasDePan" href="verLocales.php" >LOCALES</a></li>';
            default:
                //echo '<li class="breadcrumb-item active" aria-current="page">Inicio</li>';
            break;
        }
    } 
    if($estoy=="perfil"){
        echo '<li class="breadcrumb-item active" active aria-current="Perfil"><a class="migasDePan" href="perfil.php" >PERFIL</a></li>';
    }

    ?>
    </ol>
    </nav>

