<?php include_once("../session.php"); ?>
<?php
    $lugar="admin";
    include_once("../funciones.php");
    $estoy = "informeDescuentos";
    actualizarDescuentos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InformeDescuentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../estilos/style1.css" rel="stylesheet">
</head>
<header>
    <?php
        include("../header.php");
    ?>
</header>
    <body>
<?php if ($login==true && $tipoUsuario=="administrador"){?>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php 
                    include("../breadCrumbs.php");
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3" style="height:fit-content">
                    <div class="filtros text-center">
                        <h2 class="mt-4">Filtros: </h2>
                        <form class="mx-auto"method="GET">
                            <div class="form-group">
                            Fechas desde:
                            <input type="date" name="fechades" id="fechades" class="form-control" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                            Fecha hasta:
                            <input type="date" name="fechahas" id="fechahas" class="form-control"  aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado de la promocion:</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option value="0">Selecciona una opcion:</option>
                                    <option value="2">Activo</option>
                                    <option value="1">Vencido</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <hr>
                                Categoria de descuento segun cliente: <br> 
                                
                                Inicial: <input type="checkbox" class="form-checkinput" aria-describedby="helpId" value="inicial" name="categoria[]"> <br>
                                Medium: <input type="checkbox" class="form-checkinput" aria-describedby="helpId" value="medium" name="categoria[]"> <br>
                                Premium: <input type="checkbox" class="form-checkinput" aria-describedby="helpId" value="premium" name="categoria[]"> <br>
                                
                            </div>
                            <div class="form-group">
                                <hr>
                                Dia de la semana: <br>
                    
                                Lunes: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="lunes"> <br>
                                Martes: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="martes"><br>
                                Miercoles: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="miercoles"> <br>
                                Jueves: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="jueves"> <br>
                                Viernes: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="viernes"><br>
                                Sabado: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="sabado"><br>
                                Domingo: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="domingo"><br>
                            </div>
                            <div class="form-group mx-auto text-center w-100 p-2 d-flex justify-content-between" >
                                <input type="submit" name="submit" value="Aplicar" class="btn btn-primary w-100 ">
                                <input type="reset" value="Restablecer" class="btn btn-secondary ">
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="col-12 col-md-8 col-lg-9 text-center" >
                    <div class="row listado">
            
                            <?php 
                            $fecha_hoy = date('Y-m-d');
                            $cat = 0;
                            $concat = 0;
                            
                            if(!empty($_GET["submit"])){
                                $busqueda = "" ;

                                $busqueda = "WHERE ";
                                if (isset($_GET["fechades"]) && !empty($_GET["fechades"])){
                                    $busqueda .= "fechaDesde >= '". $_GET["fechades"]. "'";
                                    $concat++;
                                }
                                if (isset($_GET["fechahas"]) && !empty($_GET["fechahas"])){
                                    if($concat > 0 ){
                                        $busqueda .= " AND ";
                                    } else {
                                        $concat++;
                                    }
                                    $busqueda .= "fechaHasta >= " . $_GET["fechahas"];
                                }
                                if (isset($_GET["estado"]) && $_GET["estado"] == "1"){
                                    if($concat > 0 ){
                                        $busqueda .= " AND ";
                                    } else {
                                        $concat++;
                                    }
                                    $busqueda .= " fechaHasta < " . $fecha_hoy ;
                                }
                                if (isset($_GET["estado"]) && $_GET["estado"] == "2"){
                                    if($concat > 0 ){
                                        $busqueda .= " AND ";
                                    } else {
                                        $concat++;
                                    }
                                    $busqueda .= " fechaHasta > " . $fecha_hoy ;
                                }
                                if (isset($_GET['categoria'])) {
                                    if($concat > 0 ){
                                        $busqueda .= " AND ";
                                    }
                                    
                                    $categorias_seleccionadas = $_GET['categoria'];
                                    foreach ($categorias_seleccionadas as $index => $categoria) {
                                        if ($index > 0) {
                                            $busqueda .= " OR ";
                                        }
                                        $busqueda .= "categoriaCliente = '" . $categoria . "'";
                                    }
                                    
                                }
                                // Hay que poner lo de los dias que todavia no pusimos los dias en la tabla. 
                                if(isset($_GET['dia'])){
                                    if($concat > 0){
                                        $busqueda .= " AND ";
                                    }
                                    $busqueda .= "(";
                                    $diasSeleccionados = $_GET['dia'];
                                    $numDias = count($diasSeleccionados);
                                    for($i = 0; $i < $numDias; $i++){
                                        if($i > 0){
                                            $busqueda .= " OR ";
                                        }
                                        $busqueda .= "diaSemana LIKE '%" . $diasSeleccionados[$i] . "%'";
                                    }
                                    $busqueda .= ")";
                                }

                            }else{$busqueda = "";}
                        
                            // Logica de la paginación
                            $limite = 8; // cantidad de resultados que se muestran en la página
                            if (isset($_GET["pagina"])) {
                                $pagina  = $_GET["pagina"];
                            } else {
                                $pagina = 1;
                            }
                            $principio = ($pagina - 1) * $limite; // el número del primer resultado que se mostrará en la página actual. Esto va a ir cambiando a medida que se avance de página

                            $query = "SELECT * FROM promociones $busqueda LIMIT $principio, $limite";  //Lo que hace el Limit es que solo muestra los resultados que estan entre el principio y el limite
                            $vresultado = consultaSQL($query);
                            //fin de lógica
                            if (mysqli_num_rows($vresultado) > 0) {
                                while ($fila = mysqli_fetch_array($vresultado)) {
                                    $cont = 0;
                                    $query2 = "SELECT * FROM uso_promociones WHERE codPromo = '".$fila["cod"]."'";
                                    $resultado2 = consultaSQL($query2);
                                    $cont = mysqli_num_rows($resultado2);
                                    $query3 = "SELECT * FROM locales WHERE codLocal = '".$fila["codLocal"]."'";
                                    $resultado3 = consultaSQL($query3);
                                    
                                    $fila3 = mysqli_fetch_array($resultado3);
                                ?>
                            
                                    <div class="card " style=" margin: 10px; width: 14em; ">
                                        <div class="card-body ">
                                            <h5 class="card-title "><?php echo($fila3["nombreLocal"]) ?></h5>
                                            <hr>
                                            <h6 class="card-subtitle  text-body-secondary"><?php echo($fila["categoriaCliente"]) ?> </h6>
                                            <p class="card-text"><?php echo($fila["textoPromo"]) ?> </p>
                                            <p class="card-text"><?php echo($fila["diaSemana"]) ?> </p>
                                            <p class="card-text">Se utilizó: <?php if($cont == 1) echo("$cont vez"); else echo("$cont veces");?></p>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>
                    </div>
                
                    

                    <!-- Links de paginación -->
                    <div class="row">
                        <nav aria-label="Navegación de páginas"  >
                            <ul class="pagination d-flex justify-content-center">
                                <?php
                                $query = "SELECT * FROM promociones $busqueda"; //Cuenta la cantidad de resultados que hay en la tabla
                                $resultados = consultaSQL($query);
                                //$row = mysqli_fetch_row($rs_result);
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
                    </div>
                    <?php
                    } else {
                        echo "No se encontraron promociones.";
                    }
                            
                    ?>


                </div>
                
            </div>
        </div>

    <?php }
    else{
        exit(header("Location: ../index.php"));
    }
    ?>
</body>
<footer>
    <?php include("../footer.php");?>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>
