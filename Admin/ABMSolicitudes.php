<?php
include("funciones.php");
if(!empty($_GET['idAprobar'])){
    $id=$_GET['idAprobar'];
    $query="UPDATE usuarios SET estado='0' WHERE id='$id'";
    $resultado=consultaSQL($query);
    if($resultado){
        header("Location: ../home.php=success=aprobada");
    }


}
if(!empty($_GET['idRechazar'])){
    $id=$_GET['idRechazar'];
    $query="UPDATE usuarios SET estado='2' WHERE id='$id'";
    $resultado=consultaSQL($query);
    if($resultado){
        header("Location: ../home.php?success=rechazada");
    }
}
?>