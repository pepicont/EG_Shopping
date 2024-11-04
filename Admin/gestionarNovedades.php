<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar novedades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../estilos/style1.css" rel="stylesheet">
</head>
<body>
    <?php
    $lugar="admin";
    include_once("../funciones.php");
    include("../header.php");
    if ($login==true && $tipoUsuario=="administrador"){
    ?>
    
    <!-- Your content here -->
    <div class="container mt-4">
        <div class="row w-100" style="display:flex; justify-content: space-around">
            <div class="col-4 ">
                <div class="row">
                    <h3>Crear novedad</h3>
                        <form action="procesarNovedad.php" method="GET">
                            <div class="form-group mx-4 p-2" style="width: fit-content">
                                <label name="nombreNovedad"for="nombreNovedad">Nombre: </label>
                                <input type="text" class="form-group" name="nombreNovedad"></br>
                            </div>
                            <div class="form-group mx-4 p-2" style="width: fit-content">
                                <label name="tipoUsuario" for="tipoUsuario">Tipo de Usuario: </label>
                                <select name='tipoUsuario' value="inicial">
                                    <option name='tipoUsuario' value='inicial'>Inicial</option>
                                    <option name='tipoUsuario' value='medium'>Medium</option>
                                    <option name='tipoUsuario' value='premium'>Premium</option>
                                </select>
                            </div>
                            <div class="form-group mx-4 p-2" style="width: fit-content">
                                <label name="textoNovedad"for="textoNovedad">Texto: </label>
                                <textarea name="textoNovedad" id="texto" style="resize: none; vertical-align: top; margin-top: 5px; margin-bottom: 5px;" cols="21" rows="4"></textarea>

                            </div>
                            <div class="form-group mx-auto mx-4 p-2" style="width: fit-content">
                                <input type="submit" name="nuevaNovedad" class="btn btn-primary px-4 py-2" value="Crear">
                            </div>
                        </form>
                </div>
                <div class="row">
                    <div class="container mt-2" style="border: 2px solid #26014be1; border-radius:20px;">
                        <h3 class="mt-4 ">Filtros de busqueda:</h3>
                        <form method="GET">
                            <div class="form-group mx-4 p-2" style="width: fit-content">
                                <label  for="inicial">Inicial</label>
                                <input type="checkbox" class="form-check-input" name="inicial" value="inicial"></br>
                            </div>
                            <div class="form-group mx-4 p-2" style="width: fit-content">
                                <label for="medium">Medium</label>
                                <input type="checkbox" class="form-check-input" name="medium" value="medium"></br>

                            </div>
                            <div class="form-group mx-4 p-2" style="width: fit-content">
                                <label for="premium">Premium</label>
                                <input type="checkbox" class="form-check-input" name="premium" value="premium"></br>

                            </div>
                            <div class="form-group mx-auto mx-4 p-2" style="width: fit-content">
                                <input type="submit" class="btn btn-primary px-4 py-2" name="enviar" value="Aplicar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-7  p-1 ml-4">
               <div class="container ml-4">
                    <h3>Lista de novedades</h3>
                    <!-- generador de tarjetas para aprobar/denegar -->
                        
                        <!--Antes de traernos todas las novedades, eliminamos alguna que haya sido seleccionada-->
                        <div class="container listado"> 
                            <?php 
                             include_once("../funciones.php");
                             $busqueda = "estado='activa' "; 
                             $contador=0;
                             if(!empty($_GET['enviar'])){   
                                 if(!empty($_GET['inicial'])){
                                     $busqueda .= "AND tipoUsuario = '" . $_GET["inicial"] . "' ";
                                     $contador++;
                                 }
                                 if(!empty($_GET['medium'])){
                                     if ($contador>0){
                                         $operador="OR ";
                                     }else{$operador="AND ";}
                                     $busqueda .= "".$operador."tipoUsuario = '".$_GET["medium"]."' ";
                                     $contador++;
                                 }   
                                 if(!empty($_GET['premium'])){
                                     if($contador>0){
                                         $operador="OR ";
                                     }else{$operador="AND ";}
                                     
                                     $busqueda .= "".$operador."tipoUsuario = '".$_GET["premium"]."' ";}
                                 
                                 }
                         
                            $query="SELECT * FROM novedades WHERE ".$busqueda."";
                            $resultados=consultaSQL($query);
                            if(mysqli_num_rows($resultados)>0){
                                while($fila=mysqli_fetch_array($resultados)){
                                    if(!empty($_GET['idEditar']) && $_GET['idEditar'] == $fila['cod']){
                                        ?>
                                        <div class='card' style='margin: 15px; width: 18rem;'>
                                            <div class='card-body'>
                                                <form method='GET' action='procesarNovedad.php'>
                                                    <h5 class='card-title'>
                                                        <input name='nombreNovedad' type='text' class='form-group' value='<?php echo $_GET['nombreNovedad']; ?>' required>
                                                    </h5>
                                                    <h6 class='card-subtitle mb-2 text-muted'>
                                                        <select name='tipoUsuario' value='<?php echo $_GET['tipoUsuario']; ?>'>
                                                            <option value='inicial'>Inicial</option>
                                                            <option value='medium'>Medium</option>
                                                            <option value='premium'>Premium</option>
                                                        </select>
                                                    </h6>
                                                    <p class='card-text'>
                                                        <input type='text' name='textoNovedad' class='form-group' value='<?php echo $_GET['textoNovedad']; ?>' required>
                                                    </p>
                                                    <input type='hidden' name='cod' value='<?php echo $fila['cod']; ?>'>
                                                    <input type='submit' name='novedadEditada' class='btn btn-success card-link' value='Guardar'>
                                                    <input type='reset' class='btn btn-warning card-link' value='Limpiar'>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                    } else { 
                                        ?>
                                        <div class='card' style='width: 18rem;'>
                                            <div class='card-body'>
                                                <h5 class='card-title'><?php echo $fila["nombreNovedad"]; ?></h5>
                                                <h6 class='card-subtitle mb-2 text-muted'>Categoría cliente: <?php echo $fila["tipoUsuario"]; ?></h6>
                                                <p class='card-text'><?php echo $fila["textoNovedad"]; ?></p>
                                                <a href='gestionarNovedades.php?idEditar=<?php echo $fila["cod"]; ?>&nombreNovedad=<?php echo $fila["nombreNovedad"]; ?>&tipoUsuario=<?php echo $fila["tipoUsuario"]; ?>&textoNovedad=<?php echo $fila["textoNovedad"]; ?>' class='btn btn-warning card-link'>Editar</a>
                                                <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal<?php echo $fila["cod"]; ?>'>Eliminar</button>
                                                <!-- Modal -->
                                                <div class='modal fade' id='deleteModal<?php echo $fila["cod"]; ?>' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                                    <div class='modal-dialog' role='document'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                <h5 class='modal-title' id='exampleModalLabel'>¿Está seguro que desea borrar la novedad?</h5>
                                                                <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                                                                    <span aria-hidden='true'>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class='modal-body'>
                                                                <p>Nombre: <?php echo $fila["nombreNovedad"]; ?></p>
                                                                <p>Tipo de usuario: <?php echo $fila["tipoUsuario"]; ?></p>
                                                                <p>Texto: <?php echo $fila["textoNovedad"]; ?></p>
                                                            </div>
                                                            <div class='modal-footer'>
                                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                                                <button type='button' class='btn btn-danger'>
                                                                    <a href='procesarNovedad.php?idEliminar=<?php echo $fila["cod"]; ?>' class='btn btn-danger'>Confirmar</a>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal cierre -->
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            } else {
                                echo "No hay novedades cargadas activas";
                            }
                            ?>
                        </div>
            </div>
        </div>
        <?php if(!empty($_GET['success'])){
                    if($_GET['success']=='1'){
                        echo '<div class="alert alert-primary mt-3" style="width: fit-content" role="alert">
                            La novedad fue creada con éxito
                        </div>';
                    } elseif($_GET['success']=='2'){
                        echo '<div class="alert alert-secondary mt-3" style="width: fit-content" role="alert">
                           La novedad fue editada con éxito
                        </div>';
                    } elseif($_GET['success']=='3'){
                        echo '<div class="alert alert-danger mt-3" style="width: fit-content" role="alert">
                            La novedad fue eliminada
                        </div>';
                    }
                }
        ?>
                            
    
    </div>    
    <?php }
    else{
        echo "Solo los administradores tienen acceso a esta sección";
    }?>

    <?php include("../footer.php");?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>