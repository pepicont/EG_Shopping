<?php
$lugar = "duenoLocal";
    include_once("../funciones.php");
    include("../header.php");
    if($_SESSION["tipoUsuario"] != "duenoLocal"){
        header("Location: ../index.php");
        exit();
    }
    $idUsuario= $_SESSION["idUsuario"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verSolicitudDescuentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilos/style1.css">

</head>
<body>
    <div class="row">
        <div class="filtros col-3 d-none d-lg-block " style="height:fit-content;">
            <?php 
            $estoy = "informeDescuentos";
            include("filtros.php");   
            ?>
        </div>
    
        <div class="listado col-lg-8 col-12 d-flex flex-wrap justify-content-center mx-auto">
        <?php 
            $busqueda = ""; 
            include("cards.php");
        ?>
        </div>
    </div>
    <div class=" d-block d-lg-none">
    <button class="btn btn-primary fixed-bottom end-0 m-3 bot-filtros" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions" >FILTROS:</button>
    <div class="offcanvas offcanvas-start filtros-desplegados" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdrop with scrolling</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?php
                include("filtros.php");
            ?>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<?php include("../footer.php"); ?>
</html>