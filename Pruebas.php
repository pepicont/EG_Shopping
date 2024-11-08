
            <!-- Filtros -------------------------------------------------------------------------------------------------------------------------------------------------->
            <!-- Filtros -------------------------------------------------------------------------------------------------------------------------------------------------->
            <!-- Filtros -------------------------------------------------------------------------------------------------------------------------------------------------->
            <!-- Filtros -------------------------------------------------------------------------------------------------------------------------------------------------->

            <?php
            if($estoy == "verSolicitudDescuentos"){
              $borrar = "verSolicitudDescuentos.php";
            }else{
              $borrar = "gestionDescuentos.php";
            }
            ?>
            <div class="container" >
              <?php
              if($estoy == "gestionDescuentos"){
                if (session_status() == PHP_SESSION_NONE) {
                  session_start();
                }
                include_once("../funciones.php");
                $idusuario = $_SESSION["idUsuario"];
                $seCreo = null;

                if(isset($_POST['submit']) && $_POST['form_type'] == 'crear_descuento'){
                  $query1 = "SELECT * FROM usuarios WHERE codUsuario = '".$idusuario."'"; 
                  $vresultado1 = consultaSQL($query1);
                  if (mysqli_num_rows($vresultado1) > 0) {
                    $id = $_POST['id'];
                    $text = $_POST["textpro"];
                    $fechades = $_POST["fechaini"];
                    $fechahas = $_POST["fechahas"]; 
                    $categoria = $_POST["categoria"];
                    if (isset($_POST['dia'])) {
                      // Convertir el arreglo a una cadena separada por comas
                      $diasSeleccionados = implode(",", $_POST['dia']);
                    } else {
                      $seCreo = '2';
                    }
                    $query2 = "SELECT * FROM locales WHERE codUsuario = '".$idusuario."' && codLocal = '".$id."'"; 
                    $vresultado2 = consultaSQL($query2);
                    if (mysqli_num_rows($vresultado2) > 0) {
                      $query3 = "INSERT INTO promociones (textoPromo, fechaDesde, fechaHasta, categoriaCliente, diaSemana, estadoPromo, codLocal) VALUES 
                      ('".$text."', '".$fechades."', '".$fechahas."', '".$categoria."', '".$diasSeleccionados."', 'pendiente', '".$id."')";
                      consultaSQL($query3) or die(mysqli_error($link));
                      $seCreo = '1';
                    } else {
                      $seCreo = '2';
                    }
                  }
                  if(isset($seCreo)){
                    if($seCreo == '1' ){
                      $_SESSION['message'] = '<div class="alert alert-primary mt-3" style="width: fit-content" role="alert">
                      El descuento fue creado con éxito
                      </div>';
                    } elseif($seCreo == '2'){
                      $_SESSION['message'] = '<div class="alert alert-secondary mt-3" style="width: fit-content" role="alert">
                      El descuento no se ha podido crear.
                      </div>';
                    } 
                  }
                  header("Location: gestionDescuentos.php");
                  exit();
                }
              ?>
              <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">Crear descuento</button>
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Crear descuento: </h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="agregarDescuento.php" method="POST">
                        <input type="hidden" name="form_type" value="crear_descuento">
                        <div class="form-group">
                          Texto de la promo: <input type="text" required id="textpro" name="textpro">
                        </div>
                        <div class="form-group">
                          Fecha de inicio: <input type="date" required id="fechaini" name="fechaini">
                        </div>
                        <div class="form-group">
                          Fecha de fin: <input type="date" required id="fechahas" name="fechahas">
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
                        <div class="form-group">
                          <hr>
                          Categoria de descuento según cliente: <br>
                          Inicial: <input type="radio" class="form-check-input" aria-describedby="helpId" value="inicial" name="categoria"> <br>
                          Medium: <input type="radio" class="form-check-input" aria-describedby="helpId" value="medium" name="categoria"> <br>
                          Premium: <input type="radio" class="form-check-input" aria-describedby="helpId" value="premium" name="categoria"> <br>
                        </div>
                        <div class="form-group">
                          Ingrese el codigo de local: <input type="number" id="id" name="id" required>
                        </div>
                        <div class="form-group modal-footer">
                          <input type="submit" name="submit" value="Crear descuento" class="btn btn-primary w-100 m-1">
                          <a href="gestionDescuentos.php" class="btn btn-primary w-100 m-1">volver</a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              }
              ?>
              <form method="GET" >
                <input type="hidden" name="form_type" value="aplicar_filtros">
                <br>
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
                  <input type="submit" name="submit" value="Aplicar filtros" class="btn btn-primary w-100 m-1">
                  <a href="<?php echo($borrar)?>" class="btn btn-primary w-100 m-1">Borrar filtros</a>
                </div>
              </form>
            </div>
            <!-- Filtros -------------------------------------------------------------------------------------------------------------------------------------------------->
            <!-- Filtros -------------------------------------------------------------------------------------------------------------------------------------------------->
            <!-- Filtros -------------------------------------------------------------------------------------------------------------------------------------------------->
            <!-- Filtros -------------------------------------------------------------------------------------------------------------------------------------------------->

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form_type'] == 'crear_descuento') {
              // Código para manejar el formulario de crear descuento
            } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['form_type'] == 'aplicar_filtros') {
              // Código para manejar el formulario de aplicar filtros
            }
            ?>
