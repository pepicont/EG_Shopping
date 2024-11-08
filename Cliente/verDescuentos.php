<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Descuentos</title>
</head>
<body>

<?php
    $lugar = "cliente";
    include_once("../funciones.php");
    include("../header.php");
    if($_SESSION["tipoUsuario"] != "cliente"){
        header("Location: ../index.php");
        exit();
    }
    $idusuario= $_SESSION["idUsuario"];
?>

<div class="container mt-4">
    <div class="row w-100" style="display:flex; justify-content: space-around">
        <div class="col-4">
            <div class="row">
                <h3>Filtros:</h3> </br>
                    <form action="filtrosCli.php" method="GET">
                        <div class="form-group mx-4 p-2" style="width: fit-content">

                            Rubros: <br>
                            Ropa: <input type="checkbox" name="rubros[]" value="ropa"> <br>
                            Maquillaje: <input type="checkbox" name="rubros[]" value="maquillaje"> <br>
                            Calzado: <input type="checkbox" name="rubros[]" value="calzado"> <br>
                            Perfumería: <input type="checkbox" name="rubros[]" value="perfumeria"> <br>

                        </div>

                        <div class="form-group mx-4 p-2" style="width: fit-content">



                        <div class="form-group ">
                        
                            <label name="rubros"for="rubros">Rubros: </label>
                            </hr>
                            Dia de la semana: <br>
                            Lunes: <input type="checkbox" name="dia[]" value="l"> <br>
                            Martes: <input type="checkbox" name="dia[]" value="m"> <br>
                            Miércoles: <input type="checkbox" name="dia[]" value="mi"> <br>
                            Jueves: <input type="checkbox" name="dia[]" value="j"> <br>
                            Viernes: <input type="checkbox" name="dia[]" value="v"> <br>
                            Sábado: <input type="checkbox" name="dia[]" value="s"> <br>
                            Domingo: <input type="checkbox" name="dia[]" value="d"> <br>

                        </div>
                        <br> 

                        <div class="form-group mx-auto mx-4 p-2" style="width: fit-content">
                            <input type="submit" name="nuevaNovedad" class="btn btn-primary px-4 py-2" value="filtrar">
                        </div>


                        </div>
                    </form>
                </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col">
                
                </div>
            </div>
            <div class="row"></div>

        </div>


    </div>


</div>


</body>
</html>