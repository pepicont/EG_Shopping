<?php 
    $lugar = "duenoLocal";
    include_once("../funciones.php");
    include("../header.php");
    $idusuario= $_SESSION["idUsuario"];
    if($_SESSION["tipoUsuario"] != "duenoLocal"){
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestionNovedades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../estilos/style1.css">

</head>
<body>
    <div class="row ">
        <div class="col-3 filtros" action="card.php">
            <br>
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">Crear descuento</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear descuento: </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="agregarDesceunto.php" method="GET" >
                        <div class="form-group">
                            Texto de la promo: <input type="text" require id="textpro" name="textpro">
                        </div>
                        <div class="form-group">
                            Fecha de inicio: <input type="date" require id="fechaini" name="fechaini" >
                        </div>
                        <div class="form-group">
                            Fecha de fin: <input type="date" require id="fechahas" name="fechahas" >
                        </div>
                        <div class="form-group">
                            Dia de la semana: <br>
                        </div>
                        <div class="form-group">
                            <hr>
                            Categoria de descuento segun cliente: <br> 
                                Inicial: <input type="checkbox" class="form-checkinput" aria-describedby="helpId" value="inicial" name="categoria[]"> <br>
                                Medium: <input type="checkbox" class="form-checkinput" aria-describedby="helpId" value="medium" name="categoria[]"> <br>
                                Premium: <input type="checkbox" class="form-checkinput" aria-describedby="helpId" value="premium" name="categoria[]"> <br>
                        </div>
                        <div class="form-group">
                            Ingrese el codigo de local: <input type="number" id="id" name="id" require>
                        </div>
                        <div class="form-group modal-footer">
                            <input type="submit" name="submit" value="Crear descuento" class="btn btn-primary w-100 m-1">
                            <a href="gestionDescuentos.php" class="btn btn-primary w-100 m-1">volver</a>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
                </div>
            </div>
            </div>
        <br>
        <br>
           <?php include("filtros.php"); ?>
        </div>
        <div class="listado  d-flex col-8 mx-auto ">
            <?php include("cards.php"); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<?php

include("../footer.php")?>
</html>

