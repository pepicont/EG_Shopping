<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shopping webpage">
    <meta name="keywords" content="HTML,CSS,PHP">
    <title>Mundo Shopping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="estilos/style1.css" rel="stylesheet">

</head>
<header>
        <?php 
        $lugar="index";
        include("header.php");
        include_once("funciones.php");
        ?>
</header>
    
<body>
<div class="row" style="display:flex; justify-content:center">
    <div id="carouselExampleCaptions" class="carousel slide"> <!-- Carrusel -->
        <div class="carousel-indicators" >
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 50vh;">
                <img src="assets/carr1.jpg" class="d-block w-100" style="height: 100%; object-fit: cover;" alt="foto de shopping 1">
            </div>
            <div class="carousel-item" style="height: 50vh;">
                <img src="assets/carr2.jpg" class="d-block w-100" style="height: 100%; object-fit: cover;" alt="foto de shopping 2">
            </div>
            <div class="carousel-item" style="height: 50vh;">
                <img src="assets/carr3.jpg" class="d-block w-100" style="height: 100%; object-fit: cover;" alt="foto de shopping 3">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<div class="container mt-4 justify-content-center <?php if ($tipoUsuario!="administrador") echo"d-none";?>">
    <div class="row">
        <div class="col-12">
            <!-- Muestra las alertas cuando se acepta o se rechaza una solicitud -->
            <?php if(!empty($_GET['success'])){
                    if($_GET['success']=='aprobada'){
                        echo '<div class="alert alert-primary mt-3 mx-auto"  role="alert">
                            Solicitud  aceptada
                            <button type="button" class="btn-close me-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    } elseif($_GET['success']=='rechazada'){
                        echo '<div class="alert alert-danger mt-3 mx-auto"  role="alert">
                            Solicitud rechazada
                            <button type="button" class="btn-close me-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                }
            ?>
        </div>

    </div>
    <div class="row">
        <!-- Div donde van a ir las opciones del admin -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="row">
                <div class="col-12 col-md-6 m-2" >
                    <a href="Admin/informeDescuentos.php" class="btn btn-admin btn-lg w-100" id="menuPrincipal">
                        Informe de descuentos
                    </a>
                </div>
                <div class="col-12 col-md-6 m-2">
                    <a href="Admin/gestionarDescuentos.php" class="btn btn-admin btn-lg w-100" id="menuPrincipal">
                        Gestionar descuentos
                    </a>
                </div>
                <div class="col-12 col-md-6 m-2">
                    <a href="Admin/gestionarNovedades.php" class="btn btn-admin btn-lg w-100" id="menuPrincipal">
                        Gestionar novedades
                    </a>
                </div>
                <div class="col-12 col-md-6 m-2">
                    <a href="Admin/gestionarLocales.php" class="btn btn-admin  btn-lg w-100 h-100" id="menuPrincipal">
                        Gestionar locales
                    </a>
                </div>
            </div>
        </div>
        <!-- Div donde van a ir las solicitudes de dueños de local -->
        <div class="col-12 col-md-6 col-lg-8">
            <div class="row text-center">
                <div class="col-12">
                    <h3 class="titulo">Solicitudes de dueños de local</h3>
                </div>
            </div>
            <div class="row">
            
                <div class="col-12">
                    
                    <?php
                        $sql="SELECT * FROM usuarios WHERE estado='1' AND tipoUsuario='duenoLocal'";
                        $resultado=consultaSQL($sql);
                        if(mysqli_num_rows($resultado)==0){
                            echo("No hay solicitudes de dueños de locales");
                        }else{
                        while($usuario=mysqli_fetch_array($resultado)){ 
                    ?>
                        <!-- Tarjetas de solicitud de dueño de local para crearse una cuenta -->
                        <div class="card" style=" margin: 10px; width:max ">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo($usuario['nombre']." ".$usuario['apellido']) ?></h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Código: <?php echo($usuario["codUsuario"]) ?> </h6>
                                <p class="card-text">Fecha de nacimiento: <?php echo($usuario['fechaNacimiento']) ?> </p>
                                <div class="listado " style="justify-content:flex-end; margin-bottom:0">
                                    <a href="Admin/ABMSolicitudes.php?idAprobar=<?php echo($usuario['codUsuario'])?>" class="card-link btn btn-primary">Aprobar</a>
                                    <a href="Admin/ABMSolicitudes.php?idRechazar=<?php echo($usuario['codUsuario'])?>" class="card-link btn btn-danger" >Rechazar</a>
                                </div>
                                
                            </div>
                        </div>
                        <?php
                        }}?>     
                
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="container mt-4 justify-content-center <?php if ($tipoUsuario!="duenoLocal") echo"d-none";?>">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-4 d-flex flex-column justify-content-center">
            <div class="w-100">
                <div class="container mb-3">
                    <a href="duenoLocales/gestionDescuentos.php" class="btn btn-login btn-primary w-100 btn-lg">
                        Gestion de descuentos
                    </a>
                </div>
                <div class="container mb-3">
                    <a href="duenoLocales/verInformeDescuento.php" class="btn btn-login btn-primary w-100 btn-lg">
                        Ver informe de descuentos
                    </a>
                </div>
                <div class="container mb-3">
                    <a href="duenoLocales/verSolicitudDescuentos.php" class="btn btn-login btn-primary w-100 btn-lg">
                        Ver solicitud de descuentos
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container mt-4 justify-content-center <?php if ($tipoUsuario!="cliente") echo"d-none";?>">
    <div class="row mb-3 ">
        <div class="col-auto d-flex flex-column justify-content-center align-items-md-center align-items-start ">
            <h1 class="bienvenida text-center">Bienvenido a Mundo Shopping</h1>
            <div class="w-80 w-md-50 texto mx-3">
                <p class="" style="text-indent: 30px; font-weight:500; font-size:20px;">Descubre un lugar donde el lujo, la exclusividad y el diseño se encuentran para ofrecerte una experiencia de compras sin igual. 
                    En <b style="color:rgb(235, 103, 235); ">Mundo shopping</b>, redefinimos el significado de estilo y sofisticación, reuniendo 
                    las marcas de moda más prestigiosas del mundo, productos únicos y servicios excepcionales</p>
            </div>
            <div class="w-80 w-md-50 texto mx-3">
                <h2 class="bienvenida text-center">Te esperamos</h2>
                <p class="" style="text-indent: 30px; font-weight:500;font-size:20px;">Nos encontramos en el corazón de <b style="color:rgb(235, 103, 235)";>Rosario</b>, 
                listos para darte la bienvenida a un mundo donde el buen gusto y la exclusividad son nuestra esencia. Explora, descubre, déjate inspirar.</p>
            </div>
            
        </div>
    </div>
    <div class="row mb-3 justify-content-center" style="display: flex; flex-wrap: wrap;">
        <?php include ("Cliente/descMasutilizados.php")?>
        
        <div class="col-auto d-flex flex-column justify-content-center">
            <div class="container mb-3">
            <a href="Cliente/verDescuentos.php" class="btn btn-login btn-primary w-100 btn-lg">
                Ver descuentos
            </a>
            </div>
            <div class="container mb-3">
            <a href="Cliente/verDescuentosUtilizados.php" class="btn btn-primary w-100 btn-lg">
                Ver descuentos utilizados
            </a>
            </div>
            <div class="container mb-3">
            <a href="Cliente/verNovedades.php" class="btn btn-primary w-100 btn-lg">
                Ver novedades
            </a>
            </div>
            <div class="container mb-3">
            <a href="Cliente/verLocales.php" class="btn btn-primary w-100 btn-lg">
                Ver locales
            </a>
            </div>
        </div>
        
        
    </div>
    
</div>

<div class="container mt-4 justify-content-center <?php if ($login==TRUE){ echo"d-none";}?>">
    <div class="row mb-3 ">
        <div class="col-auto d-flex flex-column justify-content-center align-items-md-center align-items-start ">
            <h1 class="bienvenida text-center">Bienvenido a Mundo Shopping</h1>
            <div class="w-80 w-md-50 texto mx-3">
                <p class="" style="text-indent: 30px; font-weight:500; font-size:20px;">Descubre un lugar donde el lujo, la exclusividad y el diseño se encuentran para ofrecerte una experiencia de compras sin igual. 
                    En <b style="color:rgb(235, 103, 235); ">Mundo shopping</b>, redefinimos el significado de estilo y sofisticación, reuniendo 
                    las marcas de moda más prestigiosas del mundo, productos únicos y servicios excepcionales</p>
            </div>
            <div class="w-80 w-md-50 texto mx-3">
                <h2 class="bienvenida text-center">Te esperamos</h2>
                <p class="" style="text-indent: 30px; font-weight:500;font-size:20px;">Nos encontramos en el corazón de <b style="color:rgb(235, 103, 235)";>Rosario</b>, 
                listos para darte la bienvenida a un mundo donde el buen gusto y la exclusividad son nuestra esencia. Explora, descubre, déjate inspirar.</p>
            </div>
            
        </div>
    </div>
    <div class="row mb-3 justify-content-center">
    <div class="col-auto d-flex flex-column justify-content-center">
            <div class="container mb-4">
            <a href="noRegistrado/verLocales.php" class="btn btn-primary w-100 btn-lg">
                Ver locales
            </a>
            </div>
            <div class="container mb-4">
            <a href="noRegistrado/verDescuentos.php" class="btn btn-primary w-100 btn-lg">
            Ver descuentos
            </a>
            </div>
        </div>
    </div>
</div>
<footer>
    <?php 
        include("footer.php");
    ?> 
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>