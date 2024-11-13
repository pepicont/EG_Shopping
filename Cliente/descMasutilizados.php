<?php
$fecha = date("Y-m-d");
$array = [];
$query = "SELECT * FROM promociones WHERE estadoPromo = 'activa' AND fechaDesde <= '$fecha' AND fechaHasta >= '$fecha'";
$resultado = consultaSQL($query);
if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_array($resultado)) {
        $query2 = "SELECT * FROM uso_promociones WHERE estado = 'aceptada' AND codPromo = '" . $fila['cod'] . "'";
        $resultado2 = consultaSQL($query2);
        $cant = mysqli_num_rows($resultado2);

        if ($cant > 0) {
            if (count($array) < 6) {
                $array[] = ['promo' => $fila, 'count' => $cant];
            } else {
                usort($array, function($a, $b) {
                    return $b['count'] - $a['count'];
                });
                if ($cant > $array[5]['count']) {
                    $array[5] = ['promo' => $fila, 'count' => $cant];
                }
            }
        }
    }
}

usort($array, function($a, $b) {
    return $b['count'] - $a['count'];
});
if (count($array) > 0) {
    echo '<h5> Descuentos mas populares : </h5>';
}
?>

<div class="container" style="width: 100%; display: flex; flex-wrap: wrap; justify-content: space-around;">
    <?php foreach ($array as $descuento) { 
        $query = "SELECT * FROM locales WHERE codLocal = '" . $descuento['promo']['codLocal'] . "'";
        $resultado = consultaSQL($query);
        while ($fila = mysqli_fetch_array($resultado)) {
            $local = $fila['nombreLocal'];
        }
        ?>
        <div class="card" style="margin: 10px; padding:10px; width: 300px;">
            <div style="height:80%">
                <h5 class="card-title"><b></b> <?php echo htmlspecialchars($descuento['promo']['textoPromo']); ?></h5>
                <p class="card-text"><b></b> <?php echo htmlspecialchars($local); ?></p>
                <p class="card-text"><b></b> <?php echo htmlspecialchars($descuento['promo']['diaSemana']); ?></p>
            </div>
        </div>
    <?php } ?>
</div>
