<?php
    $lugar="admin";
    include_once("../funciones.php");
    $estoy="gestionarLocales";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InformeDescuentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../estilos/style1.css" rel="stylesheet">
</head>
    
    <header>
        <?php include("../header.php"); ?>
    </header>
    <body>
    <?php if ($login==true && $tipoUsuario=="administrador"){
    }else{
        exit(header("Location: index.php"));
    }
    ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php 
                    include("../breadCrumbs.php");
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php if(!empty($_GET['success'])){
                        if($_GET['success']=='editado'){
                            echo '<div class="alert alert-primary mt-3 mx-auto" style="width: fit-content" role="alert">
                                Local Editado con éxito
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        } elseif($_GET['success']=='eliminado'){
                            echo '<div class="alert alert-secondary mt-3 mx-auto" style="width: fit-content" role="alert">
                            Local dado de baja
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        
                    } elseif($_GET['success']=='creado'){
                        echo '<div class="alert alert-success mt-3 mx-auto" style="width: fit-content" role="alert">
                        Local creado con éxito
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';}
                    elseif($_GET['error']=='usuario'){
                            echo '<div class="alert alert-danger mt-3 mx-auto" style="width: fit-content" role="alert">
                            El código de dueño ingresado no existe o no está activo
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';}
                }
                    ?>
                </div>
            </div>
            <div class="row">  
                <div class="col-12 col-md-4 col-lg-3">
                    <!-- div que va a contener el form de crear locales -->
                     <div class="filtros d-md-block d-flex justify-content-center" >

                        <form method="POST" action="procesarLocal.php" enctype="multipart/form-data">
                            <div class="form-group p-2" style="width: fit-content">
    
                                <label for="codUsuario" style="text-decoration:underline">Código del dueño: </label>
                                <input type="text" name="codUsuario" class="form-control mx-auto" id="codUsuario" required>

                            </div>
                            <div class="form-group p-2" style="width: fit-content">
    
                                <label for="nombreLocal" style="text-decoration:underline">Nombre del local: </label>
                                <input type="text" name="nombreLocal" class="form-control mx-auto" id="nombreLocal" required>

                            </div>
                            
                            <div class="form-group p-2" style="width: fit-content">
  
                                    <label for="imagenLocal" style="text-decoration:underline">Imagen del local: </label>
                                    <input type="file" name="imagenLocal" class="form-control mx-auto" id="imagenLocal" required accept="image/*">

                            </div>
                            <div class="form-group p-2 " style="width: fit-content">
  
                                <label for="ubiacionLocal" style="text-decoration:underline">Ubicación: </label>
                                <textarea class="form-control mx-auto" name="ubicacionLocal" id="ubicacionLocal" placeholder="Primer piso, Ala sur" cols="25" rows="3" required style="resize: none; margin-bottom: 10px; margin-left: 10px"></textarea>

                            </div>
                            <div class="form-group p-2" style="width: fit-content">
  
                                <label for="rubroLocal" style="text-decoration:underline">Rubro: </label>
                                <input type="text" name="rubroLocal" class="form-control mx-auto" id="rubroLocal" >

                            </div>
                            <div class="form-group mx-auto p-2" style="width: fit-content">
                                    <input type="submit" name="crearLocal" class="btn btn-primary px-4 py-2 mx-auto" value="Crear">
                                    <input type="reset" value="Restablecer" class="btn btn-secondary ">
                            </div>

                            

                        </form>

                    </div>
                               
                    <div class="filtros d-md-block d-flex justify-content-center" >
                        <form method="GET">
                                <div class="form-group p-2" style="width: fit-content">
                                    <label for="codigoLocal" style="text-decoration:underline">Codigo: </label>
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

                                
                                <div class="form-group p-2" style="width: fit-content">
                                    
                                    <label for="rubro" style="text-decoration:underline">Rubro: </label>
                                    <input type="text" name="rubro" class="form-control" id="rubro" placeholder="indumentaria...">
                                </div>


                                <div class="form-group mx-auto p-2" style="width: fit-content">
                                    <input type="submit" name="filtrar" class="btn btn-primary px-4 py-2" value="buscar">
                                </div>


                                
                        </form>
                    </div>
                    
                </div>
                <div class="col-12 col-md-8 col-lg-9 text-center">
                    <div class="row">
                        <h2>Locales</h2>
                        <div class="listado px-auto">
                            <?php
                                // Logica de la paginación
                                $limite = 6; // cantidad de resultados que se muestran en la página
                                if (isset($_GET["pagina"])) {
                                    $pagina  = $_GET["pagina"];
                                } else {
                                    $pagina = 1;
                                }
                                $principio = ($pagina - 1) * $limite; // el número del primer resultado que se mostrará en la página actual. Esto va a ir cambiando a medida que se avance de página

                                 //Lo que hace el Limit es que solo muestra los resultados que estan entre el principio y el limite
                                $busqueda="";
                                include_once("../duenoLocales/Validaciones.php");
                                $sql="SELECT * FROM locales WHERE estado='activo' $busqueda LIMIT $principio, $limite";
                                $resultado=consultaSQL($sql);
                                if(mysqli_num_rows($resultado)==0){
                                    echo("No hay locales");
                                    $noHayResultados=true;
                                }else{
                                    $noHayResultados=false;
                                while($local=mysqli_fetch_array($resultado)){ 
                                    if(!empty($_GET['idEditar']) && $_GET['idEditar']==$local['codLocal']){
                                    
                                
                            ?>
                                <!-- Tarjeta para editar locales -->
                                <div class="card mx-auto" style="width:210px; ">
                                    <img src="<?php echo $local['imagen'] ?>" class="card-img-top" alt="..." style="height:200px; width:200px; margin: 5px;"><!-- Acá iría la imagen del local -->
                                    <div class="card-body text-center">
                                        <form action='procesarLocal.php' method='POST'>
                                            <input type='hidden' name='codLocal' value='<?php echo $local["codLocal"]; ?>'>
                                            <div class='form-group'>
                                                <label for='nombreLocal<?php echo $local["codLocal"]; ?>' class='visually-hidden'>Nombre del local:</label>
                                                <input type='text' class='form-control' id='nombreLocal<?php echo $local["codLocal"]; ?>' name='nombreLocal' value='<?php echo $local["nombreLocal"]; ?>'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='ubicacionLocal<?php echo $local["codLocal"]; ?>' class='visually-hidden'>Ubicación:</label>
                                                <input type='text' class='form-control' id='ubicacionLocal<?php echo $local["codLocal"]; ?>' name='ubicacionLocal' value='<?php echo $local["ubicacionLocal"]; ?>'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='rubroLocal<?php echo $local["codLocal"]; ?>' class='visually-hidden'>Rubro:</label>
                                                <input type='text' class='form-control' id='rubroLocal<?php echo $local["codLocal"]; ?>' name='rubroLocal' value='<?php echo $local["rubroLocal"]; ?>'>
                                            </div>
                        
                                            <button type='submit' name='editar' class='btn btn-primary'>Guardar</button>
                                        </form>
                                        
                                    </div>
                                </div>
                                <?php }else{?>
                                    
                                

                                <!-- Tarjeta para mostrar locales -->

                                <div class="card " style=" margin: 10px; width:210px; ">
                                    
                                    <img src="<?php echo $local['imagen'] ?>" class="card-img-top" alt="Foto del local" style="height:200px; width:200px;margin: 5px;">
                                    <h5><?php echo($local['codLocal']) ?></h5>
                                    <div class="card-body pt-0">
                                        <h5 class="card-title"><?php echo($local['nombreLocal']) ?></h5>
                                        <p class="card-text"><?php echo($local['ubicacionLocal'])?></p>
                                        <a href='gestionarLocales.php?idEditar=<?php echo $local["codLocal"]; ?>' class='btn btn-primary card-link'>Editar</a>
                                        <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal<?php echo $local["codLocal"]; ?>'>Eliminar</button>
                                        <!-- Modal que popea cuando aprieta eliminar-->
                                        <div class='modal fade' id='deleteModal<?php echo $local["codLocal"]; ?>' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                            <div class='modal-dialog' role='document'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='exampleModalLabel'>¿Está seguro que desea borrar el local?</h5>
                                                        <button type='button' class='close' data-bs-dismiss='modal' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <p>Nombre: <?php echo $local["nombreLocal"]; ?></p>
                                                        <p>Ubicación: <?php echo $local["ubicacionLocal"]; ?></p>
                                                        <p>Rubro: <?php echo $local["rubroLocal"]; ?></p>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                                        <button type='button' class='btn btn-danger'>
                                                            <a href='procesarLocal.php?idEliminar=<?php echo $local["codLocal"];?>' style="text: white; text-decoration:none; ">Confirmar</a>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal cierre -->
                                    </div>
                                </div>
                        
                                <!-- Tarjeta cierre -->
                    
                            <?php }}} ?>
                        </div>
                    </div>
                    <div class="row">
                    <?php if($noHayResultados==false){?>
                        <nav aria-label="Navegación de páginas"  >
                            <ul class="pagination d-flex justify-content-center">
                                <?php
                                $query = "SELECT * FROM locales WHERE estado='activo' $busqueda"; //Cuenta la cantidad de resultados que hay en la tabla
                                $resultados = consultaSQL($query);
                                //$row = mysqli_fetch_row($rs_result);
                                $totalResultados = mysqli_num_rows($resultados);
                                $total_pages = ceil($totalResultados / $limite);
                                $query = $_GET;
                                if(isset($_GET['pagina']))
                                    $pagina=$_GET['pagina'];
                                unset($query['pagina']);
                                $query_string = http_build_query($query);
                                ?>
                                <li class="page-item <?php if($pagina <= 1){ echo 'disabled'; } ?>"> 
                                <a class="page-link" href="<?php if($pagina <= 1){ echo '#'; } else {$paginaAnterior=$pagina-1;;echo("?".$query_string."&pagina=".$paginaAnterior.""); } ?>">Atras</a>
                                </li>
                                <?php
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    echo "<li class=\"page-item";
                                    if ($pagina == $i) echo " active";
                                    echo "\"><a class=\"page-link\" href='?" . $query_string . "&pagina=$i'>$i</a></li>";
                                    }
                                ?>
                                <li class="page-item <?php if($pagina == $total_pages){ echo 'disabled'; } ?>"> 
                                <a class="page-link" href="<?php if($pagina == $total_pages){ echo '#'; } else {$paginaPosterior=$pagina+1;echo("?".$query_string."&pagina=".$paginaPosterior.""); } ?>">Adelante</a>
                                </li>
                            </ul>
                        </nav>
                        <?php }?>
                    </div>


            </div>
        </div>
    
</body>
<footer>
    <?php include("../footer.php") ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
