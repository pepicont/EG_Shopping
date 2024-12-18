<?php
if ($_SESSION["tipoUsuario"] != "cliente") {
    header("Location: ../index.php");
    exit();
}
include_once("../funciones.php");   
// Logica de la paginación
$limite = 6; // cantidad de resultados que se muestran en la página
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; // Página actual
$principio = ($pagina - 1) * $limite; // el número del primer resultado que se mostrará en la página actual. Esto va a ir cambiando a medida que se avance de página

//Lo que hace el Limit es que solo muestra los resultados que estan entre el principio y el limite
//fin de lógica
$totalpromociones= 0;

$muestrafila = array();
$muestrafila1 = array();
$busqueda2 = isset($busqueda2) ? $busqueda2 : ''; // Ensure $busqueda2 is defined
$query = "SELECT * FROM locales WHERE estado = 'activo' $busqueda2";
$resultado = consultaSQL($query);
if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_array($resultado)) {
        $query1 = "SELECT * FROM promociones WHERE  estadoPromo = 'activa' AND  codLocal =  '".$fila['codLocal']."' $busqueda ";
        $resultado1 = consultaSQL($query1);
        while ($fila1 = mysqli_fetch_array($resultado1)) {
            $query2 = "SELECT * FROM uso_promociones WHERE codPromo = '" . $fila1["cod"] . "' AND codCliente = '" . $_SESSION['idUsuario'] . "'";
            $resultado2 = consultaSQL($query2);
            if (mysqli_num_rows($resultado2) > 0) {
                if ($estoy == 'verDescuentosUtilizados') {
                    $fila3 = mysqli_fetch_array($resultado2);
                    $encontro[] = $fila3['estado'] ;
                    $muestrafila1[] = $fila1;
                    $muestrafila[] = $fila;
                    $totalpromociones++;
                }
            } else {
                if ($estoy == 'verDescuentos') {
                    $muestrafila1[] = $fila1;
                    $muestrafila[] = $fila;
                    $totalpromociones++;
                    $encontro[] = 0;
                }
            }
        }
    }
}
$total_paginas = ceil($totalpromociones / $limite);
$promociones_pagina = array_slice($muestrafila1, $principio, $limite);
$fila_pagina = array_slice($muestrafila, $principio, $limite);
for ($i = 0; $i < count($promociones_pagina); $i++) {
    mostrarcards($promociones_pagina[$i], $fila_pagina[$i], $encontro[$i]);
}
if ($total_paginas > 1) { ?> <!-- Muestra la paginación si hay más de una página -->
    <div class="container w-100 d-flex justify-content-center">
        <nav aria-label="..." class="mx-auto" style="width:fit-content">
            <ul class="pagination justify-content-center" style="width:fit-content">
                <li class="p"> <!-- Muestra la paginación si hay más de una página -->
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
                <li class="page-item
                <li class="page-item <?php if($pagina >= $total_paginas){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php if($pagina >= $total_paginas){ echo '#'; } else { $query = $_GET; $query['pagina'] = $pagina + 1; echo strtok($_SERVER['REQUEST_URI'], '?') . '?' . http_build_query($query); } ?>">Next</a>
                </li>
            </ul>
        </nav>
</div>
<?php } ?>

<?php

function mostrarcards($fila, $fila1, $encontro){ ?>
    <div class="card" style="margin: 15px; width: 18rem;">
        <div class="card-body">
            <div style="height:80%">
                <h5 class="card-title tituloCard">Cod descuento: <?php echo ($fila['cod']) ?></h5>
                <h6 class="card-subtitle text-body-secondary">Descripcion: <?php echo ($fila["textoPromo"]) ?></h6>
                <p class="card-text">Del local: <?php echo ($fila1["nombreLocal"]) ?></p>
                <p class="card-text">Rubro: <?php echo ($fila1["rubroLocal"]) ?></p>
                <p class="card-text">Dias de la semana: <?php echo ($fila["diaSemana"]) ?></p>
                <p class="card-text">Plazo: <?php echo ($fila["fechaDesde"]); echo (" --- "); echo ($fila["fechaHasta"]) ?></p>
                <p class="card-text <?php if($encontro == 0){echo "d-none";} ?>">Estado: <?php echo $encontro;?></p>
            </div>
            <div style="height: 65px;">
                <?php if (strpos($fila['diaSemana'],obtenerDiaDeHoy())!==false){ ?>
                <button type="button" class="btn btn-primary w-100 m-1 <?php if ($encontro != 0) echo "d-none" ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $fila['cod'];?>">
                    Utilizar descuento
                </button>
                
                <?php }else{ ?>
                    <button type="button" class="btn btn-secondary w-100 m-1 <?php if ($encontro != 0) echo "d-none" ?>">
                    Vuelve el dia del descuento 
                </button>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop<?php echo $fila['cod'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
<?php 
    
} 
if($totalpromociones == 0){
    echo "No hay promociones disponibles";
}   

?>

