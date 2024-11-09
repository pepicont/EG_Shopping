<?php 
    $lugar = "duenoLocal";
    include_once("../funciones.php");
    include("../header.php");
    $idusuario= $_SESSION["idUsuario"];
    if($_SESSION["tipoUsuario"] != "cliente"){
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilos/style1.css">
</head>
<body>
    <div class="row">
        <h1></h1>
        <div class="col-3 filtros d-none d-lg-block"  style="height:fit-content;" >
            <?php include("filtrosCli.php"); ?>
        </div>
        <div class="listado d-flex col-lg-8 col-12 mx-auto justify-content-center">
            <?php 
            $estoy = 'verDescuentosUtilizados';
            include("cardsdes.php"); ?>
        </div>
    </div>
    <div class=" d-block d-lg-none"> 
    <button class="btn btn-primary fixed-bottom end-0 m-3 bot-filtros" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions" >FILTROS:</button>
    <div class="offcanvas offcanvas-start filtros-desplegados" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
                <?php 
                    include("filtrosCLi.php"); 
                ?>
        </div>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
