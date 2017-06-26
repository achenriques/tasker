        <form id="addTarea" name="addTarea" role="form" action="../index.php?controller=Tarea&amp;action=add<?=isset($_GET['return'])?'&return='.$_GET['return']:''?>" method='POST'>

            <div class="form-group">
                <label class="control-label" for="codTarea"><?=$idioma['Codigo de Tarea']?></label>
                <input type="text" id="codigoTarea" name="codTarea" class="form-control"
                       placeholder="<?=$idioma['Introduce un codigo para la tarea']?>" minlength=3 maxlength=12 pattern="^.{3,12}$" required />
            </div>
            <div class="form-group">
                <label class="control-label" for="nombreTarea"><?=$idioma['Nombre Tarea']?></label>
                <input type="text" id="nombreTarea" name="nombreTarea" class="form-control"
                       placeholder="<?=$idioma['Introduce un nombre para la tarea']?>" minlength=3 maxlength=45 pattern="^.{3,45}$" required />
            </div>

            <div class="form-group">
                <label class="control-label" for="descripcionTarea"><?=$idioma['Descripcion Tarea']?></label>
                            <textarea class="form-control"
                                      placeholder="<?=$idioma['Maximo: 140 caracteres']?>"
                                      name="descripcionTarea"
                                      onKeyDown="limitText(this.form.descripcionTarea,this.form.disponibles,140);"
                                      onKeyUp="limitText(this.form.descripcionTarea,this.form.disponibles,140);"
                                      minlength=3 maxlength=140 pattern="^.{3,140}$" required></textarea>

                <div class="pull-right">
                    <input class="col-lg-4 btn btn-xs pull-right"
                           title="<?=$idioma['restantes']?>" readonly
                           type="text" name="<?=$idioma['disponibles']?>"
                           value="140"/>
                </div>
            </div>

            <!-- Reutilizacion codigo - Alta tarea grupo -->

            <?php if (isset($datosGrupo)) { ?>


                <input type="hidden" name="calendario" id="calendario" value="<?=$datosGrupo->getCalendario()?>">


            <?php } else { ?>

            <div class="form-group input-group">
                <label class="control-label" for="calendario"><?=$idioma['Calendario']?></label>
                <select class="form-control" id="calendario" name="calendario">
                    <?php foreach ($calendarios as $calendario) {

                        if (!$controladorCal->calIsFromGroup($calendario->getIdCalendario())) {

                            //Esto es para no mostrar los calendarios de los grupos en el Alta.
                        ?>

                        <option value="<?=$calendario->getIdCalendario()?>"><?=$calendario->getNombreCalendario()?></option>

                    <?php } } ?>
                </select>
            </div>

            <?php } ?>

            <div class="form-group">
                <label class="control-label" for="codPadre"><?=$idioma['Tarea Padre']?></label>
                <select id="codPadre" name="codPadre" class="form-control" <?=$tareaPadreId>0?'disabled':''?> >
                    <option value="" selected><?=$idioma['--NINGUNA--']?></option>
                    <?php foreach($tareas as $tarea){ ?>
                    <option value="<?=$tarea->getIdTarea()?>" <?=$tarea->getIdTarea()==$tareaPadreId?'selected':''?>><?=$tarea->getNombreTarea()?></option>
                    <?php } ?>
                </select>
            <?php if ($tareaPadreId>0) { ?>
                <input type="hidden" id="codPadre" name="codPadre" class="form-control" value="<?=$tareaPadreId?>" />
            <?php } ?>
            </div>

            <div class="form-group">
                <label class="control-label" for="fechaEstIni"><?=$idioma['Inicio Estimado']?></label>
                <div class="input-group date">
                    <!--<span class="input-group-addon"></span>-->
                    <input type="text" id="fechaEstIni" name="fechaEstIni" class="form-control datepicker"
                       placeholder="dd/mm/aaaa" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" required />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="fechaEstFin"><?=$idioma['Fin Estimado']?></label>
                <div class="input-group date">
                    <!--<span class="input-group-addon"></span>-->
                    <input type="text" id="fechaEstFin" name="fechaEstFin" class="form-control datepicker"
                           placeholder="dd/mm/aaaa" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" required />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>    
            </div>
            
            <input type="hidden" name="idUsuario" value="<?=$datosUsuario->getIdUsuario()?>"/>

            <div class="modal-footer">
                <button type="submit" class="btn btn-outline btn-primary" name="crearTarea"><?=$idioma['Crear Tarea']?></button>
            </div>
            
        </form>

<script type="text/javascript">
$.fn.datepicker.defaults.language= 'es';
$.fn.datepicker.defaults.autoclose = true;

$('.datepicker').datepicker();
</script>

<script src="../js/validation.altatarea.js"></script>
