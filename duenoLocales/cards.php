<?php 
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

$query = "SELECT * FROM locales WHERE codUsuario = $idusuario";
$vresultado = consultaSQL($query);
if (mysqli_num_rows($vresultado) > 0) {
    while ($fila = mysqli_fetch_array($vresultado)){
        $codLocal = $fila["codLocal"];
        $query2 = "SELECT * FROM promociones WHERE codLocal = $codLocal AND estadoPromo != 'eliminado' $busqueda"; 
        $vresultado2 = consultaSQL($query2);
    if(mysqli_num_rows($vresultado2)>0){
        while ($fila2 = mysqli_fetch_array($vresultado2)) { 
            ?>
            <div class="card " style=" margin: 15px; width: 18rem; ">
                <div class="card-body">
                    <h5 class="card-title">Cod descuento: <?php echo($fila2["cod"]) ?></h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Descripcion: <?php echo($fila2["textoPromo"]) ?> </h6>
                    <p class="card-text">Categoria de cliente: <?php echo($fila2["categoriaCliente"]) ?> </p>
                    <p class="card-text">Del local: <?php echo ($fila["nombreLocal"]) ?> </p>
                    <p class="card-text">Dias de la semana: <?php echo($fila2["diaSemana"]) ?> </p>
                    <p class="card-text" >Plazo: <?php echo($fila2["fechaDesde"]); echo(" --- "); echo($fila2["fechaHasta"])?> </p> 
                    <p class="card-text">Estado: <?php echo($fila2["estadoPromo"]) ?> </p>
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