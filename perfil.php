<?php session_start(); 
include_once("funciones.php");

if(isset($_POST['guardar'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $query = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', nombreUsuario='$email' WHERE codUsuario=".$_SESSION['idUsuario'];
    consultaSQL($query);
    header("Location: perfil.php");
    exit();
}

include("header.php");
$query = "SELECT * FROM usuarios WHERE codUsuario=".$_SESSION['idUsuario'];
$resultado = consultaSQL($query);
$fila = mysqli_fetch_array($resultado);
?>
<div class="row">
    <div class="col-7">
        <h1 class="text-center">Perfil:</h1>
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <p class="card-text">Nombre: <?php echo $fila['nombre'] ?></p> 
                <p class="card-text">Apellido: <?php echo $fila['apellido'] ?></p>
                <p class="card-text">Email: <?php echo $fila['nombreUsuario'] ?></p>
            </div>
            <button type="button" class="btn btn-primary w-100 m-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Editar perfil:
            </button>
        </div>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Perfil</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="perfil.php" method="POST" class="mx-auto mt-3" style="max-width: 600px;">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $fila['nombre'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido:</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $fila['apellido'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $fila['nombreUsuario'] ?>">
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <button type="submit" class="btn btn-primary w-50 me-2" name="guardar">Guardar Cambios</button>
                                <button type="button" class="btn btn-secondary w-50 ms-2" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <h2>Información del Cliente:</h2>
        <p>Categoría: <?php // Aquí va la categoría del cliente ?></p>
        <p>Descuentos Usados: <?php // Aquí va la cantidad de descuentos usados ?></p>
    </div>
</div>
<?php
if(isset($_POST['guardar'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $query = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', nombreUsuario='$email' WHERE codUsuario=".$_SESSION['idUsuario'];
    consultaSQL($query);
    header("Location: perfil.php");
    exit();
}
include("footer.php");
?>



