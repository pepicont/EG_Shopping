<?php 
include("../funciones.php");
if(!empty($_GET['idEliminar'])){
    $query="UPDATE locales SET estado='inactivo' WHERE codLocal='".$_GET['idEliminar']."'";
    $resultado=consultaSQL($query);
    if($resultado){
        header("Location:gestionarLocales.php?success=eliminado");

    }
}
if(!empty($_POST['codLocal'])){
    $query="UPDATE locales SET nombreLocal='".$_POST['nombreLocal']."',ubicacionLocal='".$_POST['ubicacionLocal']."',rubroLocal='".$_POST['rubroLocal']."' WHERE codLocal='".$_POST['codLocal']."'";
    $resultado=consultaSQL($query);
    if($resultado){
        header("Location:gestionarLocales.php?success=editado");

    }
}
if(!empty($_POST['crearLocal'])){
    $imagen=$_FILES['imagenLocal']['tmp_name'];//se usa la variable superglobal $_FILES para obtener el archivo ya que al ser un archivo no se puede obtener con $_POST
    //$_FILES['imagen'] accede a la información del archivo subido con el cambo de nombre imagen
    //$_FILES['imagen']['tmp_name'] obtiene la ruta temporal que le asignó el servidor al archivo subido
    $nombreImagen=$_FILES['imagenLocal']['name'];//se obtiene el nombre del archivo subido
    $tipoImagen=strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));//se obtiene la extensión del archivo subido
    $sizeImagen=$_FILES['imagenLocal']['size'];//se obtiene el tamaño del archivo subido
    $directorio="../assets/"; //directorio donde se guardará la imagen

    //Busco que el codigo del dueño de local coincida con un dueño que este habilitado

    $query="SELECT * FROM usuarios WHERE codUsuario='".$_POST['codUsuario']."' AND estado='activo'";
    $resultado=consultaSQL($query);
    if (mysqli_num_rows($resultado)==0) {
        header("Location:gestionarLocales.php?error=usuario");
        exit;
    }else{

    if ($tipoImagen=="jpg" or $tipoImagen=="jpeg" or $tipoImagen=="png") {//se valida que el archivo subido sea una imagen
        $rubro=trim($_POST['rubroLocal']);
        $rubro=strtolower($rubro);
        $query="INSERT INTO locales (nombreLocal,ubicacionLocal,rubroLocal,estado,codUsuario) VALUES ('".$_POST['nombreLocal']."','".$_POST['ubicacionLocal']."','".$rubro."','activo','".$_POST['codUsuario']."')";
        $resultado=consultaSQL($query);
        //Se crea el local pero no se espcifica la ruta de la imagen para tener el id incremental asignado por la base
        $query="SELECT codLocal FROM locales WHERE nombreLocal='".$_POST['nombreLocal']."' AND ubicacionLocal='".$_POST['ubicacionLocal']."' AND rubroLocal='".$_POST['rubroLocal']."' AND codUsuario='".$_POST['codUsuario']."'";
        //Me traigo el codigo del local que acabo de cargar para que la imagen tenga un identificador único
        $resultado=consultaSQL($query);
        $resultado=mysqli_fetch_array($resultado);
        $codigolocal=$resultado['codLocal'];
        $ruta=$directorio.$codigolocal.".".$tipoImagen;

        $query="UPDATE locales SET imagen='$ruta' WHERE codLocal='$codigolocal'";
        $resultado=consultaSQL($query);

        //ahora almaceno la imagen localmente
        if (move_uploaded_file($imagen, $ruta)) {//se mueve la imagen de la ruta temporal a la ruta definitiva
            header("Location:gestionarLocales.php?success=creado");

        }
    } } 
   
    //Se crea el local para tener el id incremental asignado por la base
    if($resultado){
        header("Location:gestionarLocales.php?success=creado");

    }
}



?>