<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 14/12/15
 * Time: 19:32
 */


include("v-panelheader.php");
require_once("../controlador/DocumentoController.php");
require_once("../controlador/TareaController.php");

$controladorTarea = new TareaController();
$controladorDoc = new DocumentoController();


?>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=$controlador->getNumUsers()?></div>
                        </div>
                    </div>
                </div>
                <a href="v-listarusuarios.php">
                    <div class="panel-footer">
                        <span class="pull-left"><?=$idioma['Administrar Usuarios']?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-group fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=$controladorGrup->getNumGrupos()?></div>
                        </div>
                    </div>
                </div>
                <a href="v-consultagrupo.php">
                    <div class="panel-footer">
                        <span class="pull-left"><?=$idioma['Administrar Grupos']?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=$controladorTarea->getNumAllTareas()?></div>
                        </div>
                    </div>
                </div>
                <a href="v-tareas.php">
                    <div class="panel-footer">
                        <span class="pull-left"><?=$idioma['Administrar Tareas']?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?=$controladorDoc->getNumDocs()?></div>
                        </div>
                    </div>
                </div>
                <a href="v-consultadocumento.php">
                    <div class="panel-footer">
                        <span class="pull-left"><?=$idioma['Administrar Documentos']?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">


        </div>

<?php

include("v-panelfooter.php");

?>