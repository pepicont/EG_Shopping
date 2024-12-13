<?php
include_once("../session.php");
if ($_SESSION["tipoUsuario"] != "duenoLocal") {
    header("Location: ../index.php");
    exit();
  }
$lugar = "duenoLocal";
include_once("../funciones.php");
    $cod = $_GET['cod'];
    $codPromo = $_GET['promo'];
    $codCli = $_GET['codCli'];
    if($cod == '1'){
        $estado = "aceptada";

    }else{
        $estado= "rechazada";
    }
    $query = "UPDATE uso_promociones SET estado='".$estado."' WHERE codPromo='".$codPromo."'";
    $resultados = consultaSQL($query);
    
    exit(header("Location: verSolicitudDescuentos.php"));
    
?>