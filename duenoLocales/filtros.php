
<?php
$fec = "";
if($estoy == "verSolicitudDescuentos"){
    $borrar = "verSolicitudDescuentos.php";
    $fec= date('Y-m-d');
}else{
    $borrar = "gestionDescuentos.php";
    $fec = date('Y-m-d');
}
if ($estoy == 'informeDescuentos'){
    $fec = "";
}

?>
     
    
        <br>
    <form method="GET" >
        <input type="hidden" name="form_type" value="aplicar_filtros">    
    <h3>Filtros:  </h3>
<<<<<<< HEAD
    <div class="form-group " style="margin:0px; padding:0px">
        Codigo de promo: <input class="form-control" type="text" id="codDes" name="codDes" > </br> 
        <hr>
    </div>
    <div class="form-group" style="margin:0px; padding:0px">
        Fecha  desde:  <input type="date" class="form-control" id="fechaDes" name="fechaDes" min="<?php echo $fec ?>"> </br> 
    </div>
    <div class="form-group" style="margin:0px; padding:0px">
=======
    <div class="form-group ">
        Codigo de promo: <input class="form-control" type="text" id="codDes" name="codDes" > </br> 
        <hr>
    </div>
    <div class="form-group">
        Fecha  desde:  <input class="form-control" type="date" id="fechaDes" name="fechaDes" min="<?php $fec ?>"> </br> </br>
    </div>
    <div class="form-group">
>>>>>>> 00edd1ac870f527af4e72e9d9400acaa1c7769a7
        Fecha hasta: <input class="form-control" type="date" id="fechaHas" name="fechaHas"> <br> 
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
        <input type="submit" name="submit" value="Aplicar filtros" class="btn btn-primary w-100 m-1">
        <input type="reset" value="Restablecer" class="btn btn-secondary m-1">

    </div>
</form>

