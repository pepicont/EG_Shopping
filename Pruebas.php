
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilos/style1.css">

</head>
<body>
    <header>
        <?php include("header.php"); ?>
    </header>
    <main>
        <?php include("cliente/descMasUtilizados.php"); ?>
    </main>
    <footer>
        <?php include("footer.php"); ?>
    </footer>
</body>
</html>




























?>
<br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
// Conexión a la base de datos
// Parámetros de paginación
include 'funciones.php';
$registros_por_pagina = 5;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina - 1) * $registros_por_pagina;
$busqueda = 'WHERE estadoPromo = "activa"'; // Suponiendo que 'cod' es el valor que estás buscando
$paginacion = "LIMIT $offset, $registros_por_pagina";
// Consultar la base de datos con WHERE y LIMIT para paginación
$cod = 'cod'; // Suponiendo que 'cod' es el valor que estás buscando
$query = "SELECT * FROM promociones $busqueda $paginacion";
$resultado = consultaSQL($query);

// Mostrar los resultados
if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_array($resultado)) {
        echo $fila['cod'] . '<br>';
    } 
}

// Calcular el total de páginas
$sql_total = "SELECT COUNT(*) AS total FROM promociones $busqueda";
$total_resultado = consultaSQL($sql_total)->fetch_assoc();
$total_paginas = ceil($total_resultado['total'] / $registros_por_pagina);

// Generar y mostrar los enlaces de paginación
if ($total_paginas > 1) { ?>
    <div class="container w-100 d-flex justify-content-center">
        <nav aria-label="..." class="mx-auto" style="width:fit-content">
            <ul class="pagination justify-content-center" style="width:fit-content">
                <li class="page-item <?php if($pagina <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pagina <= 1){ echo '#'; } else { echo strtok($_SERVER['REQUEST_URI'], '?') . "?pagina=" . ($pagina - 1); } ?>">Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $total_paginas; $i++) {
                    echo "<li class=\"page-item";
                    if ($pagina == $i) echo " active";
                    echo "\"><a class=\"page-link\" href='" . strtok($_SERVER['REQUEST_URI'], '?') . "?pagina=$i'>$i</a></li>";
                }
                ?>
                <li class="page-item <?php if($pagina >= $total_paginas){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pagina >= $total_paginas){ echo '#'; } else { echo strtok($_SERVER['REQUEST_URI'], '?') . "?pagina=" . ($pagina + 1); } ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
<?php } ?>