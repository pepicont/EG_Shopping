<?php
if(isset($_GET["submit"])){   
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
?>