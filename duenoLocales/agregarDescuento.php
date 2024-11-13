<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

include_once("../funciones.php");
$idusuario = $_SESSION["idUsuario"];
if (isset($_POST['submit'])) {
  $query1 = "SELECT * FROM usuarios WHERE codUsuario = '" . $idusuario . "'";
  $vresultado1 = consultaSQL($query1);
  if (mysqli_num_rows($vresultado1) > 0) {
    $id = $_POST['id'];
    $text = $_POST["textpro"];
    $fechades = $_POST["fechaini"];
    $fechahas = $_POST["fechahas"];
    $categoria = $_POST["categoria"];
    if (empty($id) && empty($text) && empty($fechades) && empty($fechahas) && empty($categoria)) {
      $seCreo = '2';
    } else {
      if (isset($_POST['dia'])) {
        // Convertir el arreglo a una cadena separada por comas
        $diasSeleccionados = implode(",", $_POST['dia']);
      } else {
        echo "Debe seleccionar al menos un día de la semana";
        $seCreo = '2';
      }
      $query2 = "SELECT * FROM locales WHERE codUsuario = '" . $idusuario . "' && codLocal = '" . $id . "'";
      $vresultado2 = consultaSQL($query2);
      if (mysqli_num_rows($vresultado2) > 0) {
        $query3 = "INSERT INTO promociones (textoPromo, fechaDesde, fechaHasta, categoriaCliente, diaSemana, estadoPromo, codLocal) VALUES 
        ('" . $text . "', '" . $fechades . "', '" . $fechahas . "', '" . $categoria . "', '" . $diasSeleccionados . "', 'pendiente', '" . $id . "')";
        consultaSQL($query3) or die(mysqli_error($link));
        $seCreo = '1';
      } else {
        echo "No se encontró el local seleccionado";
        $seCreo = '2';
      }
    } 
    }
    header("Location: gestionDescuentos.php?seCreo=" . $seCreo);
    exit();
  }
$query = "SELECT * FROM locales WHERE codUsuario = '" . $idusuario . "'";
$resultados = consultaSQL($query);

if(mysqli_num_rows($resultados)>0){
?>
  
  <button type="button" class="btn btn-primary w-100 " data-bs-toggle="modal" data-bs-target="#exampleModal">Crear descuento</button>

<?php } ?>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Crear descuento: </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="agregarDescuento.php" method="POST">
            <div class="form-group">
              Texto de la promo: <input type="text" class="form-control" required id="textpro" name="textpro">
            </div>
            <div class="form-group">
              Fecha de inicio: <input type="date" class="form-control" required id="fechaini" name="fechaini">
            </div>
            <div class="form-group">
              Fecha de fin: <input type="date" class="form-control" required id="fechahas" name="fechahas">
            </div>
              <div class="checkbox-group required">
                Dia de la semana: <br>
                Lunes: <input type="checkbox" name="dia[]" value="lunes" > <br>
                Martes: <input type="checkbox" name="dia[]" value="martes" > <br>
                Miércoles: <input type="checkbox" name="dia[]" value="miercoles" > <br>
                Jueves: <input type="checkbox" name="dia[]" value="jueves" > <br>
                Viernes: <input type="checkbox" name="dia[]" value="viernes" > <br>
                Sábado: <input type="checkbox" name="dia[]" value="sabado" > <br>
                Domingo: <input type="checkbox" name="dia[]" value="domingo" > <br>
              </div>
              <hr>
            <div class="form-group">
              <select  class="form-control"  name="categoria" id="categoria" require>
                <option value="" disabled selected>Categoria de descuento según cliente:</option>
                <option value="inicial">Inicial</option>
                <option value="medium">Medium</option>
                <option value="premium">Premium</option>
              </select>
              <hr>
            </div>
            <div class="form-group">
                <select name="id" id="id"  class="form-control" required>
                <option value="" disabled selected>Ingrese el local:</option>
                <?php 
                $query = "SELECT * FROM locales WHERE codUsuario = '" . $idusuario . "'";
                $resultados = consultaSQL($query);
                if (mysqli_num_rows($resultados) > 0) {
                  while ($fila = mysqli_fetch_array($resultados)) {
                  echo '<option value="'.$fila['codLocal'].'"> Local: '.$fila['nombreLocal'].'</option>';
                  }
                }
                ?>
                </select>
            </div>
            <div class="form-group modal-footer">
              <input type="submit" name="submit" value="Crear descuento" class="btn btn-primary w-100 m-1">
              <input type="reset" value="Restablecer" class="btn btn-secondary ">
              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

