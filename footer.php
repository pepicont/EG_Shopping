<!-- cambiar a form-group-->
<div class="container-fluid" style="margin-top: 100px; background-color: pink; display: flex; justify-content: space-between"">
    <div class="container">
        <p style="display:flex; justify-content: center; font-size: 24px;">Información adicional</p>
        </hr>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique amet esse nulla, possimus voluptatem excepturi sint accusantium officiis aut quaerat minima cupiditate! Ut, placeat veniam nihil molestias cumque laborum laboriosam.</p>
    </div>
    <div class="container">
        <p style="display:flex; justify-content: center; font-size: 24px;">Formulario de contacto</p> 
        <form action="" method="POST" style="display:flex; flex-direction: column; align-items: center; padding: 20px;">
            <label for="email" style="align-self: center">Email: </label>
            <input type="email" name="email" id="email" placeholder="juanperez@gmail.com" required style="margin-bottom: 10px; ">    
            <label for="asunto" style="align-self: center">Asunto: </label>
            <input type="text" name="asunto" id="asunto" placeholder="Descuentos medium" required style="margin-bottom: 10px; ">
            <label for="cuerpo" style="align-self: center">Cuerpo del mail: </label>
            <textarea required name="cuerpo" placeholder="Me gustaría preguntar acerca de... " cols="40" rows="5" style="resize: none; margin-bottom: 10px; "></textarea>
            <input type="submit" value="enviar" style="border-radius: 16px; border-style: solid; border-color:#ff66ff">
        </form> 
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

