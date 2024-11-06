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
    <?php
    $idUsuario= $_SESSION["idUsuario"];
    $query = "SELECT * FROM locales WHERE codUsuario = '".$idUsuario."'";
    $vresultado = consultaSQL($query);
    
    ?>
    <div class="row">
        <div class="filtros col-3">
            <?php 
            $estoy = "verSolicitudDescuentos";
            include("filtros.php"); 
            $busqueda = "";
            include("validaciones.php") 
            ?>
        </div>
        <div class="listado col-8 d-flex flex-wrap justify-content-center mx-auto">
            <?php include("cards.php"); ?> 
        </div>
    </div>
</body>
<?php include_once("../footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>