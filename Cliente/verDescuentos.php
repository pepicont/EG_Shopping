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
                $estoy = 'verDescuentos';
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
<?php include('../footer.php') ?>
</html>
