<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paseo del literal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="estilos/style1.css" rel="stylesheet">

</head>
<header>
        <?php 
        include("header.php");
        ?>
    </header>
    
<body>
   
<div id="carouselExampleCaptions" class="carousel slide"><!-- Carrusel -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="assets/foto1.jpg" class="d-block w-100" alt="foto de shopping 1">
        </div>
            <div class="carousel-item">
            <img src="assets/foto2.jpg" class="d-block w-100" alt="foto de shopping 2">
        </div>
            <div class="carousel-item">
            <img src="assets/foto3.jpg" class="d-block w-100" alt="foto de shopping 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container">
    <div class="row align-item-center">
        <div class="col-12 align-self-center"><h2>Novedades</h2></div>

    </div>
    <div class="row">
        <!-- Aca van a ir un php que genere los carteles con las novedades que haya
         según el tipo de usuario  -->
         Novedad1 ,Novedad2
    </div>


</div>

 </body>

  
<footer>
        <?php 
        include("footer.html");
        ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>