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
                                <label  for="inicial">Inicial</label>
                                <input type="checkbox" class="form-check-input" name="inicial"></br>
                            </div>
                            <div class="form-group mx-4 p-2" style="width: fit-content">
                                <label for="medium">Medium</label>
                                <input type="checkbox" class="form-check-input" name="medium"></br>

                            </div>
                            <div class="form-group mx-4 p-2" style="width: fit-content">
                                <label for="premium">Premium</label>
                                <input type="checkbox" class="form-check-input" name="premium"></br>

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
                           include_once("listarNovedades.php");
                           mostrarNovedades();
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