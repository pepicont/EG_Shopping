<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paseo del literal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="estilos/style1.css" rel="stylesheet">

</head>
<header>
        <?php 
        $lugar="home";
        include("header.php");
        include_once("funciones.php");
        ?>
    </header>
    
<body>

<div id="carouselExampleCaptions" class="carousel slide" ><!-- Carrusel -->
    <div class="carousel-indicators" >
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="assets/imagenmain.png" class="d-block w-100" alt="foto de shopping 1" >
        </div>
            <div class="carousel-item">
            <img src="assets/foto2.jpg" class="d-block w-100" alt="foto de shopping 2">
        </div>
            <div class="carousel-item">
            <img src="assets/foto3.jpg" class="d-block w-100" alt="foto de shopping 3">
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

<div class="container mt-4 justify-content-center <?php if ($tipoUsuario!="administrador") echo"d-none";?>">
    <div class="row">
        <!-- Div donde van a ir las opciones del admin -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="row">
                <div class="col-12 col-md-6 m-2" >
                    <a href="Admin/informeDescuentos.php" class="btn btn-admin w-100" id="menuPrincipal">
                        Informe de descuentos
                    </a>
                </div>
                <div class="col-12 col-md-6 m-2">
                    <a href="Admin/gestionarDescuentos.php" class="btn btn-admin w-100" id="menuPrincipal">
                        Gestionar descuentos
                    </a>
                </div>
                <div class="col-12 col-md-6 m-2">
                    <a href="Admin/gestionarNovedades.php" class="btn btn-admin w-100" id="menuPrincipal">
                        Gestionar novedades
                    </a>
                </div>
                <div class="col-12 col-md-6 m-2">
                    <a href="Admin/gestionarLocales.php" class="btn btn-admin  w-100" id="menuPrincipal">
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
                                <div class="listado " style="justify-content:flex-end">
                                    <a href="Admin/ABMSolicitudes.php?idAprobar=<?php echo($usuario['codUsuario'])?>" class="card-link btn btn-primary">Aprobar</a>
                                    <a href="Admin/ABMSolicitudes.php?idRechazar=<?php echo($usuario['codUsuario'])?>" class="card-link btn btn-danger" >Rechazar</a>
                                </div>
                                
                            </div>
                        </div>
                        <?php
                        }}?>     
                
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Muestra las alertas cuando se acepta o se rechaza una solicitud -->
                    <?php if(!empty($_GET['success'])){
                            if($_GET['success']=='aprobada'){
                                echo '<div class="alert alert-primary mt-3" style="width:80vh" role="alert">
                                    Solicitud  aceptada
                                </div>';
                            } elseif($_GET['success']=='rechazada'){
                                echo '<div class="alert alert-danger mt-3" style="width:80vh" role="alert">
                                    Solicitud rechazada
                                </div>';
                            }
                        }
                    ?>
                    </div>

            </div>
        </div>
    </div>
</div>
<div class="container mt-4 justify-content-center <?php if ($tipoUsuario!="duenoLocal") echo"d-none";?>">
    <div class="row mb-3 justify-content-center">
        <div class="col-auto w-100">
            <a href="duenoLocales/gestionDescuentos.php" class="btn btn-login btn-primary w-100">
                Gestion de descuentos
            </a>
        </div>
    </div>
    <div class="row mb-3 justify-content-center">
        <div class="col-auto w-100">
            <a href="duenoLocales/verInformeDescuento.php" class="btn btn-primary w-100">
                Ver informe de descuentos.
            </a>
        </div>
    </div>
    <div class="row mb-3 justify-content-center">
        <div class="col-auto w-100">
            <a href="duenoLocales/verSolicitudDescuentos.php" class="btn btn-primary w-100">
                Ver solicitud de descuentos.
            </a>
        </div>
    </div>
</div>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
<footer>
    <?php 
      include("footer.php");
    ?> 
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>