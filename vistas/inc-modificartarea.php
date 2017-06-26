<!--
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <a data-toggle="modal" data-target="#modalAltaDoc" class="btn btn-outline btn-primary">Adjuntar Documento</a>
        </div>
    </div>
</div>

<div id="modalAltaDoc" class="modal fade" role="dialog">
<?php
//include('inc-altadocumento.php');
?>
</div>
-->

    <form id="updateTarea" name="updateTarea" role="form" action='../index.php?controller=Tarea&amp;action=update<?=isset($_GET['return'])?'&return='.$_GET['return']:''?>' method='POST' data-toggle="validator">

        <div class="panel panel-default">

            <div class="panel-body">
                        
                
                <div class="row">
                    <div class="form-group col-xs-4">
                        <label class="control-label" for="codTarea"><?=$idioma['Codigo de Tarea']?></label>
                        <div class="input-group">
                            <!--<span class="input-group-addon"></span>-->
                            <input type="text" id="codTarea" name="codTarea" class="form-control" value="<?=$datosTarea->getCodTarea()?>"
                       placeholder="<?=$idioma['Introduce un codigo para la tarea']?>" minlength="3" maxlength="12" pattern="^.{3,12}$" required <?=$disabled ? 'disabled':'' ?>/>
                        </div>
                    </div>

                    <div class="form-group col-xs-8">
                        <label class="control-label" for="nombreTarea"><?=$idioma['Nombre Tarea']?></label>
                        <div class="input-group">
                            <!--<span class="input-group-addon"></span>-->
                            <input type="text" id="nombreTarea" name="nombreTarea" class="form-control" value="<?=$datosTarea->getNombreTarea()?>"
                       placeholder="<?=$idioma['Introduce un nombre para la tarea']?>" minlength="3" maxlength="45" pattern="^.{3,45}$" required <?=$disabled ? 'disabled':'' ?>/>
                        </div>
                    </div>
                </div>  

            <div class="row">
                <div class="form-group  col-xs-12">
                    <label class="control-label" for="descripcionTarea"><?=$idioma['Descripcion Tarea']?></label>
                    <textarea class="form-control"
                              placeholder="<?=$idioma['Maximo: 140 caracteres']?>"
                              name="descripcionTarea"
                              onKeyDown="limitText(this.form.descripcionTarea,this.form.disponibles,140);"
                              onKeyUp="limitText(this.form.descripcionTarea,this.form.disponibles,140);"
                              minlength="3" maxlength="140" pattern="^.{3,140}$" required <?=$disabled ? 'disabled':'' ?>><?=$datosTarea->getDescripcionTarea()?></textarea>

                    <div class="pull-right">
                        <input class="col-lg-4 btn btn-xs pull-right"
                               title="<?=$idioma['restantes']?>" readonly
                               type="text" name="<?=$idioma['disponibles']?>"
                               value="140"/>
                    </div>
                </div>
            </div>
                
            <div class="row">
                <div class="form-group col-xs-6">
                    <label class="control-label" for="codPadre"><?=$idioma['Tarea Padre']?></label>
                    <select id="codPadre" name="codPadre" class="form-control" value="<?=$datosTarea->getTareaPadre()?>" <?=$disabled ? 'disabled':'' ?>>
                        <option value="" >-- NINGUNA --</option>
                        <?php foreach($tareas as $tarea){ ?>
                        <option value="<?=$tarea->getIdTarea()?>" <?php echo $datosTarea->getTareaPadre()==$tarea->getIdTarea() ? 'selected':'' ?> ><?=$tarea->getNombreTarea()?></option>    
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-xs-6">
                    <label class="control-label" for="codEstadoTarea"><?=$idioma['Estado Tarea']?></label>
                    <select id="codEstadoTarea" name="codEstadoTarea" class="form-control" value="<?=$datosTarea->getEstadoTarea()?>" disabled>
                        <option value="" >-- NINGUNA --</option>
                        <?php foreach($estados as $estado){ ?>
                        <option value="<?=$estado->getIdEstado()?>" <?php echo $datosTarea->getEstadoTarea()==$estado->getIdEstado() ? 'selected':'' ?> ><?=$estado->getNombreEstado()?></option>    
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-xs-6">
                    <label class="control-label" for="fechaEstIni">Inicio Estimado</label>
                    <div class="input-group date">
                        <!--<span class="input-group-addon"></span>-->
                        <input type="text" id="fechaEstIni" name="fechaEstIni" class="form-control datepicker" value="<?=Tools::date2php($datosTarea->getFechaEstIni())?>"
                               placeholder="dd/mm/aaaa" data-error="La fecha introducida esss errónea" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" required <?=$disabled ? 'disabled':'' ?> />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label class="control-label" for="fechaEstFin">Fin Estimado</label>
                    <div class="input-group date">
                        <!--<span class="input-group-addon"></span>-->
                        <input type="text" id="fechaEstFin" name="fechaEstFin" class="form-control datepicker" value="<?=Tools::date2php($datosTarea->getFechaEstFin())?>"
                               placeholder="dd/mm/aaaa" data-error="La fecha introducida esss errónea" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" required <?=$disabled ? 'disabled':'' ?> />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label class="control-label" for="fechaRealIni">Inicio Real</label>
                    <div class="input-group date">
                        <!--<span class="input-group-addon"></span>-->
                        <input type="text" id="fechaRealIni" name="fechaRealIni" class="form-control datepicker" value="<?=Tools::date2php($datosTarea->getFechaRealIni())?>"
                               placeholder="dd/mm/aaaa" data-error="La fecha introducida es errónea" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" <?=$disabled ? 'disabled':'' ?> />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>    
                <div class="form-group col-xs-6">
                    <label class="control-label" for="fechaRealFin">Fin Real</label>
                    <div class="input-group date">
                        <!--<span class="input-group-addon"></span>-->
                        <input type="text" id="fechaRealFin" name="fechaRealFin" class="form-control datepicker" value="<?=Tools::date2php($datosTarea->getFechaRealFin())?>"
                               placeholder="dd/mm/aaaa" pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" disabled />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>    
            </div>

            <!-- Subtareas -->

            <?php
                $tareas = $datosTarea->getSubTareas();
                if (sizeof($tareas)>0) {
            ?>
            <div class="row">
                <fieldset>
                <legend>SubTareas</legend>                    
                    <div class="col-xs-12">
                        <?php 
                            include('inc-listatareas.php'); 
                        ?>
                    </div><!-- col -->
                </fieldset>
            </div>
            <?php } ?>
            <!-- .Subtareas -->

            <!-- Documentos -->
            <?php
                /*$docs = $datosTarea->getDocumentos();
                if (sizeof($docs)>0) {
            ?>
            <div class="row">
                <fieldset>
                    <legend>Documentos</legend>
                    <div class="col-xs-12">
                        <?php include('inc-listadocumentos.php'); ?>
                    </div><!-- col -->
                </fieldset>
            </div>
            <?php }*/ ?>
            <!-- .Documentos -->

            </div> <!-- panel body -->
            <div class="panel-footer">
                <button type="submit" class="btn btn-outline btn-primary" name="actualizarTarea"><?=$idioma['Guardar Cambios']?></button>
            </div>

        </div> <!-- Panel -->

        <input type="hidden" id="idTarea" name="idTarea" value="<?=$datosTarea->getIdTarea()?>">

        </form> <!-- Form -->
        
        
<script type="text/javascript">
$.fn.datepicker.defaults.language = 'es';
$.fn.datepicker.defaults.autoclose = true;

$('.datepicker').datepicker();
</script>

<script src="../js/validation.modificartarea.js"></script>
