<?php
session_start();
include_once("../funciones.php");
include("../header.php");
if ($_SESSION["tipoUsuario"] != "cliente") {
        header("Location: ../index.php");
        exit();
    }
$catUsuario = $_SESSION["categoriaCliente"];
if ($catUsuario == "premium") {
    $busqueda = "WHERE (tipoUsuario = 'premium' or tipoUsuario = 'inicial' or tipoUsuario = 'medium')";
} elseif ($catUsuario == "inicial") {
    $busqueda = "WHERE tipoUsuario = 'inicial'";
} else {
    $busqueda = "WHERE tipoUsuario != 'premium'";
}

// Paginacion 
$registros_por_pagina = 2;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina - 1) * $registros_por_pagina;
$paginacion = "LIMIT $offset, $registros_por_pagina";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>NOVEDADES</h1>
    <?php 
        $query = "SELECT * FROM novedades " . $busqueda . " AND fechaHasta >= '" . date("Y-m-d") . "' AND estado = 'activo' $paginacion";
        $resultado = consultaSQL($query);
        while ($fila = mysqli_fetch_array($resultado)) {
    ?>
        <div class="card" style="margin: 15px; width: 18rem;">
            <div class="card-body">
                <div style="height:80%">
                    <h5 class="card-title"> <?php echo($fila["nombreNovedad"]) ?></h5> 
                    <p class="card-text"> <?php echo($fila["textoNovedad"]) ?></p>
                    <p class="card-text">Plazo: <?php echo($fila["fechaDesde"]); echo(" --- "); echo($fila["fechaHasta"]) ?></p> 
                </div>
            </div>
        </div>
    <?php
        }
        // Calcular el total de páginas
        $sql_total = "SELECT COUNT(*) AS total FROM novedades " . $busqueda . " AND fechaHasta >= '" . date("Y-m-d") . "' AND estado = 'activo'";
        $total_resultado = consultaSQL($sql_total)->fetch_assoc();
        $total_paginas = ceil($total_resultado['total'] / $registros_por_pagina);

        // Generar y mostrar los enlaces de paginación
        if ($total_paginas > 1) { 
    ?>
        <div class="container w-100 d-flex justify-content-center">
            <nav aria-label="..." class="mx-auto" style="width:fit-content">
                <ul class="pagination justify-content-center" style="width:fit-content">
                    <li class="page-item <?php if ($pagina <= 1) { echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if ($pagina <= 1) { echo '#'; } else { echo strtok($_SERVER['REQUEST_URI'], '?') . "?pagina=" . ($pagina - 1); } ?>">Previous</a>
                    </li>
                    <?php
                        for ($i = 1; $i <= $total_paginas; $i++) {
                            echo "<li class=\"page-item";
                            if ($pagina == $i) echo " active";
                            echo "\"><a class=\"page-link\" href='" . strtok($_SERVER['REQUEST_URI'], '?') . "?pagina=$i'>$i</a></li>";
                        }
                    ?>
                    <li class="page-item <?php if ($pagina >= $total_paginas) { echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if ($pagina >= $total_paginas) { echo '#'; } else { echo strtok($_SERVER['REQUEST_URI'], '?') . "?pagina=" . ($pagina + 1); } ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php } ?>
</div>
</div>
