<?php
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
    
    header("Location: index.php");
?>