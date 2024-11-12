<?php
// variabls para paginacion 
$registros_por_pagina = 5; // Cantidad de registros por página
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; // Página actual
$offset = ($pagina - 1) * $registros_por_pagina; // Offset de la consulta
$paginacion = "";

if($estoy == "informeDescuentos" or $estoy == "gestionDescuentos") {
    $paginacion="LIMIT $offset , $registros_por_pagina"; // offset de donde arranca la consulta y cuantos registros va a mostrar
}

// Si es la primera vez que se entra a la pagina declara la variable asi despues concatena los codigoa para contar las cards a mostrar
$codLocalPaginacion = isset($codLocalPaginacion) ? $codLocalPaginacion : "";
$codPromoPaginacion = isset($codPromoPaginacion) ? $codPromoPaginacion : "";


include("validaciones.php");
$idusuario = $_SESSION["idUsuario"];
$query = "SELECT * FROM locales WHERE codUsuario = $idusuario";
$vresultado = consultaSQL($query);
$total_uso_promociones = 0;
if (mysqli_num_rows($vresultado) > 0) {
    while ($fila = mysqli_fetch_array($vresultado)) {
        $codLocal = $fila["codLocal"];
        $codLocalPaginacion .= " OR codLocal = '".$codLocal."'";
        $query2 = "SELECT * FROM promociones WHERE codLocal = $codLocal $busqueda $paginacion"; 
        $cont = 0;
        $vresultado2 = consultaSQL($query2);
        if (mysqli_num_rows($vresultado2) > 0) {
            while ($fila2 = mysqli_fetch_array($vresultado2)) { 
                if ($estoy == "verSolicitudDescuentos") { // si estoy en ver solicitudes de descuentos muestro las solicitudes pendientes
                    $codPromo = $fila2["cod"];
                    $codPromoPaginacion .= " OR codPromo = '".$codPromo."'";
                    $query3 = "SELECT * FROM uso_promociones WHERE codPromo = '".$fila2["cod"]."' AND estado = 'pendiente' ";
                    $vresultado3 = consultaSQL($query3);
                    if (mysqli_num_rows($vresultado3) > 0) {
                        while ($fila3 = mysqli_fetch_array($vresultado3)) {
                            $filaPaMostrar[] = $fila;
                            $fila2PaMostrar[] = $fila2;
                            $contPaMostrar[]= $fila3;
                            $total_uso_promociones++;
                        }
                    }
                }

                if ($estoy == "informeDescuentos") { // si estoy en informe descuentos cuento cuantas veces usaron el descuento
                    $query3 = "SELECT * FROM uso_promociones WHERE codPromo = '".$fila2["cod"]."' AND estado = 'aceptada' ";
                    $vresultado3 = consultaSQL($query3);
                    if (mysqli_num_rows($vresultado3) > 0) {
                        while ($fila3 = mysqli_fetch_array($vresultado3)) {
                            $cont++;
                        }
                    }
                    mostrarcards($fila, $fila2, $estoy, $cont);
                }
                if ($estoy == "gestionDescuentos") { // si estoy en gestion de descuentos muestro los descuentos activos de los locales propios
                    mostrarcards($fila, $fila2, $estoy, $cont);
                }
            }
        }
    }
}
    if($estoy == "informeDescuentos" or $estoy == "gestionDescuentos") {
        $sql_total = "SELECT COUNT(*) AS total FROM promociones WHERE (codLocal = $codLocal $codLocalPaginacion) $busqueda"; //cuenta las cards a msotrar con todos los cod de los locales propios y con los filtors aplicados
        $total_resultado = consultaSQL($sql_total)->fetch_assoc();  //calcula la cantidad de cards a mostrar
        $total_paginas = ceil($total_resultado['total'] / $registros_por_pagina); //calcula la cantidad de paginas a mostrar
    } else {
        // Calcular la cantidad de páginas
        $total_paginas = ceil($total_uso_promociones / $registros_por_pagina);

        // Mostrar las cards de la página actual
        $uso_promociones_pagina = array_slice($filaPaMostrar, $offset, $registros_por_pagina);
        $fila2_pagina = array_slice($fila2PaMostrar, $offset, $registros_por_pagina);
        $cont_pagina = array_slice($contPaMostrar, $offset, $registros_por_pagina);
        for($i = 0 ; $i < count($uso_promociones_pagina); $i++) {
            mostrarcards($uso_promociones_pagina[$i], $fila2_pagina[$i], $estoy, $cont_pagina[$i]);
        }
    }
    
    ?>




    <?php if ($total_paginas > 1) { ?> <!-- Muestra la paginacion si hay mas de una pagina -->
        <div class="container w-100 d-flex justify-content-center">
            <nav aria-label="..." class="mx-auto" style="width:fit-content">
                <ul class="pagination justify-content-center" style="width:fit-content">
                    <li class="page-item <?php if($pagina <= 1){ echo 'disabled'; } ?>"> 
                        <a class="page-link" href="<?php if($pagina <= 1){ echo '#'; } else { $query = $_GET; $query['pagina'] = $pagina - 1; echo strtok($_SERVER['REQUEST_URI'], '?') . '?' . http_build_query($query); } ?>">Previous</a>
                    </li>
                    <?php
                    for ($i = 1; $i <= $total_paginas; $i++) {
                        echo "<li class=\"page-item";
                        if ($pagina == $i) echo " active";
                        $query = $_GET; $query['pagina'] = $i;
                        echo "\"><a class=\"page-link\" href='" . strtok($_SERVER['REQUEST_URI'], '?') . '?' . http_build_query($query) . "'>$i</a></li>";
                    }
                    ?>
                    <li class="page-item "> 
                        <a class="page-link" href="<?php if($pagina >= $total_paginas){ echo '#'; } else { $query = $_GET; $query['pagina'] = $pagina + 1; echo strtok($_SERVER['REQUEST_URI'], '?') . '?' . http_build_query($query); } ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php } ?>
    </div>
    <?php








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
                    <a href="cambiarEstadoPromo.php?cod=<?php echo("1");?>&promo=<?php echo("".$fila2['cod']."")?>&codCli= <?php echo("".$cont['codCliente']."")?>" class="btn btn-primary m-1">Aceptar solicitud</a>
                    <a href="cambiarEstadoPromo.php?cod=<?php echo("2"); ?>&promo=<?php echo("".$fila2['cod']."")?>&codCli= <?php echo("".$cont['codCliente']."")?>" class="btn btn-primary m-1">Denegar solicitud</a>
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
