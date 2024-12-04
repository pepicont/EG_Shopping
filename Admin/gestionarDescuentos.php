<?php include_once("../session.php"); ?>
<?php 
    include_once("../funciones.php");
    actualizarDescuentos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Descuentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../estilos/style1.css" rel="stylesheet">
    <link rel="icon" href="../assets/favicon-32x32.png">

</head>
    <header>
    <?php 
    $lugar="admin";
    include("../header.php");
    if ($login==true && $tipoUsuario=="administrador"){
        $estoy="gestionarDescuentos";
    ?>
    </header>
<body>

    
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <?php 
                include("../breadCrumbs.php");
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php
                if(!empty($_GET['success'])){
                        if($_GET['success']=='aceptado'){
                            echo '<div class="alert alert-success mt-3 mx-auto" style="width: fit-content" role="alert">
                                Descuento aceptado
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        } elseif($_GET['success']=='rechazado'){
                            echo '<div class="alert alert-danger mt-3 mx-auto" style="width: fit-content" role="alert">
                            Descuento rechazado
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        
                    }}
                    ?>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="filtros d-md-block d-flex justify-content-center" style="height: fit-content;">
                    
                    <form method="GET" >
                        <div class="form-group p-2">
                        
                            Fecha  desde:  <input type="date" class="form-control" id="fechaDes" name="fechaDes" min="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="form-group p-2">
                            Fecha hasta: <input type="date" class="form-control" id="fechaHas" name="fechaHas"> <br> 
                            
                        </div>
                        <div class="form-group p-2">
                            
                            <label for="categoria">Categoria de la promocion:</label>
                            </br> 
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="0">Selecciona una opcion:</option>
                                <option value="inicial">Inicial</option>
                                <option value="medium">Medium</option>
                                <option value="premium">Premium</option>
                            </select>
                            
                        </div>
                        <div class="form-group p-2 ">
                            
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
                        <div class="form-group d-flex justify-content-center flex-lg-nowrap flex-wrap p-1">
                            <input type="submit" name="submit" value="Aplicar filtros" class="btn btn-primary ">
                            <input type="reset" value="Restablecer" class="btn btn-secondary ">
                        </div>
                    </form>
                </div>
                        
            </div>
            
            <div class="col-12 col-md-8 col-lg-9 text-center">
                <div class="row">
                    <div class="container ml-4">
                        <h3 style="margin-left: auto;">Descuentos pendientes</h3>
                        <div class="container listado">
                            <?php
                            // Logica de la paginación
                            $limite = 6; // cantidad de resultados que se muestran en la página
                            if (isset($_GET["pagina"])) {
                                $pagina  = $_GET["pagina"];
                            } else {
                                $pagina = 1;
                            }
                            $principio = ($pagina - 1) * $limite; // el número del primer resultado que se mostrará en la página actual. Esto va a ir cambiando a medida que se avance de página

                              //Lo que hace el Limit es que solo muestra los resultados que estan entre el principio y el limite
                            $busqueda="";
                            include('../duenoLocales/Validaciones.php');
                            $query="SELECT * FROM promociones WHERE estadoPromo='pendiente' $busqueda LIMIT $principio, $limite";                            
                            $resultados=consultaSQL($query);
                            if(mysqli_num_rows($resultados)!=0){
                                $noHayResultados=false;
                                while($fila=mysqli_fetch_array($resultados)){?>
                                        <div class='card' style='margin: 10px; width: 14em;'>
                                            <div class='card-body'>
                                                <h5 class='card-title'>Código: <?php echo($fila['cod']); ?></h5>
                                                <h6 class='card-subtitle mb-2 text-muted'><?php echo($fila["categoriaCliente"]); ?></h6>
                                                <p class='card-text'><?php echo($fila["textoPromo"]); ?></p>
                                                <p>Desde: <?php echo($fila["fechaDesde"]); ?> </br>Hasta: <?php echo($fila["fechaHasta"]); ?></p>
                                                <p><?php echo($fila["diaSemana"]); ?></p>

                                                <a href='ABMDescuentos.php?codAlta=<?php echo($fila['cod']); ?>' class='btn btn-primary card-link'>Aceptar</a>
                                                <button type='button' class='btn btn-danger
                                                ' data-bs-toggle='modal' data-bs-target='#deleteModal<?php echo $fila["cod"]; ?>'>Rechazar</button>
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
                                                                    <a href='ABMDescuentos.php?codBaja=<?php echo($fila['cod']);?>' style="color: black; text-decoration: none;">Confirmar</a>
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
                        $noHayResultados=true;
                       }
                    
                        ?>
                    </div>
                </div>
                <div class="row">
                <?php if($noHayResultados==false){?>
                    <nav aria-label="Navegación de páginas"  >
                        <ul class="pagination d-flex justify-content-center">
                            <?php
                            $query = "SELECT * FROM promociones WHERE estadoPromo='pendiente' $busqueda"; //Cuenta la cantidad de resultados que hay en la tabla
                            $resultados = consultaSQL($query);
                            $totalResultados = mysqli_num_rows($resultados);
                            $total_pages = ceil($totalResultados / $limite);
                            $query = $_GET;
                            if(isset($_GET['pagina']))
                                $pagina=$_GET['pagina'];
                            unset($query['pagina']);
                            $query_string = http_build_query($query);
                            ?>
                            <li class="page-item <?php if($pagina <= 1){ echo 'disabled'; } ?>"> 
                            <a class="page-link" href="<?php if($pagina <= 1){ echo '#'; } else {$paginaAnterior=$pagina-1;;echo("?".$query_string."&pagina=".$paginaAnterior.""); } ?>">Atras</a>
                            </li>
                            <?php
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo "<li class=\"page-item";
                                if ($pagina == $i) echo " active";
                                echo "\"><a class=\"page-link\" href='?" . $query_string . "&pagina=$i'>$i</a></li>";
                                }
                            ?>
                            <li class="page-item <?php if($pagina == $total_pages){ echo 'disabled'; } ?>"> 
                            <a class="page-link" href="<?php if($pagina == $total_pages){ echo '#'; } else {$paginaPosterior=$pagina+1;echo("?".$query_string."&pagina=".$paginaPosterior.""); } ?>">Adelante</a>
                            </li>
                        </ul>
                    </nav>
                    <?php } ?>
                </div>
                
            </div>
            
            
        </div>
    </div>

    



    <?php
    }else{
        exit(header("Location: ../index.php"));
    }

     ?>
    
</body>
    <footer>
        <?php include("../footer.php"); ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>