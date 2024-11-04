<?php
$lugar = "duenoLocal";
include_once("../funciones.php");
include("../header.php");
if($_SESSION["tipoUsuario"] != "duenoLocal"){
    header("Location: ../index.php");
    exit();
}
$idusuario= $_SESSION["idUsuario"];



?>