<?php 
include("../funciones.php");
if(!empty($_GET['idEliminar'])){
    $query="UPDATE locales SET estado='inactivo' WHERE codLocal='".$_GET['idEliminar']."'";
    $resultado=consultaSQL($query);
    if($resultado){
        header("Location:index.php?success=eliminado");

    }
}
if(!empty($_POST['codLocal'])){
    $query="UPDATE locales SET nombreLocal='".$_POST['nombreLocal']."',ubicacionLocal='".$_POST['ubicacionLocal']."',rubroLocal='".$_POST['rubroLocal']."' WHERE codLocal='".$_POST['codLocal']."'";
    $resultado=consultaSQL($query);
    if($resultado){
        header("Location:index.php?success=editado");

    }
}
if(!empty($_POST['crearLocal'])){
    $query="INSERT INTO locales (nombreLocal,ubicacionLocal,rubroLocal,estado,imagen,codUsuario) VALUES ('".$_POST['nombreLocal']."','".$_POST['ubicacionLocal']."','".$_POST['rubroLocal']."','activo','".$_POST['imagen']."','".$_POST['codUsuario']."')";
    $resultado=consultaSQL($query);
    if($resultado){
        header("Location:gestionarLocales.php?success=creado");

    }
}



?>