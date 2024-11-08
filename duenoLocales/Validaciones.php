<?php
if(isset($_GET["submit"])){  
    $busqueda = ""; 
    if(isset($_GET["codDes"]) && $_GET["codDes"] != ""){
        $busqueda .= "AND cod = '" . $_GET["codDes"] . "' ";
    }
    if(isset($_GET["fechaDes"]) && $_GET["fechaDes"] != ""){
        $busqueda .= "AND fechaDesde >= '".$_GET["fechaDes"]."' ";
    }   
    if(isset($_GET["fechaHas"]) && $_GET["fechaHas"] != ""){
        $busqueda .= "AND fechaHasta <= '".$_GET["fechaHas"]."' ";
    }
    if(isset($_GET['categoria']) && $_GET['categoria'] != "0"){
        $busqueda .= "AND categoriaCliente = '" . $_GET["categoria"] . "' ";
            
    }
    if(isset($_GET['dia'])){
        $diasSeleccionados = "";
        $numDias = count($_GET['dia']);
        for($i = 0; $i < $numDias; $i++){
            if($i == 0){
                $busqueda .= "AND ";
            }else{
                $busqueda .= "OR ";
            }
            $busqueda .= "diaSemana LIKE '%" . $_GET['dia'][$i] . "%'  ";
        }
    }
}
if(!empty($_GET['filtrar'])){
    $busqueda = "";
    if(!empty($_GET["codigoLocal"])){
        $busqueda .= "AND codLocal = '" . $_GET["codigoLocal"] . "' ";
    }
    if(!empty($_GET["nombreLocal"])){
        $busqueda .= "AND nombreLocal LIKE '%".$_GET["nombreLocal"]."%' ";
    }   
    if(!empty($_GET["ubicacionLocal"])){
        $busqueda .= "AND ubicacionLocal LIKE '%".$_GET["ubicacionLocal"]."%' ";
    }
    if(!empty($_GET['rubros'])){
        $rubrosSeleccionados = "";
        $rubrosSeleccionados = count($_GET['rubros']);
        for($i = 0; $i < $rubrosSeleccionados; $i++){
            if($i == 0){
                $busqueda .= "AND ";
            }else{
                $busqueda .= "OR ";
            }
            $busqueda .= "rubroLocal LIKE '%" . $_GET['rubros'][$i] . "%'  ";
        }
    }
}
    


?>