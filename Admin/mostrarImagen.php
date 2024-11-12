<?php 
include("../funciones.php");
//Trae la imagen del local solicitado
$query="SELECT imagen FROM Locales WHERE codLocal='".$_GET['codLocal']."'";
$resultado=consultaSQL($query);
$fila=mysqli_fetch_array($resultado);
$imagen=$fila['imagen'];
//muestra la imagen.
//Esto se hace de esta manera porque es un script que se invoca desde un src de una imagen.
header("Content-Type: image/jpeg");
echo($imagen);
?>