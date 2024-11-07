<?php
    $lugar="admin";
    include_once("../funciones.php");
    include("../header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InformeDescuentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../estilos/style1.css" rel="stylesheet">
</head>
<?php if ($login==true && $tipoUsuario=="administrador"){?>
    <body>
        
    <?php }
    else{
        exit(header("Location: ../home.php"));
    }
    ?>
        <div class="container">
            <div class="row">  
                <div class="col-3 ">
                    <h2>Solicitud de dueños</h2>
                    <div class="listado">
                        <?php
                            $sql="SELECT * FROM usuarios WHERE estado='1' AND tipoUsuario='duenoLocal'";
                            $resultado=consultaSQL($sql);
                            if(mysqli_num_rows($resultado)==0){
                                echo("No hay solicitudes de dueños de locales");
                            }else{
                            while($usuario=mysqli_fetch_array($resultado)){ 
                        ?>
                            <div class="card " style=" margin: 10px; width: 14em; ">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo($usuario['nombre']." ".$usuario['apellido']) ?></h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Código: <?php echo($usuario["codUsuario"]) ?> </h6>
                                    <p class="card-text">Fecha de nacimiento: <?php echo($usuario['fechaNacimiento']) ?> </p>
                                    
                                </div>
                            </div>
                            <?php
                            }}?>
                    </div>
                </div>
                <div class="col-8">
                    <h2>Locales</h2>
                    <div class="listado">
                        <?php
                            $sql="SELECT * FROM locales WHERE estado='activo'";
                            $resultado=consultaSQL($sql);
                            if(mysqli_num_rows($resultado)==0){
                                echo("No hay locales");
                            }else{
                            while($local=mysqli_fetch_array($resultado)){ 
                            
                        ?>
                            <!-- Esta es la tarjeta común de los locales -->
                            <div class="card " style=" margin: 10px; width:fit-content; ">
                                <img src="../assets/local.jpg" class="card-img-top" alt="..." style="height:200px; width:200px;"><!-- Acá iría la imagen del local -->
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo($local['nombreLocal']) ?></h5>
                                    <p class="card-text"><?php echo($local['ubicacionLocal'])?></p>
                                    <a href='gestionarLocales.php?idEditar=<?php echo $local["codLocal"]; ?>&nombreLocal=<?php echo $local["nombreLocal"]; ?>&ubicacionLocal=<?php echo $local["ubicacionLocal"]; ?>&rubroLocal=<?php echo $local["rubroLocal"]; ?>&codUsuario=<?php echo $local["codUsuario"]; ?>' class='btn btn-primary card-link'>Editar</a>
                                    <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal<?php echo $fila["cod"]; ?>'>Eliminar</button>
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
                                                        <a href='procesarLocal.php?idEliminar=<?php echo $local["codLocal"]; ?>' class='btn btn-danger'>Confirmar</a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal cierre -->
                                </div>
                            </div>
                    




                
                        <?php }} ?>
                </div>

            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<footer>
    <?php include("../footer.php") ?>
</footer>
</html>
