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
                        <form action="listarNovedades.php" method="GET">
                            <div class="form-group mx-4 p-2" style="width: fit-content">
                                <label name="filtro1"for="filtro1">Filtro 1</label>
                                <input type="checkbox" class="form-check-input" name="filtro1"></br>
                            </div>
                            <div class="form-group mx-4 p-2" style="width: fit-content">
                                <label name="filtro2" for="filtro2">Filtro 2</label>
                                <input type="checkbox" class="form-check-input" name="filtro2"></br>

                            </div>
                            <div class="form-group mx-4 p-2" style="width: fit-content">
                                <label name="filtro3" for="filtro3">Filtro 3</label>
                                <input type="checkbox" class="form-check-input" name="filtro3"></br>

                            </div>
                            <div class="form-group mx-auto mx-4 p-2" style="width: fit-content">
                                <input type="submit" class="btn btn-primary px-4 py-2" value="Aplicar">
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
                        $query="SELECT * FROM novedades WHERE estado='activa'";
                        $resultados=consultaSQL($query);
                        if(mysqli_num_rows($resultados)>0){
                            while($fila=mysqli_fetch_array($resultados)){
                                if(!empty($_GET['idEditar'])){
                                    if($_GET['idEditar']==$fila['cod']){
                                        echo("<div class='card' style=' margin: 15px; width: 18rem;'>");
                                        echo("<div class='card-body'>");
                                        echo("<form method='GET' action='procesarNovedad.php'>");
                                            echo("<h5 class='card-title'><input name='nombreNovedad' type='text' class='form-group' value='".$_GET['nombreNovedad']."' required></h5>");
                                            echo("<h6 class='card-subtitle mb-2 text-muted'><select name='tipoUsuario' value='".$_GET['tipoUsuario']."'><option value='inicial'>Incial</option><option value='medium'>Medium</option><option value='premium'>Premium</option></select></h6>");
                                            echo("<p class='card-text'><input type='text' name='textoNovedad' class='form-group' value='".$_GET['textoNovedad']."' required></p>");
                                            echo("<input type='hidden' name='cod' value='".$fila['cod']."'>");
                                            echo("<input type='submit' name='novedadEditada' class='btn btn-success card-link' value='Guardar' />");
                                            echo("<input type='reset' class='btn btn-warning card-link' value='Limpiar' />");
                                            echo("</form>");
                                        echo("</div>");
                                        echo("</div>");
                                    }

                                }else{ 
                                    echo("<div class='card' style='width: 18rem;'>");
                                    echo("<div class='card-body'>");
                                    echo("<h5 class='card-title'>".$fila["nombreNovedad"]."</h5>");
                                    echo("<h6 class='card-subtitle mb-2 text-muted'>Categoría cliente: ".$fila["tipoUsuario"]."</h6>");
                                    echo("<p class='card-text'>".$fila["textoNovedad"]."</p>");
                                    echo("<a href='gestionarNovedades.php?idEditar=".$fila["cod"]."&nombreNovedad=".$fila["nombreNovedad"]."&tipoUsuario=".$fila["tipoUsuario"]."&textoNovedad=".$fila["textoNovedad"]."' class='btn btn-warning card-link'> Editar</a>");
                                    echo("<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal".$fila["cod"]."'>Eliminar</button>");
                                    /*modal */
                                    echo("<div class='modal fade' id='deleteModal".$fila["cod"]."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>");
                                    echo("<div class='modal-dialog' role='document'>");
                                    echo("<div class='modal-content'>");
                                    echo("<div class='modal-header'>");
                                    echo("<h5 class='modal-title' id='exampleModalLabel'>¿Esta seguro que desea borrar la novedad?</h5>");
                                    echo("<button type='button' class='close' data-dismiss='modal' aria-label='Close'>");
                                    echo("<span aria-hidden='true'>&times;</span>");
                                    echo("</button>");
                                    echo("</div>");
                                    echo("<div class='modal-body'>");
                                    echo("<p>Nombre:'".$fila["nombreNovedad"]."'</p></br>");
                                    echo("<p>Tipo de usuario:'".$fila["tipoUsuario"]."'</p></br>");
                                    echo("<p>texto:'".$fila["textoNovedad"]."'</p></br>");
                                    echo("</div>");
                                    echo("<div class='modal-footer'>");
                                    echo("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>");
                                    echo("<button type='button' class='btn btn-danger'><a href='procesarNovedad.php?idEliminar=".$fila["cod"]."' class='btn btn-danger<!--card-link -->'>Confirmar</a></button>");
                                    echo("</div>");
                                    echo("</div>");
                                    echo("</div>");
                                    echo("</div>");
                                    /* modal cierre*/
                                    echo("</div>");
                                    echo("</div>"); 

                                }
                                   
                                
                           
                                
                            }
                        }
                        else{
                            echo"No hay novedades cargadas activas";
                        }

                     
                     ?>
                    </div> 
                     
                </div>
            </div>
        </div>
    </div>


    <?php include("../footer.php");?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>