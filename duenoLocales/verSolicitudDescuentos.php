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
    $lugar = "duenoLocal";
    include_once("../funciones.php");
    include("../header.php");
    if($_SESSION["tipoUsuario"] != "duenoLocal"){
        header("Location: ../index.php");
        exit();
    }
    $idUsuario= $_SESSION["idUsuario"];
    $query = "SELECT * FROM locales WHERE codUsuario = '".$idUsuario."'";
    $vresultado = consultaSQL($query);
    if (mysqli_num_rows($vresultado) > 0) {
        while ($fila = mysqli_fetch_array($vresultado)){
            $codLocal= $fila["codLocal"];
            $query2 = "SELECT * FROM promociones WHERE codLocal = '".$codLocal."'";
            $vresultado2 = consultaSQL($query2);
            if(mysqli_num_rows($vresultado) > 0){
                while($fila2 = mysqli_fetch_array($vresultado2)){
                    $codPromo = $fila2["cod"];
                    $query3 = "SELECT * FROM uso_promociones WHERE codPromo = '".$codPromo."' AND estado = 'pendiente'";
                    $vresultado3 = consultaSQL($query2);
                    if(mysqli_num_rows($vresultado3) > 0){
                        while($fila2 = mysqli_fetch_array($vresultado3)){
                        ?>
                            <div class="card " style=" margin: 15px; width: 18rem; ">
                                <div class="card-body">
                                    <h5 class="card-title">Codigo Promo: <?php echo($codPromo); ?></h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Descripcion: <?php echo($fila2["textoPromo"]); ?> </h6>
                                    <p class="card-text">Categoria de caliente: <?php echo($fila2["categoriaCliente"]); ?> </p>
                                    <p class="card-text">Del local: <?php echo ($fila["nombreLocal"]); ?> </p>
                                    <p class="card-text">Dias de la semana <?php echo($fila2["diaSemana"]); ?> </p> 
                                    <a href="cambiarEstadoPromo.php?cod=<?php echo("1");?>&promo=<?php echo("".$codPromo."")?>" class="btn btn-primary  m-1">Aceptar solicitud</a>
                                    <a href="cambiarEstadoPromo.php?cod=<?php echo("2"); ?>&promo=<?php echo("".$codPromo."")?>" class="btn btn-primary  m-1">Denegar solicitud</a>
                                    <button type="button" class="btn btn-secundary  m-1" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        <?php
                        }
                    }else{
                        echo("<h3> No hay desceuntos en estado de pendiente para tus locales </h3>");  
                    }
                }   
            }
        }
    }


    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>