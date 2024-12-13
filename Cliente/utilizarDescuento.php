<?php include_once("../session.php"); 
if( $_SESSION["tipoUsuario"] != "cliente"){
    header("Location: ../index.php");
    exit();
}
?>

<?php
include_once("../funciones.php");

    
$fecha = date('Y-m-d H:i:s');
$query = "INSERT INTO uso_promociones (codCliente, codPromo,fechaUsoPromo,estado) VALUES ('".$_SESSION['idUsuario']."','".$_GET['cod']."','".$fecha."', 'pendiente')";
consultaSQL($query);
exit(header("Location: verDescuentos.php?success=1"));
?>