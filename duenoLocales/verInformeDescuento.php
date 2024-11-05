<?php
$lugar = "duenoLocal";
    include_once("../funciones.php");
    include("../header.php");
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
    <title>verSolicitudDescuentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilos/style1.css">

</head>
<body>
    <?php
    $idUsuario= $_SESSION["idUsuario"];
    $query = "SELECT * FROM locales WHERE codUsuario = '".$idUsuario."'";
    $vresultado = consultaSQL($query);
    
    ?>
    <div class="row">
        <div class="filtros col-3">
            <?php 
            $estoy = "informeDescuentos";
            include("filtros.php"); 
             $busqueda = ""; 
             if(isset($_GET["submit"])){   
                 if(isset($_GET["codDes"]) && $_GET["codDes"] != ""){
                     $busqueda .= "AND cod = '" . $_GET["codDes"] . "' ";
                 }
                 if(isset($_GET["fechaDes"]) && $_GET["fechaDes"] != ""){
                     $busqueda .= "AND fechaDesde >= '".$_GET["fechaDes"]."' ";
                 }   
                 if(isset($_GET["fechaHas"]) && $_GET["fechaHas"] != ""){
                     $busqueda .= "AND fechaHasta <= '".$_GET["fechaHas"]."' ";
                 }
                 if(isset($_GET['categoria']) && $_GET['categoria'] != "0"){
                     $busqueda .= "AND categoriaCliente = '" . $_GET["categoria"] . "' ";
                         
                 }
                 if(!empty($_GET['diaSemana'])){
                     // $diasSeleccionados = implode(",", $_GET['dia']);
                     // $busqueda .= "AND diaSemana = '".$diasSeleccionados."' ";  
                     // $query2 = "SELECT * FROM promociones WHERE codLocal = $codLocal $busqueda";
                 }
             } 
            ?>
        </div>
        <div class="listado col-8 d-flex flex-wrap justify-content-center mx-auto">
        <?php
        if (mysqli_num_rows($vresultado) > 0) {
            while ($fila = mysqli_fetch_array($vresultado)){
            $codLocal= $fila["codLocal"];
            $query2 = "SELECT * FROM promociones WHERE codLocal = '".$codLocal."' '".$busqueda."'";
            $vresultado2 = consultaSQL($query2);
            $cont = 0;
            if(mysqli_num_rows($vresultado) > 0){
                while($fila2 = mysqli_fetch_array($vresultado2)){
                $codPromo = $fila2["cod"];
                $query3 = "SELECT * FROM uso_promociones WHERE codPromo = '".$codPromo."'";
                $vresultado3 = consultaSQL($query3);
                if(mysqli_num_rows($vresultado3) > 0){
                    while($fila3 = mysqli_fetch_array($vresultado3)){
                        $cont++;
                }
                    ?>
                    <div class="card bg-color-primary" style="margin: 15px; width: 18rem; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="card-body">
                        <h5 class="card-title">Codigo Promo: <?php echo($codPromo); ?></h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Descripcion: <?php echo($fila2["textoPromo"]); ?> </h6>
                        <p class="card-text">Categoria de caliente: <?php echo($fila2["categoriaCliente"]); ?> </p>
                        <p class="card-text">Del local: <?php echo ($fila["nombreLocal"]); ?> </p>
                        <p class="card-text">Dias de la semana: <?php echo($fila2["diaSemana"]); ?> </p> 
                        <p class="card-text" >Plazo: <?php echo($fila2["fechaDesde"]); echo(" --- "); echo($fila2["fechaHasta"])?> </p> 
                        <p class="card-text">Estado: <?php echo($fila2["estadoPromo"]) ?> </p>
                        <p class="card-text">Se utilizo: <?php echo($cont) ?>  </p>
                        </div>
                    </div>
                    <?php
                    }
                }
                }   
            } 
}
        
        ?>
        </div>
    </div>
</body>
<?php include("../footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>