<h3>Filtros:</h3> </br>
<form  method="GET">
    <div class="form-group p-2" style="width: fit-content">
        <label for="codigoLocal" style="text-decoration:underline">Codigo de local: </label>
        <input type="text" name="codigoLocal" class="form-control" id="codigoLocal" placeholder="1...">
    </div>
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
        Lunes: <input type="checkbox" name="dia[]" value="l"> <br>
        Martes: <input type="checkbox" name="dia[]" value="m"> <br>
        Miércoles: <input type="checkbox" name="dia[]" value="mi"> <br>
        Jueves: <input type="checkbox" name="dia[]" value="j"> <br>
        Viernes: <input type="checkbox" name="dia[]" value="v"> <br>
        Sábado: <input type="checkbox" name="dia[]" value="s"> <br>
        Domingo: <input type="checkbox" name="dia[]" value="d"> <br>
    </div>
    <br> 
    <div class="form-group mx-auto" style="width: fit-content">
        <input type="submit" name="filtrar" class="btn btn-primary px-4 py-2" value="filtrar">
    </div>
</form>

<?php
$categoria = $_SESSION["categoriaCliente"];
$busqueda = "AND categoriaCliente = '".$categoria."' ";
if (isset($_GET["filtrar"])) {
    if (isset($_GET['rubros'])) {
        $cantRubros = count($_GET['rubros']);
        for ($t = 0; $t < $cantRubros; $t++) {
            if ($t == 0) {
                $busqueda .= "AND ";
            } else {
                $busqueda .= "OR ";
            }
            $busqueda .= "rubros LIKE '%" . $_GET['rubros'][$t] . "%' ";
        }
    }
    if (isset($_GET['dia'])) {
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
    $query = "SELECT * FROM promociones WHERE estado = 'activa' " . $busqueda;
    $rta = consultaSQL($query);

}
    







?>