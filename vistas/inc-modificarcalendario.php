<form id="updateCalendario" name="updateCalendario" role="form" action='../index.php?controller=Calendario&amp;action=update<?=isset($_GET['return'])?'&return='.$_GET['return']:''?>' method='POST' data-toggle="validator">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="form-group col-xs-10">
                    <label class="control-label" for="nombreCalendario">
                        <?=$idioma['Nombre del calendario']?>
                    </label>
                    <div class="input-group">
                        <input type="text" id="nombreCalendario" name="nombreCalendario" class="form-control" value="<?=$datosCalendario->getNombreCalendario()?>"
                               placeholder="<?=$idioma['Introduce un nombre para el calendario']?>" maxlength="45" pattern="^.{3,45}$" required <?=$disabled ? 'disabled':'' ?>/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group  col-xs-10">
                    <label class="control-label" for="colorCalendario"><?=$idioma['Color para el Calendario']?></label>
                    <div class="input-group demo2">
                        <input id="colorCalendario" name="colorCalendario" type="text" value="<?=$datosCalendario->getColor()?>" class="form-control" />
                        <span class="input-group-addon"><i></i></span>
                    </div>
                    <script>
                        $(function(){
                            $('.demo2').colorpicker();
                        });
                    </script>

                    <input name="idCalendario" type="hidden" value="<?=$calendarioId?>">
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-outline btn-primary" name="actualizarCalendario"><?=$idioma['Guardar Cambios']?></button>
        </div>
    </div>
</form>

<script type="text/javascript">
    $.fn.datepicker.defaults.language = 'es';
    $.fn.datepicker.defaults.autoclose = true;
    $('.datepicker').datepicker();
</script>

<script src="../js/validation.modificarcalendario.js"></script>