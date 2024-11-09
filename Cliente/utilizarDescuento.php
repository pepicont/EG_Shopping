<?php
session_start();    
include_once("../funciones.php");
$fecha = date('Y-m-d H:i:s');
$query = "INSERT INTO uso_promociones (codCliente, codPromo,fechaUsoPromo,estado) VALUES ('".$_GET['cod']."','".$_SESSION['idUsuario']."','".$fecha."', 'pendiente')";
consultaSQL($query);
exit(header("Location: verDescuentos2.php"));
?>