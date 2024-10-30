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
    <title>InformeDesceuntos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container row">
        <div class="filtros col-4 ">
            <form action="GET">
                <div class="form-group">
                Fechas desde:
                <input type="date" name="fechades" id="fechades" class="form-control" aria-describedby="helpId">
                </div>
                <div class="form-group">
                Fecha hasta:
                <input type="text" name="fechahas" id="fechahas" class="form-control"  aria-describedby="helpId">
                </div>
                <div class="form-group">
                    <label for="estado">Estado de la promocion:</label>
                    <select name="estado" id="estado" class="form-control">
                        <option value="1">Vencido</option>
                        <option value="2">Activo</option>
                    </select>
                </div>
                <div class="form-group">
                    Categoria de descuento segun cliente:
                    Inicial: <input type="checkbox" class="form-checkinput" aria-describedby="helpId" value="inicial" name=categoria[]>
                    Medium: <input type="checkbox" class="form-checkinput" aria-describedby="helpId" value="medium" name=categoria[]>
                    Premium: <input type="checkbox" class="form-checkinput" aria-describedby="helpId" value="premium" name=categoria[]>
                    
                </div>
                <div class="form-group">
                    Dia de la semana:
                    Lunes: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="l">
                    Martes: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="m">
                    Miercoles: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="mi">
                    Jueves: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="j">
                    Viernes: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="v">
                    Sabado: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="s">
                    Domingo: <input type="checkbox" name="dia[]"class="form-checkinput" aria-describedby="helpId" value="d">
                </div>
                <div class="form-group">
                    <input type="submit" value="Aplicar">
                </div>
            </form>
        </div>
        <div class="listado col-8">
            <?php 
            $busqueda = "" ;
            if(isset($_GET["submit"])){
                $concat = 0; 
                $busqueda = "WHERE ";
                if (isset($_GET["fechades"])){
                    $busqueda = $busqueda . "fechaDesde >= '".$_GET["fechades"]."'";
                    $concat++;
                }
                if (isset($_GET["fechahas"])){
                    if($concat < 0 ){
                        $busqueda = $busqueda . " AND ";
                    }else{
                        $concat++;
                    }
                    $busqueda = $busqueda . "fechaHasta >='" .$_GET["fechahas"]."'";
                }
                if ("1"==($_GET["estado"])){
                    if($concat < 0 ){
                        $busqueda = $busqueda . " AND ";
                    }else{
                        $concat++;
                    }
                    $busqueda = $busqueda . " fechaHasta < $fecha_hoy = '".date("Y-m-d")."'" ;
                }
                if ("2"==($_GET["estado"])){
                    if($concat < 0 ){
                        $busqueda = $busqueda . " AND ";
                    }else{
                        $concat++;
                    }
                    $busqueda = $busqueda . " fechaHasta > $fecha_hoy = '".date("Y-m-d")."'" ;
                    
                }
                if (isset($_GET['categoria'])) {
                    
                    if($concat < 0 ){
                        if($cat < 0);
                        $busqueda = $busqueda . " OR ";
                        }else{
                            $cat++;
                            $busqueda = $busqueda . " AND ";
                            $concat++;
                        
                        }
                    $categorias_seleccionadas = $_GET['categoria'];
                    foreach ($categorias_seleccionadas as $categoria) {
                        $busqueda = $busqueda . $categoria; 
                    }
                }
       // Hay que poner lo de los dias que todavia no pusimos los dias en la tabla. 

        }
            
            $query = "SELECT * FROM promociones $busqueda";  
            $vresultado = consultaSQL($query);
            if ($vresultado->num_rows > 0) {
                while ($fila = mysqli_fetch_array($vresultado)) {
                    $cont=0;
                    $query2 = "SELECT * FROM uso_promociones WHERE codPromo = '".$fila["cod"]."'";
                    $resultado2 = consultaSQL($query2);
                    $cont = mysqli_num_rows($resultado2);
                    $query3 = "SELECT * FROM locales WHERE codLocal = '".$fila["codLocal"]."'";
                    $resultado3 = consultaSQL($query3);
                    $fila3 = mysqli_fetch_array($resultado3);

                ?>
                    <div class="card" style="width: 18rem;">
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
            }   
          
            
            ?>


        </div>
    </div>
    

    



    <?php include("../footer.php");?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
