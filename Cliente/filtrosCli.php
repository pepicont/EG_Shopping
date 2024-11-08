<?php
    if(isset($_GET["filtrar"])){
       
        if(isset($_GET['rubros'])){
            $rubrosSelec = "";
            $cantRubros = count($_GET['rubros']);
            for($t = 0; $t < $numDias; $t++){
                if($t == 0){
                    $busqueda .= "AND ";
                }else{
                    $busqueda .= "OR ";
                }
                $busqueda .= "diaSemana LIKE '%" . $_GET['rubros'][$t] . "%'  ";
            }
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

    $query= "SELECT * FROM tabla where estado='activa' ".$busqueda."";
    $rta=consultaSQL($query);
    







?>