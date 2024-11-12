<?php
// Logica de la paginación
$limite = 6; // cantidad de resultados que se muestran en la página
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; // Página actual
$principio = ($pagina - 1) * $limite; // el número del primer resultado que se mostrará en la página actual. Esto va a ir cambiando a medida que se avance de página

//Lo que hace el Limit es que solo muestra los resultados que estan entre el principio y el limite
//fin de lógica
$totalpromociones= 0;

$muestrafila = array();
$muestrafila1 = array();
$query = "SELECT * FROM locales WHERE estado = 'activo' $busqueda2";
$resultado = consultaSQL($query);
if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_array($resultado)) {
        $query1 = "SELECT * FROM promociones WHERE  estadoPromo = 'activa' AND  codLocal =  '".$fila['codLocal']."' $busqueda ";
        $resultado1 = consultaSQL($query1);
        while ($fila1 = mysqli_fetch_array($resultado1)) {
                    $muestrafila1[] = $fila1;
                    $muestrafila[] = $fila;
                    $totalpromociones++;
            }
        }
    }

$total_paginas = ceil($totalpromociones / $limite);
$promociones_pagina = array_slice($muestrafila1 , $principio, $limite);
$fila_pagina = array_slice($muestrafila, $principio, $limite);
for ($i = 0; $i < count($promociones_pagina); $i++) {
    mostrarcards($muestrafila1[$i], $muestrafila[$i] ,$fila_pagina[$i]);
}
if ($total_paginas > 1) { ?> <!-- Muestra la paginación si hay más de una página -->
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
                <li class="page-item <?php if($pagina >= $total_paginas){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pagina >= $total_paginas){ echo '#'; } else { $query = $_GET; $query['pagina'] = $pagina + 1; echo strtok($_SERVER['REQUEST_URI'], '?') . '?' . http_build_query($query); } ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
<?php } ?>

<?php

function mostrarcards($fila, $fila1)
{ ?>
    <div class="card" style="margin: 15px; width: 18rem;">

        <div class="card-body">
            <div style="height:80%">
                <h5 class="card-title">Cod descuento: <?php echo ($fila["cod"]) ?></h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Descripcion: <?php echo ($fila["textoPromo"]) ?></h6>
                <p class="card-text">Del local: <?php echo ($fila1["nombreLocal"]) ?></p>
                <p class="card-text">Rubro: <?php echo ($fila1["rubroLocal"]) ?></p>
                <p class="card-text">Dias de la semana: <?php echo ($fila["diaSemana"]) ?></p>
                <p class="card-text">Plazo: <?php echo ($fila["fechaDesde"]); echo (" --- "); echo ($fila["fechaHasta"]) ?></p>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Esta seguro que desea utilizar el descuento?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer mx-auto text-center w-100 p-2 d-flex justify-content-between">
                    <a href="utilizarDescuento.php?cod=<?php echo ($fila['cod']) ?>" class="btn btn-primary m-1">Utilizar descuento</a>
                    <button type="button" class="btn btn-secundary m-1" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
