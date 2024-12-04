<?php
if ($_SESSION["tipoUsuario"] != "duenoLocal") {
    header("Location: ../index.php");
    exit();
  }
$lugar = "duenoLocal";
include_once("../funciones.php");
    $cod = $_GET['cod'];
    $codPromo = $_GET['promo'];
    $codCli = $_GET['codCli'];
    if($cod == '1'){
        $estado = "aceptada";

    }else{
        $estado= "rechazada";
    }
    $query = "UPDATE uso_promociones SET estado='".$estado."' WHERE codPromo='".$codPromo."'";
    $resultados = consultaSQL($query);
    
    $query = "SELECT * FROM uso_promociones WHERE codCliente='".$codCli."'";
    $resultados = consultaSQL($query);
    $cant = mysqli_num_rows($resultados);
    $cantAceptadas = 0;
    while($fila = mysqli_fetch_array($resultados)){
        if($fila['estado'] == 'aceptada'){
            $cantAceptadas++;
        } 
    }
    if($cantAceptadas > 3){
        $query = "UPDATE usuarios SET categoriaCliente = 'medium' WHERE codUsuario='".$codCli."'";
        $resultados = consultaSQL($query);
    }
    if($cantAceptadas > 5){
        $query = "UPDATE usuarios SET categoriaCliente = 'premium' WHERE codUsuario='".$codCli."'";
        $resultados = consultaSQL($query);
    }   
    exit(header("Location: verSolicitudDescuentos.php"));
    
?>