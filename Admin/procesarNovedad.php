<?php 
   session_start();
   $tipoUsuario = $_SESSION['tipoUsuario'];
   if ($tipoUsuario=="administrador"){
    include("../funciones.php");
    if(!empty($_GET['novedadEditada'])){

        $nombre=$_GET['nombreNovedad'];
        $tipo=$_GET["tipoUsuario"];
        $texto=$_GET['textoNovedad'];
        $cod=$_GET['cod'];

        $query="UPDATE novedades SET nombreNovedad='".$nombre."' ,tipoUsuario='".$tipo."' ,textoNovedad='".$texto."' WHERE cod='".$cod."'";
        $resultado=consultaSQL($query);
        $pagina=$_GET['pagina'];
        header("Location: gestionarNovedades.php?success=2&pagina=$pagina");
        exit();
        
    
    }
    if(!empty($_GET['idEliminar'])){
        
        $query="UPDATE novedades SET estado='inactiva' WHERE cod='".$_GET['idEliminar']."'";
        $resultados=consultaSQL($query);
        exit(header("Location: gestionarNovedades.php?success=3"));
        }
    if(!empty($_GET['nuevaNovedad'])){
        $nombre=$_GET['nombreNovedad'];
        $tipo=$_GET["tipoUsuario"];
        $texto=$_GET['textoNovedad'];
        $fechaDesde=$_GET['fechaDesde'];
        $fechaHasta=$_GET['fechaHasta'];
        $query="INSERT INTO novedades (nombreNovedad,tipoUsuario,textoNovedad,estado,fechaDesde,fechaHasta) VALUES ('".$nombre."','".$tipo."','".$texto."','activa','".$fechaDesde."','".$fechaHasta."')";
        $resultado=consultaSQL($query);
        exit(header("Location: gestionarNovedades.php?success=1"));
    }
}else{
    header("Location:../index.php");
}
    
    
?>