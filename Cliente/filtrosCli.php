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
        <label for="codDes" style="text-decoration:underline">Codigo de promocion: </label>
        <input type="text" class="form-control" id="codDes" name="codDes"> </br>
    </div>
    <hr>
    <div class="form-group">
        <label for="fechaDes" style="text-decoration:underline">Fecha desde: </label>
        <input type="date" id="fechaDes" class="form-control mb-1" name="fechaDes"> 
        <label for="fechaHas" class="mt-0"style="text-decoration:underline">Fecha hasta: </label>
        <input type="date" id="fechaHas" name="fechaHas" class="form-control"> 
        <hr>
    </div>
    <div class="form-group" style="width: fit-content">
        <label for="rubro" style="text-decoration:underline">Rubro: </label>
        <input type="text" name="rubro" class="form-control" id="rubro" placeholder="indumentaria...">
    </div>

    <div class="form-group" style="width: fit-content">
        <label for="dia" >Dia de la semana: </label><br></br>
        <label for="dia[]" >Lunes: </label><input type="checkbox" name="dia[]" value="lunes"> <br>
        <label for="dia[]" >Martes: </label> <input type="checkbox" name="dia[]" value="martes"> <br>
        <label for="dia[]" >Miercoles: </label> <input type="checkbox" name="dia[]" value="miercoles"> <br>
        <label for="dia[]" >Jueves: </label> <input type="checkbox" name="dia[]" value="jueves"> <br>
        <label for="dia[]" >Viernes: </label> <input type="checkbox" name="dia[]" value="viernes"> <br>
        <label for="dia[]" >Sábado: </label><input type="checkbox" name="dia[]" value="sabado"> <br>
        <label for="dia[]" >Domingo: </label><input type="checkbox" name="dia[]" value="domingo"> <br>
    </div>
    <br> 
    <div class="form-group mx-auto" style="width: fit-content">
        <input type="submit" name="filtrar" class="btn btn-primary form-control px-4 py-2 mx-1 my-1" value="Filtrar">
        <input type="reset" value="Restablecer" class="btn form-control btn-secondary px-4 py-2 mx-1 my-1">
    </div>
</form>

<?php
$categoria = $_SESSION["categoriaCliente"];
if($categoria == 'inicial'){
    $busqueda = "AND categoriaCliente = '".$categoria."' ";
}elseif($categoria =='medium'){
    $busqueda = "AND categoriaCliente != 'premium' ";
}else{
    $busqueda = "";
}
$busqueda2 = "";

if (isset($_GET["filtrar"])) {
    if (isset($_GET['rubro']) && !empty($_GET['rubro'])) {
        $rubro=strtolower($_GET['rubro']);
        $busqueda2 .= "AND rubroLocal LIKE '%" . $rubro . "%' ";
    
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
                $busqueda .= "AND diaSemana LIKE ";
            } else {
                $busqueda .= "OR ";
            }
            $busqueda .= "'%" . $_GET['dia'][$i] . "%' ";
        }
    }
}

?>





