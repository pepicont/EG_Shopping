<?php 
    $lugar = "duenoLocal";
    include_once("../funciones.php");
    include("../header.php");
    $idusuario= $_SESSION["idUsuario"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestionNovedades</title>
    <link rel="stylesheet" href="../estilos/style1.css">
</head>
<body>
    <div class="row ">
        <div class="col-3 filtros ">
            <h3>Filtros:  </h3>
            <form method="GET">
                <div class="form-group">
                    Codigo de promo: <input type="text" id="codDes" name="conDes" > <br>
                </div>
                <div class="form-group">
                    Fecha desde: <input type="date" id="fechaDes" name="fechaDes"> <br>
                </div>
                <div class="form-group">
                    Fecha hasta: <input type="date" id="fechaHas" name="fechaHas"> <br>
                </div>
                <div class="form-group">
                    </hr>
                    <label for="categoria">categoria de la promocion:</label>
                    <select name="categoria" id="categoria" class="form-control">
                        <option value="0">Selecciona una opcion:</option>
                        <option value="inicial">Inicial</option>
                        <option value="medium">Medium</option>
                        <option value="premium">Premium</option>
                    </select>
                </div>
                <div class="form-group ">
                    </hr>
                    Dia de la semana: <br>
                    Lunes: <input type="checkbox" name="dia[]" value="l"> <br>
                    Martes: <input type="checkbox" name="dia[]" value="m"> <br>
                    Miercoles: <input type="checkbox" name="dia[]" value="mi"> <br>
                    Jueves: <input type="checkbox" name="dia[]" value="j"> <br>
                    Viernes: <input type="checkbox" name="dia[]" value="v"> <br>
                    Sabado: <input type="checkbox" name="dia[]" value="s"> <br>
                    Domingo: <input type="checkbox" name="dia[]" value="d"> <br>
                </div>
                <div class="form-group mx-auto text-center w-100 p-2 d-flex justify-content-between">
                    <input type="submit" name="submit" value="Aplicar filtros" class="btn btn-primary w-100 m-1">
                    <a href="gestionDescuentos.php" class="btn btn-primary w-100 m-1">Borrar filtros</a>
                </div>
            </form>
        </div>
        <div class="listado  d-flex col-8 mx-auto ">
            <?php 
            $busqueda = ""; 
            if(isset($_GET["submit"])){   
                if($_GET["codDes"] != ""){
                    $busqueda = "AND cod = " . $_GET["codDes"] . " ";
                }

                if($_GET["fechaDes"] != ""){
                    $busqueda = "AND fechaDesde >= ".$_GET["fechaDes"]." ";
                }   
                if($_GET["fechaHas"] != ""){
                    $busqueda = "AND fechaHasta <= ".$_GET["fechaHas"]." ";
                }
            
            }
            $query = "SELECT * FROM locales WHERE codUsuario = $idusuario";
            $vresultado = consultaSQL($query);
            if (mysqli_num_rows($vresultado) > 0) {
                while ($fila = mysqli_fetch_array($vresultado)){
                    $codLocal = $fila["codLocal"];
                    $query2 = "SELECT * FROM promociones WHERE estadoPromo='activa' AND codLocal = $codLocal $busqueda"; 
                    $vresultado2 = consultaSQL($query2);
                if(mysqli_num_rows($vresultado2)>0){
                    while ($fila2 = mysqli_fetch_array($vresultado2)) { 
                        ?>
                        <div class="card " style=" margin: 15px; width: 18rem; ">
                            <div class="card-body">
                                <h5 class="card-title">Cod descuento: <?php echo($fila2["cod"]) ?></h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Descripcion: <?php echo($fila2["textoPromo"]) ?> </h6>
                                <p class="card-text">Categoria de caliente: <?php echo($fila2["categoriaCliente"]) ?> </p>
                                <p class="card-text">Del local: <?php echo ($fila["nombreLocal"]) ?> </p>
                                <!-- <p class="card-text">Dias de la semana <?php //echo($fila["dia de la semana"]) ?> </p> -->
                                <a href="eliminarDescuento.php?cod=<?php echo($fila2['cod']) ?>" class="btn btn-primary w-100 m-1">Eliminar descuento</a>
                            </div>
                        </div>
        
            <?php 
            }}}}else{ 
                echo("No hay promociones activas");} ?>
        </div>
    </div>
</body>
<?php

//include("../footer.php")?>
</html>

