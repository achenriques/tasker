<?php
/**
 * Created by IntelliJ IDEA.
 * User: usuario
 * Date: 21/12/2015
 * Time: 20:23
 */

//include("../Tools.php");
include("v-panelheader.php");
include_once '../controlador/GrupoController.php';

//setlocale(LC_TIME, "es_ES");

$controlador = new GrupoController();

$grupoId = $_GET['id'];
$datosGrupo = $controlador->getDatosGrupo($grupoId);

/*if ($datosGrupo->isNull()){
    $_GET['msg'] = 'errorNoData';
    $_GET['tipo'] = 'danger';
}*/
?>


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Modificar Grupo</h1>
    </div>
</div>

<div class="col-xs-9">

    <form role="form" name="updateGrupo" action='../index.php?controller=Grupo&amp;action=update<?=isset($_GET['return'])?"&return=".$_GET['return']:""?>' method='POST' data-toggle="validator">

        <div class="panel panel-default">

            <div class="panel-body">

                <!--<div class="row">
                    <div class="form-group col-xs-12">
                        <label for="nombreGrupo"><?=$idioma['Nombre Grupo']?></label>
                        <div class="input-group">
                            <input type="text" id="nombreGrupo" name="nombreGrupo" class="form-control" value="<?=$datosGrupo->getNombreGrupo()?>"
                                   placeholder="<?=$idioma['Introduce un nombre para el grupo']?>" maxlength="45" pattern="^.{3,45}$" required />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-xs-12">
                        <label for="descripcionGrupo"><?=$idioma['Descripcion Grupo']?></label>
                        <div class="input-group">
                            <input type="text" id="descripcionGrupo" name="descripcionGrupo" class="form-control" value="<?=$datosGrupo->getDescripcionGrupo()?>"
                                   placeholder="<?=$idioma['Maximo: 140 caracteres']?>" maxlength="140" pattern="^.{3,140}$" required />
                        </div>
                    </div>
                </div>-->

                <div class="form-group">
                    <label for="nombreGrupo"><?=$idioma['Nombre Grupo']?></label>
                    <input type="text" id="nombreGrupo" name="nombreGrupo" class="form-control" value="<?=$datosGrupo->getNombreGrupo()?>"
                           placeholder="<?=$idioma['Introduce un nombre para el grupo']?>" maxlength="45" pattern="^.{3,45}$" required>
                </div>

                <div class="form-group">
                    <label for="descripcionGrupo"><?=$idioma['Descripcion Grupo']?></label>
                    <input type="text" id="descripcionGrupo" name="descripcionGrupo" class="form-control" value="<?=$datosGrupo->getDescripcionGrupo()?>"
                           placeholder="<?=$idioma['Maximo: 140 caracteres']?>" maxlength="140" pattern="^.{3,140}$" required />
                </div>

                <!--
                <div class="row">
                    <div class="form-group  col-xs-12">
                        <label class="control-label" for="descripcionGrupo"><?=$idioma['Descripcion Grupo']?></label>
                    <textarea class="form-control"
                              placeholder="<?=$idioma['Maximo: 140 caracteres']?>"
                              name="descripcionGrupo"
                              onKeyDown="limitText(this.form.descripcionGrupo,this.form.disponibles,140);"
                              onKeyUp="limitText(this.form.descripcionGrupo,this.form.disponibles,140);"
                              maxlength="140" required><?=$datosGrupo->getDescripcionGrupo()?></textarea>

                        <div class="pull-right">
                            <input class="col-lg-4 btn btn-xs pull-right"
                                   title="<?=$idioma['restantes']?>" readonly
                                   type="text" name="<?=$idioma['disponibles']?>"
                                   value="140"/>
                        </div>
                    </div>
                </div>
                -->
                <div class="form-group">
                    <label class="control-label" for="visibilidad"><?=$idioma['Visibilidad del Grupo']?></label>
                    <select id="visibilidad" name="visibilidad" class="form-control"  >
                        <?php foreach(Grupo::$VISIBILIDADES as $key=>$val){ ?>
                            <option value="<?=$key?>" <?=$key==$datosGrupo->getVisibilidad()?'selected':''?> ><?=$val?></option>
                        <?php } ?>
                    </select>
                </div>


            </div> <!-- panel body -->
            <div class="panel-footer">
                <button type="submit" class="btn btn-outline btn-primary" name="actualizarGrupo"><?=$idioma['Guardar Cambios']?></button>
            </div>

        </div> <!-- Panel -->

        <input type="hidden" id="idGrupo" name="idGrupo" value="<?=$datosGrupo->getIdGrupo()?>">

    </form> <!-- Form -->

    <script src="../js/validation.modificargrupo.js"></script>


</div><!-- col -->


</div><!-- wrapper -->

<?php

include("v-panelfooter.php");

?>
