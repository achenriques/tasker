<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 18:38
 */

include("v-panelheader.php");
include_once '../controlador/GrupoController.php';

$controlador = new GrupoController();

?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=$idioma['Nuevo Grupo']?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

    <form role="form" name="addGrupo" action='../index.php?controller=Grupo&amp;action=add<?=isset($_GET['return'])?"&return=".$_GET['return']:""?>' method='POST'>

        <div class="panel panel-default">

            <div class="panel-body">

                <div class="form-group">
                    <label for="nombreGrupo"><?=$idioma['Nombre Grupo']?></label>
                    <input type="text" id="nombreGrupo" name="nombreGrupo" class="form-control"
                           placeholder="<?=$idioma['Introduce un nombre para el grupo']?>" maxlength="45" pattern="^.{3,45}$" required>
                </div>

                <div class="form-group">
                    <label for="descripcionGrupo"><?=$idioma['Descripcion Grupo']?></label>
                        <input type="text" id="descripcionGrupo" name="descripcionGrupo" class="form-control"
                              placeholder="<?=$idioma['Maximo: 140 caracteres']?>" maxlength="140" pattern="^.{3,140}$" required />
                </div>
                <!--
                <div class="form-group">
                    <label class="control-label" for="descripcionGrupo"><?=$idioma['Descripcion Grupo']?></label>
                            <textarea class="form-control"
                                      placeholder="<?=$idioma['Maximo: 140 caracteres']?>"
                                      name="descripcionGrupo"
                                      onKeyDown="limitText(this.form.descripcionGrupo,this.form.disponibles,140);"
                                      onKeyUp="limitText(this.form.descripcionGrupo,this.form.disponibles,140);"
                                      maxlength="140" required></textarea>

                    <div class="pull-right">
                        <input class="col-lg-4 btn btn-xs pull-right"
                               title="<?=$idioma['restantes']?>" readonly
                               type="text" name="<?=$idioma['disponibles']?>"
                               value="140"/>
                    </div>
                </div>
                -->
                <div class="form-group">
                    <label class="control-label" for="visibilidad"><?=$idioma['Visibilidad del Grupo']?></label>
                    <select id="visibilidad" name="visibilidad" class="form-control"  >
                        <?php foreach(Grupo::$VISIBILIDADES as $key=>$val){ ?>
                            <option value="<?=$key?>" ><?=$val?></option>
                        <?php } ?>
                    </select>
                </div>

                <!--<div class="form-group">
                    <label class="control-label" for="visibilidad"><?=$idioma['Visibilidad del Grupo']?></label>
                    <select class="form-control" id="visibilidad" name="visibilidad">
                        <option value="pri"><?=$idioma['Privado']?></option>
                        <option value="pub"><?=$idioma['Publico']?></option>
                    </select>
                </div>-->

                <input type="hidden" name="idUsuario" value="<?=$datosUsuario->getIdUsuario()?>"

            </div> <!-- panel body -->
            <div class="panel-footer">
                <button type="submit" class="btn btn-outline btn-primary" name="crearGrupo"><?=$idioma['Crear Grupo']?></button>
            </div>

        </div> <!-- Panel -->
    </form> <!-- Form -->

    <script src="../js/validation.altagrupo.js"></script>


</div><!-- col -->



<?php

include("v-panelfooter.php");

?>
