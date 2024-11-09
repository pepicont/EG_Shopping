<?php 
include("validaciones.php");
$idusuario = $_SESSION["idUsuario"];
$query = "SELECT * FROM locales WHERE codUsuario = $idusuario";
$vresultado = consultaSQL($query);


$cantprocaract = 0;
$registros_por_pagina = 5;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina - 1) * $registros_por_pagina;
if($estoy == "informeDescuentos" or $estoy == "gestionDescuentos"){
    $busqueda.='LIMIT '.$offset.', '.$registros_por_pagina;
}

if (mysqli_num_rows($vresultado) > 0) {
    while ($fila = mysqli_fetch_array($vresultado)) {
        $codLocal = $fila["codLocal"];
        $query2 = "SELECT * FROM promociones WHERE codLocal = $codLocal $busqueda "; 
        $cont = 0;
        $vresultado2 = consultaSQL($query2);
        if (mysqli_num_rows($vresultado2) > 0) {
            while ($fila2 = mysqli_fetch_array($vresultado2)) { 
                if ($estoy == "informeDescuentos") {
                    $query3 = "SELECT * FROM uso_promociones WHERE codPromo = '".$fila2["cod"]."' AND estado = 'aceptada'";
                    $vresultado3 = consultaSQL($query3);
                    if (mysqli_num_rows($vresultado3) > 0) {
                        while ($fila3 = mysqli_fetch_array($vresultado3)) {
                            $cont++;
                        }
                    }
                    mostrarcards($fila, $fila2, $estoy, $cont);
                    $cantprocaract++;
                }
                if ($estoy == "verSolicitudDescuentos") {
                    $query3 = "SELECT * FROM uso_promociones WHERE codPromo = '".$fila2["cod"]."' AND estado = 'pendiente' LIMIT $offset, $registros_por_pagina ";
                    $vresultado3 = consultaSQL($query3);
                    if (mysqli_num_rows($vresultado3) > 0) {
                        while ($cont = mysqli_fetch_array($vresultado3)) {
                            mostrarcards($fila, $fila2, $estoy, $cont);
                            $cantprocaract++;
                        }
                    }
                }
                if ($estoy == "gestionDescuentos") {
                    mostrarcards($fila, $fila2, $estoy, $cont);
                    $cantprocaract++;
                }
            }
        }
    }
    if ($estoy == "informeDescuentos") {
        $sql_total = "SELECT COUNT(*) AS total FROM promociones WHERE codPromo = '".$fila2["cod"]."' AND estado = 'aceptada'";
    }elseif ($estoy == "verSolicitudDescuentos") {
        $sql_total = "SELECT COUNT(*) AS total FROM uso_promociones WHERE codPromo = '".$fila2["cod"]."' AND estado = 'pendiente' LIMIT $offset, $registros_por_pagina ";
    }elseif ($estoy == "gestionDescuentos") {
        $sql_total = "SELECT COUNT(*) AS total FROM promociones WHERE codLocal = $codLocal $busqueda ";
    }
    $total_resultado = consultaSQL($sql_total)->fetch_assoc(); 
    $total_paginas = ceil($total_resultado['total'] / $registros_por_pagina);
    ?>
    <?php if ($total_paginas > 1) { ?>
        <div class="container w-100 d-flex justify-content-center">
            <nav aria-label="..." class="mx-auto" style="width:fit-content">
                <ul class="pagination justify-content-center" style="width:fit-content">
                    <li class="page-item <?php if($pagina <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pagina <= 1){ echo '#'; } else { echo $_SERVER['REQUEST_URI'] . "&pagina=" . ($pagina - 1); } ?>">Previous</a>
                    </li>
                    <?php
                    for ($i = 1; $i <= $total_paginas; $i++) {
                    echo "<li class=\"page-item";
                    if ($pagina == $i) echo " active";
                    echo "\"><a class=\"page-link\" href='" . $_SERVER['REQUEST_URI'] . "&pagina=$i'>$i</a></li>";
                    }
                    ?>
                    <li class="page-item <?php if($pagina >= $total_paginas){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pagina >= $total_paginas){ echo '#'; } else { echo $_SERVER['REQUEST_URI'] . "&pagina=" . ($pagina + 1); } ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php } ?>
    </div>
    <?php
} else { 
    echo("No hay promociones activas");
} 

if ($cantprocaract == 0) {
    echo("<h1> No hay promociones con estas caraceristicas </h1>");
}

function mostrarcards($fila, $fila2, $estoy, $cont) {
    ?>
    <div class="card" style="margin: 15px; width: 18rem;">
        <div class="card-body">
            <div style="height:80%">
                <h5 class="card-title">Cod descuento: <?php echo($fila2["cod"]) ?></h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Descripcion: <?php echo($fila2["textoPromo"]) ?></h6>
                <p class="card-text">Categoria de cliente: <?php echo($fila2["categoriaCliente"]) ?></p>
                <p class="card-text <?php if ($estoy != "verSolicitudDescuentos") echo "d-none" ?>">codigo del cliente: <?php echo($cont["codCliente"]) ?> </p>
                <p class="card-text">Del local: <?php echo ($fila["nombreLocal"]) ?></p>
                <p class="card-text">Dias de la semana: <?php echo($fila2["diaSemana"]) ?></p>
                <p class="card-text">Plazo: <?php echo($fila2["fechaDesde"]); echo(" --- "); echo($fila2["fechaHasta"]) ?></p> 
                <p class="card-text">Estado: <?php echo($fila2["estadoPromo"]) ?></p>
            </div>
            <div style="height: 65px;">
                <button type="button" class="btn btn-danger w-100 m-1 <?php if ($estoy != "gestionDescuentos") echo "d-none" ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Eliminar descuento
                </button>
                <p class="card-text <?php if ($estoy != "informeDescuentos") echo "d-none" ?>">Se utilizo: <?php echo($cont) ?>  </p>
                <div class="card-footer d-flex justify-content-between <?php if ($estoy != "verSolicitudDescuentos") echo "d-none" ?>" style="border-top: 0px;">
                    <a href="cambiarEstadoPromo.php?cod=<?php echo("1");?>&promo=<?php echo("".$fila2['cod']."")?>" class="btn btn-primary m-1">Aceptar solicitud</a>
                    <a href="cambiarEstadoPromo.php?cod=<?php echo("2"); ?>&promo=<?php echo("".$fila2['cod']."")?>" class="btn btn-primary m-1">Denegar solicitud</a>
                </div>
            </div>
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
                    <p>aca va toda la informacion de el descuento a eliminar</p>
                </div>
                <div class="modal-footer mx-auto text-center w-100 p-2 d-flex justify-content-between">
                    <a href="eliminarDescuento.php?cod=<?php echo($fila2['cod']) ?>" class="btn btn-primary m-1">Eliminar descuento</a>
                    <button type="button" class="btn btn-secundary m-1" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
