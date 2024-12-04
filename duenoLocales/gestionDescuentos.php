<?php include_once("../session.php"); ?>
<?php 
    $lugar = "duenoLocal";
    include_once("../funciones.php");
    actualizarDescuentos();
    $idusuario= $_SESSION["idUsuario"];
    if($_SESSION["tipoUsuario"] != "duenoLocal"){
        header("Location: ../index.php");
        exit();
    }
$estoy = "gestionDescuentos";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestionNovedades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilos/style1.css">
    <link rel="icon" href="../assets/favicon-32x32.png">
    <style>
        .modal-backdrop {
            z-index: 1040 !important;
            }
        .modal {
            z-index: 1050 !important;
        }
    </style>
</head>
<header>
    <?php
        include("../header.php");
    ?>
</header>
<body>
    <?php

    
    if(isset($_GET['seCreo'])){
        $seCreo = $_GET['seCreo'];
        if($seCreo == '1' ){
            echo'<div class="alert alert-primary alert-dismissible fade show mt-3 w-100 text-center mx-auto" style="max-width: 90%;" role="alert"> El descuento fue creado con éxito 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }elseif($seCreo == '2'){
            echo'<div class="alert alert-secondary alert-dismissible fade show mt-3 w-100 text-center mx-auto" style="max-width: 90%;" role="alert"> El descuento no se ha podido crear.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        } 
    }
        
    ?>
    <div class="row">
        <div class="col-12">
            <?php 
            include("../breadCrumbs.php");
            actualizarDescuentos();
            ?>
        </div>
    </div>
    <div class="row"> 
        <div class="col-lg-3 col-8 mx-auto bot-crear" > 
                <?php include("agregarDescuento.php"); ?>
        </div>
        <div class="col-lg-9 d-none"></div>
    </div>
    
    <div class="row">
        <div class="col-3 filtros d-none d-lg-block"  style="height:fit-content;" action="card.php">
            <br>
                <?php 
                    include("filtros.php"); 

                ?>
        </div>
        <div class="listado d-flex col-lg-8 col-12 mx-auto justify-content-center">
            <?php 
                $busqueda = "AND estadoPromo != 'eliminado'";
                include("validaciones.php");
                include("cards.php");
            ?>
        </div>
    </div>

<div class=" d-block d-lg-none"> <!-- Boton para abrir filtros en mobile el lg none genera conflicto  -->
    <button class="btn btn-primary fixed-bottom end-0 m-3 bot-filtros" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions" >FILTROS:</button>
    <div class="offcanvas offcanvas-start filtros-desplegados" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
                <?php 
                    include("filtros.php"); 
                ?>
        </div>
    </div>
</div>
</body>
<footer>
    <?php include("../footer.php"); ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>