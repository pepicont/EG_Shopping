<?php 
session_start();
$tipoUsuario = $_SESSION['tipoUsuario'];
if ($tipoUsuario=="administrador"){
include_once("../funciones.php");
if(!empty($_GET['codAlta'])){
    
    $query="UPDATE promociones SET estadoPromo='activa' WHERE cod='".$_GET['codAlta']."'";
    $resultados=consultaSQL($query);
    exit(header("Location:gestionarDescuentos.php?success=aceptado"));
}
if(!empty($_GET['codBaja'])){
    $query="UPDATE promociones SET estadoPromo='rechazada' WHERE cod='".$_GET['codBaja']."'";
    $resultados=consultaSQL($query);
    exit(header("Location:gestionarDescuentos.php?success=rechazado"));
}}else{
    header("Location: ../index.php");
}
?>