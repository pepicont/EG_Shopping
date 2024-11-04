<?php
    $busqueda="";
    if(isset($_GET["filtrar"])){
        if(isset($_GET["codDes"]) && $_GET["codDes"] != ""){
            $busqueda .= "AND cod = '" . $_GET["codDes"] . "' ";
        }
        if($_GET["fechaDes"] != "" && isset($_GET["fechaDes"])){
            $busqueda .= "AND fechaDesde >= '".$_GET["fechaDes"]."' ";
        }   
        if($_GET["fechaHas"] != "" && isset($_GET["fechaHas"])){
            $busqueda .= "AND fechaHasta <= '".$_GET["fechaHas"]."' ";
        }
        if($_GET["categoria"] != "" && isset($_GET["categoria"]) && $_GET["categoria"] != "0"){
            $busqueda .= "AND categoriaCliente = '".$_GET["categoria"]."' ";
        }


    }








?>