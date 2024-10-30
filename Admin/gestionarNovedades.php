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

    <?php include("../footer.php");?>
    
    <div class="container mt-4">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <a class="btn btn-primary pt-3 pb-3">Crear novedades</a>
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
            <div class="col-8">
                <div class="container" >
                    <h3>Lista de novedades</h3>
                    <!-- generador de tarjetas para aprobar/denegar -->
                     <?php 
                        $query="SELECT * FROM novedades WHERE estado = 'activa'";
                        $resultados=consultaSQL($query);
                        if(mysqli_num_rows($resultados)>0){
                            while($fila=mysqli_fetch_array($resultados)){
                                echo("<div class='card' style='width: 18rem;'>");
                        echo("<div class='card-body'>");
                            echo("<h5 class='card-title'>".$fila["nombreNovedad"]."</h5>");
                            echo("<h6 class='card-subtitle mb-2 text-muted'>$fila['tipoUsuario']</h6>");
                            echo("<p class='card-text'>$fila['textoNovedad']</p>");
                            echo("<a href='#' class='btn btn-warning card-link'> Editar</a>");
                            echo("<a href='#' class='btn btn-danger card-link'>Eliminar</a>");
                        echo("</div>");
                    echo("</div>");    
                            
                           
                                
                            }
                        }
                        else{
                            echo"No hay novedades cargadas activas";
                        }

                     
                     ?>
                    <!-- 
                     echo("<div class="card" style="width: 18rem;">");
                        echo("<div class="card-body">");
                            echo("<h5 class="card-title">$fila['nombreNovedad']</h5>");
                            echo("<h6 class="card-subtitle mb-2 text-muted">$fila['tipoUsuario']</h6>");
                            echo("<p class="card-text">$fila['textoNovedad']</p>");
                            echo("<a href="#" class="btn btn-warning card-link"> Editar</a>");
                            echo("<a href="#" class="btn btn-danger card-link">Eliminar</a>");
                        echo("</div>");
                    echo("</div>"); -->
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>