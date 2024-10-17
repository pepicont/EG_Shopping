<?php 
session_start();
session_destroy();
session_unset();
setcookie('mantenerSesionIniciada', '', time() - (60 * 60 * 24 * 365));
setcookie('usuario', '', time() - (60 * 60 * 24 * 365));
setcookie('tipoUsuario', '', time() - (60 * 60 * 24 * 365));
setcookie('categoriaCliente', '', time() - (60 * 60 * 24 * 365));
header("Location: login.php");
exit();

?>