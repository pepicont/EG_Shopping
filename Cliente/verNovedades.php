<?php
$lugar ="cliente";
session_start();
include_once("../funciones.php");
actualizarNovedades();
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
$registros_por_pagina = 6;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina - 1) * $registros_por_pagina;
$paginacion = "LIMIT $offset, $registros_por_pagina";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novedades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilos/style1.css">
</head>
<header>
    <?php
        include("../header.php");
    ?>
</header>
<body>
    <div class="row">
        <div class="col-12">
            <?php 
            $estoy="verNovedades";
            include("../breadCrumbs.php");
            ?>
        </div>
    </div>
    <h1 class="bienvenida text-center my-4">Novedades</h1>
    <?php 
        $query = "SELECT * FROM novedades " . $busqueda . " AND fechaHasta >= '" . date("Y-m-d") . "' AND estado = 'activa'  $paginacion";
        $resultado = consultaSQL($query);
        while ($fila = mysqli_fetch_array($resultado)) {
    ?>  
        <div class="container" style="width: 60%;">
            <div class="card" style="margin: 10px; padding:10px; border: 1px solid rgb(164, 88, 236);">
                <div style="height:80%">
                    <h5 class="card-title" style="  ;padding-bottom: 5px; margin-bottom: 20px;text-shadow: 2px 2px hsl(242, 68%, 90%);"><b>   <?php echo($fila["nombreNovedad"]) ?></b></h5> 
                    <p class="card-text" style="text-indent: 30px; font-weight:500;font-size:20px;"> <?php echo($fila["textoNovedad"]) ?></p>
                </div>
            </div>
        </div>
    <?php
        }
        // Calcular el total de páginas
        $sql_total = "SELECT COUNT(*) AS total FROM novedades " . $busqueda . " AND fechaHasta >= '" . date("Y-m-d") . "' AND estado = 'activa' ";
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
<body>
    <footer>
        <?php include("../footer.php") ?>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</html>