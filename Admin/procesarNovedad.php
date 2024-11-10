<?php 
    include("../funciones.php");
    if(!empty($_GET['novedadEditada'])){

        $nombre=$_GET['nombreNovedad'];
        $tipo=$_GET["tipoUsuario"];
        $texto=$_GET['textoNovedad'];
        $cod=$_GET['cod'];

        $query="UPDATE novedades SET nombreNovedad='".$nombre."' ,tipoUsuario='".$tipo."' ,textoNovedad='".$texto."' WHERE cod='".$cod."'";
        $resultado=consultaSQL($query);

        header("Location: index.php");
        exit();
        
        
    
    }
    if(!empty($_GET['idEliminar'])){
        
        $query="UPDATE novedades SET estado='inactiva' WHERE cod='".$_GET['idEliminar']."'";
        $resultados=consultaSQL($query);
        exit(header("Location: index.php?success=3"));
        }
    if(!empty($_GET['nuevaNovedad'])){
        $nombre=$_GET['nombreNovedad'];
        $tipo=$_GET["tipoUsuario"];
        $texto=$_GET['textoNovedad'];
        $query="INSERT INTO novedades (nombreNovedad,tipoUsuario,textoNovedad,estado) VALUES ('".$nombre."','".$tipo."','".$texto."','activa')";
        $resultado=consultaSQL($query);
        exit(header("Location: index.php?success=1"));
    }
        
    
    
?>