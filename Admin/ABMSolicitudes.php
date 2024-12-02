<?php
if ($login==true && $tipoUsuario=="administrador"){
include("../funciones.php");
if(!empty($_GET['idAprobar'])){
    $id=$_GET['idAprobar'];
    $query="UPDATE usuarios SET estado='0' WHERE codUsuario='$id'";
    $resultado=consultaSQL($query);
    if($resultado){
        header("Location: ../index.php?success=aprobada");
        exit();
    }


}
if(!empty($_GET['idRechazar'])){
    $id=$_GET['idRechazar'];
    $query="UPDATE usuarios SET estado='2' WHERE codUsuario='$id'";
    $resultado=consultaSQL($query);
    if($resultado){
        header("Location: ../index.php?success=rechazada");
        exit();
    }
}}else{
    header("Location: ../index.php");
    exit();
}
?>