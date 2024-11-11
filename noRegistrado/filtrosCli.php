<h3>Filtros:</h3> </br>
<form method="GET">
    <div class="form-group p-2" style="width: fit-content">
        <label for="nombreLocal" style="text-decoration:underline">Nombre del local: </label>
        <input type="text" name="nombreLocal" class="form-control" id="nombreLocal" placeholder="Sport 78">
    </div>
    <div class="form-group p-2" style="width: fit-content">
        <label for="ubicacionLocal" style="text-decoration:underline">Ubicación: </label>
        <input type="text" name="ubicacionLocal" class="form-control" id="ubicacionLocal" placeholder="Ala Sur">
    </div>
    <div class="form-group">
        Codigo de promo: <input type="text" id="codDes" name="codDes"> </br>
    </div>
    <hr>
    <div class="form-group">
        Fecha desde: <input type="date" id="fechaDes" name="fechaDes"> </br> </br>
    </div>
    <div class="form-group">
        Fecha hasta: <input type="date" id="fechaHas" name="fechaHas"> <br> 
        <hr>
    </div>
    <div class="form-group" style="width: fit-content">
        Rubros: <br>
        Ropa: <input type="checkbox" name="rubros[]" value="ropa"> <br>
        Maquillaje: <input type="checkbox" name="rubros[]" value="maquillaje"> <br>
        Calzado: <input type="checkbox" name="rubros[]" value="calzado"> <br>
        Perfumería: <input type="checkbox" name="rubros[]" value="perfumeria"> <br>
    </div>
    <div class="form-group" style="width: fit-content">
        Dia de la semana: <br>
        Lunes: <input type="checkbox" name="dia[]" value="lunes"> <br>
        Martes: <input type="checkbox" name="dia[]" value="martes"> <br>
        Miércoles: <input type="checkbox" name="dia[]" value="miercoles"> <br>
        Jueves: <input type="checkbox" name="dia[]" value="jueves"> <br>
        Viernes: <input type="checkbox" name="dia[]" value="viernes"> <br>
        Sábado: <input type="checkbox" name="dia[]" value="sabado"> <br>
        Domingo: <input type="checkbox" name="dia[]" value="domingo"> <br>
    </div>
    <br> 
    <div class="form-group mx-auto" style="width: fit-content">
        <input type="submit" name="filtrar" class="btn btn-primary px-4 py-2" value="filtrar">
        <a href="verDescuentos.php" class="btn btn-primary w-100 m-1">Borrar filtros</a>
    </div>
</form>

<?php
$busqueda2 = "";

if (isset($_GET["filtrar"])) {
    if (isset($_GET['rubros']) && !empty($_GET['rubros'])) {
        $cantRubros = count($_GET['rubros']);
        for ($t = 0; $t < $cantRubros; $t++) {
            if ($t == 0) {
                $busqueda2 .= "AND ";
            } else {
                $busqueda2 .= "OR ";
            }
            $busqueda2 .= "rubroLocal LIKE '%" . $_GET['rubros'][$t] . "%' ";
        }
    }
    if (isset($_GET['nombreLocal']) && !empty($_GET['nombreLocal'])) {
        $busqueda2 .= "AND nombreLocal LIKE '%" . $_GET['nombreLocal'] . "%' ";
    }
    if (isset($_GET['ubicacionLocal']) && !empty($_GET['ubicacionLocal'])) {
        $busqueda2 .= "AND ubicacionLocal LIKE '%" . $_GET['ubicacionLocal'] . "%' ";
        
    }
    if (isset($_GET['codDes']) && !empty($_GET['codDes'])) {
        $busqueda .= "AND cod = '" . $_GET['codDes'] . "' ";
    }
    if (isset($_GET['fechaDes']) && !empty($_GET['fechaDes'])) {
        $busqueda .= "AND fechaDesde <= '" . $_GET['fechaDes'] . "' ";
    }
    if (isset($_GET['fechaHas']) && !empty($_GET['fechaHas'])) {
        $busqueda .= "AND fechaHasta >= '" . $_GET['fechaHas'] . "' ";
    }
    if (isset($_GET['dia']) && !empty($_GET['dia'])) {
        $numDias = count($_GET['dia']);
        for ($i = 0; $i < $numDias; $i++) {
            if ($i == 0) {
                $busqueda .= "AND ";
            } else {
                $busqueda .= "OR ";
            }
            $busqueda .= "diaSemana LIKE '%" . $_GET['dia'][$i] . "%' ";
        }
    }
}
?>





