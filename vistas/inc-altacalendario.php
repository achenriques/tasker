
<div class="form-group">
    <label for="nombreCalendario"><?=$idioma['Nombre para el Calendario']?></label>
    <input type="text" id="nombreCalendario" name="nombreCalendario" class="form-control"
           placeholder="<?=$idioma['Introduce un nombre para el calendario']?>" maxlength="45" required>
</div>

<div class="form-group">
    <label for="nombreCalendario"><?=$idioma['Color para el Calendario']?></label>

    <div class="input-group demo2">

        <input id="colorCalendario" name="colorCalendario" type="text" value="blue" class="form-control" />
        <span class="input-group-addon"><i></i></span>
    </div>
    <script>
        $(function(){
            $('.demo2').colorpicker();
        });
    </script>


</div>

<input type="hidden" name="idUsuario" value="<?=$datosUsuario->getIdUsuario()?>"/>


    <button type="submit" class="btn btn-outline btn-primary" name="crearCalendario"><?=$idioma['Crear Calendario']?></button>

<script src="../js/validation.modificarcalendario.js"></script>
