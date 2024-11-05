<?php

$lugar = "duenoLocal";
include_once("../funciones.php");
    $cod = $_GET['cod'];
    $codPromo = $_GET['promo'];
    if($cod == '1'){
        $estado = "aceptada";
        echo("aceptada");
    }else{
        $estado= "rechazada";
    }
    $query = "UPDATE uso_promociones SET estado='".$estado."' WHERE codPromo='".$codPromo."'";
    $resultados = consultaSQL($query);
    exit(header("Location: verSolicitudDescuentos.php"));


?>