<?php
$query = "SELECT * FROM promociones WHERE estadoPromo = 'activa'" . $busqueda;
$resultado = consultaSQL($query);
if(mysqli_num_rows($resultado) > 0){
    while($fila = mysqli_fetch_array($resultado)){
        $query1 = "SELECT * FROM locales WHERE codLocal = '".$fila["codLocal"]."' " . $busqueda2;
        $resultado1 = consultaSQL($query1);
        while($fila1 = mysqli_fetch_array($resultado1)){
            $query2 = "SELECT * FROM uso_promociones WHERE codPromo = '".$fila["cod"]."' AND estado = 'aceptada'";
            $resultado2 = consultaSQL($query2);
            if(mysqli_num_rows($resultado2) > 0){
                if($estoy == 'verDescuentosUtilizados'){
                    $encontro = 1;
                    mostrarcards($fila,$fila1, $encontro);    
                }
                
            }else{
                if($estoy == 'verDescuentos'){
                $encontro = 0;
                mostrarcards($fila,$fila1, $encontro);
                }
            }
            
        }
    }
}

function mostrarcards($fila,$fila1,$encontro,){ ?>
    <div class="card" style="margin: 15px; width: 18rem;">
        <div class="card-body">
            <div style="height:80%">
                <h5 class="card-title">Cod descuento: <?php echo($fila["cod"]) ?></h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Descripcion: <?php echo($fila["textoPromo"]) ?></h6>
                <p class="card-text">Del local: <?php echo ($fila1["nombreLocal"]) ?></p>
                <p class="card-text">Rubro: <?php echo($fila1["rubroLocal"]) ?></p>
                <p class="card-text">Dias de la semana: <?php echo($fila["diaSemana"]) ?></p>
                <p class="card-text">Plazo: <?php echo($fila["fechaDesde"]); echo(" --- "); echo($fila["fechaHasta"]) ?></p> 
            </div>
            <div style="height: 65px;">
                <button type="button" class="btn btn-primary w-100 m-1 <?php if ($encontro != 0) echo "d-none" ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Utilizar descuento
                </button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Esta seguro que desea utilizar el descuento?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer mx-auto text-center w-100 p-2 d-flex justify-content-between">
                    <a href="utilizarDescuento.php?cod=<?php echo($fila['cod'])?>" class="btn btn-primary m-1">Utilizar descuento</a>
                    <button type="button" class="btn btn-secundary m-1" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>