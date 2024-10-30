<?php
    $lugar="admin";
    include_once("../funciones.php");
    include("../header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InformeDescuentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../estilos/style1.css" rel="stylesheet">
</head>
<body>
    <div class="row">
        <div class="filtros col-3">
            <h2>Filtros: </h2>
            <form method="GET">
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
        
                    Lunes: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="l"> <br>
                    Martes: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="m"><br>
                    Miercoles: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="mi"> <br>
                    Jueves: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="j"> <br>
                    Viernes: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="v"><br>
                    Sabado: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="s"><br>
                    Domingo: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="d"><br>
                </div>
                <div class="form-group mx-auto text-center w-100 p-2 d-flex justify-content-between" >
                    <input type="submit" name="submit" value="Aplicar filtros" class="btn btn-primary w-100 m-1">
                    <a href="informeDescuentos.php" class="btn btn-primary w-100 m-1">Borrar filtros</a>
                </div>
            </form>
        </div>
        
        <div class="listado col-auto  d-flex" >
       
            <?php 
            $busqueda = "" ;
            $fecha_hoy = date('Y-m-d');
            $cat = 0;
            $concat = 0;
            
            if(isset($_GET["submit"])){
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
                    $busqueda .= "(";
                    $categorias_seleccionadas = $_GET['categoria'];
                    foreach ($categorias_seleccionadas as $index => $categoria) {
                        if ($index > 0) {
                            $busqueda .= " OR ";
                        }
                        $busqueda .= "categoriaCliente = '" . $categoria . "'";
                    }
                    $busqueda .= ")";
                }
                // Hay que poner lo de los dias que todavia no pusimos los dias en la tabla. 

            }
           
            $query = "SELECT * FROM promociones $busqueda";  
            $vresultado = consultaSQL($query);
            if (mysqli_num_rows($vresultados)>0) {
                while ($fila = mysqli_fetch_array($vresultado)) {
                    $cont=0;
                    $query2 = "SELECT * FROM uso_promociones WHERE codPromo = '".$fila["cod"]."'";
                    $resultado2 = consultaSQL($query2);
                    $cont = mysqli_num_rows($resultado2);
                    $query3 = "SELECT * FROM locales WHERE codLocal = '".$fila["codLocal"]."'";
                    $resultado3 = consultaSQL($query3);
                    $fila3 = mysqli_fetch_array($resultado3);

                ?>
                
                    <div class="card " style=" margin: 15px; width: 18rem; ">
                        <div class="card-body">
                            <h5 class="card-title">Nombre de local: <?php echo($fila3["nombreLocal"]) ?></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Código del local: <?php echo($fila["cod"]) ?> </h6>
                            <p class="card-text">Descripción: <?php echo($fila["textoPromo"]) ?> </p>
                            <p class="card-text">Se utilizó: <?php echo ($cont) ?> veces. </p>
                            
                        </div>
                    </div>
                    
                
                    
                <?php
                    
                }
            } else {
                echo "No se encontraron promociones.";
                echo $busqueda;
            }   
            
            ?>


        </div>
        
    </div>

    <?php include("../footer.php");?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
