<!-- cambiar a form-group-->
<div class="pie container" style="margin-top: 15rem;">

    <hr style="width: 95%; opacity:100%; height: 1px; background-color: violet; border: none; margin:auto; "/>

    <div class="container-fluid" style=" margin:auto; margin-top: 50px;  display: flex; justify-content: space-between">
        

    <div class="container">
    <div class="row">
        <!-- Primer container: Información adicional -->
        <div class="col-12 col-md-6">
            <h3 class="text-center mb-3" style="color:rgb(235, 103, 235); font-weight:600; font-size: 24px;">
                Información adicional
            </h3>
            <p>
                Ubicación: Rosario, Santa Fe - Junín 501
                <br>
                Copyright © 2024-2024 Mundo Shopping S.R.L.
                <br>
                *Imágenes de referencia. Descuentos válidos en la República Argentina en productos seleccionados de acuerdo a disponibilidad y condiciones 
                establecidas en cada promoción a cargo de cada dueño de local. Válido exclusivamente para pagos presenciales de productos seleccionados, con tarjetas de 
                crédito Mastercard, Visa, Cabal y American Express bancarias únicamente emitidas y administradas por bancos autorizados en la República Argentina, y que se 
                encuentren vigentes y en estado de cumplimiento. Toda promoción solicitada deberá ser aceptada por el dueño de local respectivo. Mundo Shopping S.R.L.
            </p>
        </div>

        <!-- Segundo container: Formulario de contacto -->
        <div class="col-12 col-md-6">
            <p class="text-center" style="font-size: 24px; color:rgb(235, 103, 235); font-weight:600;">
                Formulario de contacto
            </p>
            <form action="ABMMail.php" method="POST" class="row g-3">
                <div class="col-12">
                    <label for="email" class="form-label">Email:</label>
                    <?php 
                    if($login==true){
                        echo '<input type="email" class="form-control" name="email" id="email" readonly required value="'.$_SESSION['usuario'].'"';}else{
                    ?>
                    <input type="email" class="form-control" name="email" id="email" placeholder="juanperez@gmail.com" required>
                    <?php } ?>
                </div>
                <div class="col-12">
                    <label for="asunto" class="form-label">Asunto:</label>
                    <input type="text" class="form-control" name="asunto" id="asunto" placeholder="Descuentos medium" required>
                </div>
                <div class="col-12">
                    <label for="cuerpo" class="form-label">Cuerpo:</label>
                    <textarea class="form-control" name="cuerpo" id="cuerpo" placeholder="Me gustaría saber más acerca de..." rows="5" style="resize: none;"></textarea>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <input type="submit" name="enviar" id="enviar" value="Enviar" class="btn btn-primary">
                </div>
            </form> 
        </div>
    </div>
</div>

    </div>
</div>




