<?php
include_once("conexion.php");
include_once("funciones.php");
$query1 = "SELECT * FROM locales WHERE nombreUsuario='".$_SESSION['nombreUsuario']."'"; // aca lo que tengo que hacer es validar primero que el local le pertenezca y dsp agragarlo
$query = "INSERT INTO promociones (nombreUsuario,claveUsuario,categoriaCliente,tipoUsuario,nombre,apellido,fechaNacimiento,estado) values ('$email','$contrasenaEncriptada', '$categoriaCliente', '$tipoUsuario', '$nombre','$apellido','$fechaNacimiento','$estado')";
  consultaSQL($query) or die (mysqli_error($link));
  echo("Usuario registrado con éxito");
    
?>