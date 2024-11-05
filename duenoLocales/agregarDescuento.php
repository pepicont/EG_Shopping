<?php
session_start();
include_once("../funciones.php");
$idusuario= $_SESSION["idUsuario"];
$query1 = "SELECT * FROM usuarios WHERE codUsuario = '".$idusuario."'"; 
$vresultado1 = consultaSQL($query1);
    if(mysqli_num_rows($vresultado1)>0){
        $id=$_GET['id'];
        $text= $_GET["textpro"];
        $fechades = $_GET["fechaini"];
        $fechahas = $_GET["fechahas"]; 
        $categoria = $_GET["categoria"];
        if (isset($_GET['dia'])) {
          // Convertir el arreglo a una cadena separada por comas
          $diasSeleccionados = implode(",", $_GET['dia']);
        }
        $query2 = "SELECT * FROM locales WHERE codUsuario = '".$idusuario."' && codLocal = '".$id."' "; 
        $vresultado2 = consultaSQL($query2);
        if(mysqli_num_rows($vresultado2)>0){
            $query3 = "INSERT INTO promociones (textoPromo,fechaDesde,fechaHasta,categoriaCliente,diaSemana,estadoPromo,codLocal) VALUES 
            ('".$text."','".$fechades."','".$fechahas."','".$categoria."','".$diasSeleccionados."','pendiente','".$id."')";
            consultaSQL($query3) or die (mysqli_error($link));
            echo("Se ha ingresado correctamente el descuento");
        }else{
          echo("Ha ingresado mal el codigo del local");
        }
      }
  header("Location:gestionDescuentos.php");
  exit();
?>