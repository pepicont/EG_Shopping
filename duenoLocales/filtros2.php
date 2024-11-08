
<?php
if($estoy == "verSolicitudDescuentos"){
    $borrar = "verSolicitudDescuentos.php";
}else{
    $borrar = "gestionDescuentos.php";
}
?>
    <?php
    if($estoy == "gestionDescuentos"){
        $lugar = 'mobile';
        include("agregarDescuento.php");
    }
        ?>
    
        <br>
<form method="GET" >
<input type="hidden" name="form_type" value="mobile">
    <h3>Filtros:  </h3>
    <div class="form-group ">
        Codigo de promo: <input type="text" id="codDes" name="codDes" > </br> 
        <hr>
    </div>
    <div class="form-group">
        Fecha  desde:  <input type="date" id="fechaDes" name="fechaDes"> </br> </br>
    </div>
    <div class="form-group">
        Fecha hasta: <input type="date" id="fechaHas" name="fechaHas"> <br> 
        <hr>
    </div>
    <div class="form-group">
        </hr>
        <label for="categoria">Categoria de la promocion:</label>
        </br> 
        <select name="categoria" id="categoria" class="form-control">
            <option value="0">Selecciona una opcion:</option>
            <option value="inicial">Inicial</option>
            <option value="medium">Medium</option>
            <option value="premium">Premium</option>
        </select>
        <hr>
    </div>
    <div class="form-group ">
        </hr>
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
    <div class="form-group mx-auto text-center w-100 p-2 d-flex justify-content-between">
        <input type="submit" name="submit-mobile" value="Aplicar filtros" class="btn btn-primary w-100 m-1">
        <a href="<?php echo($borrar)?>" class="btn btn-primary w-100 m-1">Borrar filtros</a>
    </div>
</form>


