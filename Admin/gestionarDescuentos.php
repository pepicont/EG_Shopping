<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Descuentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../estilos/style1.css" rel="stylesheet">
</head>
<body>
    <?php
    $lugar="admin";
    include_once("../funciones.php");
    include("../header.php");
    if ($login==true && $tipoUsuario=="administrador"){
    ?>
    
    <div class="container mt-4">
        <div class="row ">
            <div class="col-3">
                <div class="filtros p-2" style="height: fit-content;">
                    <h3>Filtros:</h3>
                    <form method="GET" >
                        <hr>
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
                            Lunes: <input type="checkbox" name="dia[]" value="lunes"> <br>
                            Martes: <input type="checkbox" name="dia[]" value="martes"> <br>
                            Miércoles: <input type="checkbox" name="dia[]" value="miércoles"> <br>
                            Jueves: <input type="checkbox" name="dia[]" value="jueves"> <br>
                            Viernes: <input type="checkbox" name="dia[]" value="viernes"> <br>
                            Sábado: <input type="checkbox" name="dia[]" value="sábado"> <br>
                            Domingo: <input type="checkbox" name="dia[]" value="domingo"> <br>
                        </div>
                        <br> 
                        <div class="form-group text-center d-flex justify-content-between wrap">
                            <input type="submit" name="submit" value="Aplicar filtros" class="btn btn-primary">
                            <a href="gestionarDescuentos.php" class="btn btn-secondary " style="margin-left: 4px;">Restablecer</a>
                        </div>
                    </form>
                </div>
                        
            </div>
            
            <div class="col-9">
                    <div class="container ml-4">
                        <h3 style="margin-left: auto;">Descuentos pendientes</h3>
                        <div class="container listado">
                            <?php
                            $busqueda="";
                            include('../duenoLocales/Validaciones.php');
                            $query="SELECT * FROM promociones WHERE estadoPromo='pendiente' $busqueda";                            
                            $resultados=consultaSQL($query);
                            if(mysqli_num_rows($resultados)!=0){
                                while($fila=mysqli_fetch_array($resultados)){?>
                                        <div class='card' style='margin: 10px; width: 14em;'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>Código: <?php echo($fila['cod']); ?></h5>
                                                <h6 class='card-subtitle mb-2 text-muted'><?php echo($fila["categoriaCliente"]); ?></h6>
                                                <p class='card-text'><?php echo($fila["textoPromo"]); ?></p>
                                                <p>Desde: <?php echo($fila["fechaDesde"]); ?> </br>Hasta: <?php echo($fila["fechaHasta"]); ?></p>
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
                                                                    <a href='ABMDescuentos.php?codBaja=<?php echo($fila['cod']);?> class='btn btn-danger' style="color:white">Confirmar</a>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal cierre -->
                                            </div>
                                        </div>
                       <?php }
                       }else{
                        echo("No existen solicitudes de promoción");
                       }
                    
                        ?>
                    </div>
            </div>
            
            
        </div>
    </div>

    



    <?php
    }else{
        exit(header("Location: ../home.php"));
    }

     ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
    <footer>
        <?php include("../footer.php"); ?>
    </footer>
</html>