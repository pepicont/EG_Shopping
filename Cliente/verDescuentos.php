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
                            <input type="submit" name="filtrar" class="btn btn-primary px-4 py-2" value="filtrar">
                        </div>


                        </div>
                    </form>
                </div>
        </div>
        <div class="col-6">
            <div class="row">   
                <div class="col">
                <?php
                    $busqueda = "";
                    include('filtrosCli.php');
                    $query = "SELECT * FROM novedades WHERE estadoPromo='activa' $busqueda";
                    $resultados = consultaSQL($query);
                    if (mysqli_num_rows($resultados) != 0) {
                        while ($fila = mysqli_fetch_array($resultados)) { ?>
                            <div class='card' style='margin: 10px; width: 14em;'>
                                <div class='card-body'>
                                    <h5 class='card-title'>Código: <?php echo($fila['cod']); ?></h5>
                                    <h6 class='card-subtitle mb-2 text-muted'><?php echo($fila["tipoUsuario"]); ?></h6>
                                    <p class='card-text'><?php echo($fila["textoPromo"]); ?></p>
                                    <p>Desde: <?php echo($fila["fechaDesde"]); ?> </br>Hasta: <?php echo($fila["fechaHasta"]); ?></p>
                                    <p><?php echo($fila["diaSemana"]); ?></p>
                                    <?php
                                    $query2="SELECT * FROM locales WHERE codLocal=" . $fila['codLocal'];
                                    $resultados2=consultaSQL($query2);
                                    $fila=mysqli_fetch_array($resultados2);?>
                                    <p><?php echo($fila["diaSemana"]); ?></p>
                                    
                                    <a href='ABMDescuentos.php?codAlta=<?php echo($fila['cod']); ?>' class='btn btn-primary card-link'>Aceptar</a>
                                    <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal<?php echo $fila["cod"]; ?>'>Rechazar</button>
                                    <!-- Modal -->
                                    <div class='modal fade' id='deleteModal<?php echo $fila["cod"]; ?>' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog' role='document'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='exampleModalLabel'>¿Está seguro que desea borrar la promocion?</h5>
                                                    <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>
                                                <div class='modal-body'>
                                                    <h5 class='card-title'>Código de promoción: <?php echo $fila['cod'] ?></h5>
                                                    <p><?php echo $fila["textoPromo"]; ?></p>
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                                    <button type='button' class='btn btn-danger'>
                                                        <a href='ABMDescuentos.php?codBaja=<?php echo($fila['cod']); ?>' style="color: black; text-decoration: none;">Confirmar</a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal cierre -->
                                </div>
                            </div>
                        <?php }
                    }?>
               </div> 
            </div>
            
            
            <div class="row"></div>

        </div>


    </div>


</div>


</body>
</html>