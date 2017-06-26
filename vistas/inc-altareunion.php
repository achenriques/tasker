<form role="form" name="addReunion" action="../index.php?controller=Reunion&amp;action=add" method='POST'>
<div class="form-group">
        <label class="control-label" for="fechaReunion"><?=$idioma['Fecha Propuesta']?></label>
        <div class="input-group date">
            <!--<span class="input-group-addon"></span>-->
            <input type="text" id="fechaReunion" name="fechaReunion" class="form-control datepicker"
                   placeholder="dd/mm/aaaa" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" required />
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
    </div>

    <!-- reutilizacion de codigo. Si estamos en update cargamos el id Reunion -->

    <?php if (isset($idReunion)) {  ?>

    <input type="hidden" name="idReunion" value="<?=$idReunion?>">


    <?php } ?>

     <input type="hidden" name="idUsuario" value="<?=$datosUsuario->getIdUsuario()?>">

    <input type="hidden" name="idGrupo" value="<?=$datosGrupo->getIdGrupo()?>">

    <button type="submit" class="btn btn-outline btn-primary" name="crearReunion"><?=$idioma['Crear Reunion']?></button>

</form>
<script type="text/javascript">
    $.fn.datepicker.defaults.language= 'es';
    $.fn.datepicker.defaults.autoclose = true;

    $('.datepicker').datepicker();
</script>

 <script src="../js/validation.reunion.js"></script>
