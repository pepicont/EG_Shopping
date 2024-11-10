<?php 
include_once("../funciones.php");
if(!empty($_GET['codAlta'])){
    
    $query="UPDATE promociones SET estadoPromo='activa' WHERE cod='".$_GET['codAlta']."'";
    $resultados=consultaSQL($query);
    exit(header("Location:index.php?success=aceptado"));


}
if(!empty($_GET['codBaja'])){
    
    $query="UPDATE promociones SET estadoPromo='rechazada' WHERE cod='".$_GET['codBaja']."'";
    $resultados=consultaSQL($query);
    exit(header("Location:index.php?success=rechazado"));


}
?>