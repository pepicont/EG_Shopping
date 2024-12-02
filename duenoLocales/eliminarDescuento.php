<?php
if ($_SESSION["tipoUsuario"] != "duenoLocal") {
    header("Location: ../index.php");
}else{
$lugar = "duenoLocal";
include_once("../funciones.php");
    $cod = $_GET['cod'];
    $query = "UPDATE promociones SET estadoPromo='eliminado' WHERE cod='".$cod."'";
    $resultados = consultaSQL($query);
    exit(header("Location: gestionDescuentos.php"));
}
?>