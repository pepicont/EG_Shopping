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
    $imagen=$_FILES['imagen']['tmp_name'];//se usa la variable superglobal $_FILES para obtener el archivo ya que al ser un archivo no se puede obtener con $_POST
    //$_FILES['imagen'] accede a la información del archivo subido con el cambo de nombre imagen
    //$_FILES['imagen']['tmp_name'] obtiene la ruta temporal que le asignó el servidor al archivo subido
    $imagenSubida = addslashes(file_get_contents($imagen));
    //file_get_contents($imagen) obtiene el contenido del archivo subido, en este caso la imagen desde su ubicación temporal
    //addslashes() agrega barras invertidas a una cadena en los lugares que haya caracteres especiales
    //en este caso a la imagen para que no haya problemas al insertarla en la base de datos
    $query="INSERT INTO locales (nombreLocal,ubicacionLocal,rubroLocal,estado,imagen,codUsuario) VALUES ('".$_POST['nombreLocal']."','".$_POST['ubicacionLocal']."','".$_POST['rubroLocal']."','activo','$imagenSubida','".$_POST['codUsuario']."')";
    $resultado=consultaSQL($query);
    if($resultado){
        header("Location:gestionarLocales.php?success=creado");

    }
}



?>