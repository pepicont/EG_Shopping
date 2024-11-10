<?php
// Conexión a la base de datos
// Parámetros de paginación
include 'funciones.php';
$registros_por_pagina = 1; // Cambiado a 3 registros por página
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina - 1) * $registros_por_pagina;
$busqueda = 'WHERE estadoPromo = "activa"'; // Suponiendo que 'cod' es el valor que estás buscando
$paginacion = "";
$concat = "";
// Consultar la base de datos con WHERE y LIMIT para paginación
$cod = 'cod'; // Suponiendo que 'cod' es el valor que estás buscando
$query = "SELECT * FROM promociones $busqueda $paginacion";
$resultado = consultaSQL($query);

// Almacenar los resultados en un array
$promociones = [];
if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_array($resultado)) {
        $promociones[] = $fila;
        $concat .= " OR codLocal = '".$fila["codLocal"]."'";
    }
}

// Consultar los locales con paginación
$query2 = "SELECT * FROM locales WHERE (codLocal = '' $concat) AND estado = 'activo' LIMIT $registros_por_pagina OFFSET $offset";
$resultado2 = consultaSQL($query2);

if (mysqli_num_rows($resultado2) > 0) {
    while ($fila2 = mysqli_fetch_array($resultado2)) {
        foreach ($promociones as $fila) {
            echo $fila['textoPromo'] . '<br>';
            echo $fila2['nombreLocal'] . '<br>';
        }
    }
}
// Mostrar los resultados
if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_array($resultado)) {
        $concat .= " OR codLocal = '".$fila["codLocal"]."'";
        $query2 = "SELECT * FROM locales WHERE codLocal = '".$fila["codLocal"]."' AND estado = 'activo'";
        $resultado2 = consultaSQL($query2);
        if (mysqli_num_rows($resultado2) > 0) {
            while ($fila2 = mysqli_fetch_array($resultado2)) {
                echo $fila2['nombreLocal'] . '<br>';
            }
        }
    }
}


// Calcular el total de páginas
$sql_total = "SELECT COUNT(*) AS total FROM locales WHERE (codLocal = '' $concat) and estado = 'activo'";
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