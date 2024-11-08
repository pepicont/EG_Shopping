<!-- cambiar a form-group-->
<div class="pie" style="margin-top: 15rem;">

    <hr style="width: 95%; opacity:100%; height: 1px; background-color: violet; border: none; margin:auto; "/>

    <div class="container-fluid" style=" margin:auto; margin-top: 50px;  display: flex; justify-content: space-between">
        

        <div class="container" >
            <h3 style="display:flex; margin-bottom:15px; color:rgb(235, 103, 235); font-weight:600; justify-content: center; font-size: 24px;">Información adicional</h3>
            </hr>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique amet esse nulla, possimus voluptatem excepturi sint accusantium officiis aut quaerat minima cupiditate! Ut, placeat veniam nihil molestias cumque laborum laboriosam.</p>
        </div>
        <div class="container">
            <p style="display:flex; justify-content: center; font-size: 24px; color:rgb(235, 103, 235); font-weight:600;">Formulario de contacto</p> 
            <form action="" method="POST" style="display:flex; flex-direction: column; align-items: center; padding: 20px;">
                <div class="form-group"> Email: 
                    <input type="email" name="email" id="email" placeholder="juanperez@gmail.com" required style="margin-bottom: 10px;" >
                </div>
                <div class="form-group"> Asunto: 
                    <input type="text" name="asunto" id="asunto" placeholder="Descuentos medium" required style="margin-bottom: 10px;" >
                </div>
                <div class="form-group" style="display:flex; align-items:flex-start;"> Cuerpo:     
                    <textarea name="cuerpo" id="cuerpo" placeholder="Me gustaría saber más acerca de..." cols="40" rows="5" style="resize: none; margin-bottom: 10px; margin-left: 10px"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="enviar" id="enviar" value="Enviar" class="btn btn-primary">
                </div>
            </form> 
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


