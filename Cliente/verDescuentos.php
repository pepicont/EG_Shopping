<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Descuentos</title>
</head>
<body>

<?php
    $lugar = "Cliente";
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

                            <label name="rubros"for="rubros">Rubros: </label>
                            <select name="rubros" id="rubros">
                                <option value="">Selecciona un rubro</option>
                                <option value="tecnologia">Tecnología</option>
                                <option value="ropa">Ropa</option>
                                <option value="maquillaje">Maquillaje</option>
                                <option value="perfumeria">Perfumería</option>
                            </select>

                        </div>

                        <div class="form-group mx-4 p-2" style="width: fit-content">

                        <label name="rubros"for="rubros">Rubros: </label>
                        <select name="dia" id="dia">
                                <option value="">Selecciona un día:</option>
                                <option value="lunes">Lunes</option>
                                <option value="martes">Martes</option>
                                <option value="miércoles">Miércoles</option>
                                <option value="jueves">Jueves</option>
                                <option value="viernes">Viernes</option>
                                <option value="sabado">Sábado</option>
                                <option value="domingo">Domingo</option>
                        </select>

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