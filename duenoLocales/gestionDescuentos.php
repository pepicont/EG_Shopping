<?php 
    $lugar = "duenoLocal";
    include_once("../funciones.php");
    include("../header.php");
    $idusuario= $_SESSION["idUsuario"];
    if($_SESSION["tipoUsuario"] != "duenoLocal"){
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestionNovedades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilos/style1.css">

</head>
<body>
    <div class="row ">
        <div class="col-3 filtros ">
            <h3>Filtros:  </h3>
            <form method="GET">
                <div class="form-group">
                    Codigo de promo: <input type="text" id="codDes" name="conDes" > </br> 
                    <hr>
                </div>
                <div class="form-group">
                    Fecha  desde:  <input type="date" id="fechaDes" name="fechaDes"> </br> </br>
                </div>
                <div class="form-group">
                    Fecha hasta: <input type="date" id="fechaHas" name="fechaHas"> <br> 
                    <hr>
                </div>
                <div class="form-group">
                    </hr>
                    <label for="categoria">Categoria de la promocion:</label>
                    </br> 
                    <select name="categoria" id="categoria" class="form-control">
                        <option value="0">Selecciona una opcion:</option>
                        <option value="inicial">Inicial</option>
                        <option value="medium">Medium</option>
                        <option value="premium">Premium</option>
                    </select>
                    <hr>
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
                <br> 
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
                                <button type="button" class="btn btn-primary w-100 m-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Eliminar descuento
                                </button>
                            </div>
                        </div>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Esta seguro que desea eliminar el descuento?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p> aca va toda la informacion de el descuento a eliminar </p>
                            </div>
                            <div class="modal-footer mx-auto text-center w-100 p-2 d-flex justify-content-between">
                                <a href="eliminarDescuento.php?cod=<?php echo($fila2['cod']) ?>" class="btn btn-primary  m-1">Eliminar descuento</a>
                                <button type="button" class="btn btn-secundary  m-1" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                            </div>
                        </div>
                        </div>
            <?php 
            }}}}else{ 
                echo("No hay promociones activas");} ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<?php

//include("../footer.php")?>
</html>

