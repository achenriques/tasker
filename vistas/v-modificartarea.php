<?php
/**
 * Created by NetBeans.
 * User: aouteiral
 * Date: 12/12/15
 * Time: 18:38
 */

//include("../Tools.php");
include("v-panelheader.php");
include_once '../controlador/TareaController.php';
include_once '../modelos/CalendarioMapper.php';

setlocale(LC_TIME, "es_ES");

$controlador = new TareaController();

$tareaId = $_GET['id'];
    
$datosTarea = $controlador->getDatosTarea($tareaId);
$tareas = $controlador->getAllTareas();
$estados = $controlador->getAllEstados();
$calendarios = (new CalendarioMapper())->getCalendarios($datosUsuario->getIdUsuario());

if ($datosTarea->isNull()){
    $_GET['msg'] = 'errorNoData';
    $_GET['tipo'] = 'danger';
    //header("location: /$base_dir/vistas/v-modificartarea.php?msg=errorNoData&tipo=danger");
}
?>

    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=$idioma['Modificar Tarea']?></h1>
        </div>

        <!--<ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#">Tarea</a></li>
            <li role="presentation"><a href="#">Subtareas (N)</a></li>
            <li role="presentation"><a href="#">Documentos (N)</a></li>
        </ul>
        <ul class="nav nav-pills" role="tablist">
            <li role="presentation" class="active"><a href="#">Home <span class="badge">42</span></a></li>
            <li role="presentation"><a href="#">Profile</a></li>
            <li role="presentation"><a href="#">Messages <span class="badge">3</span></a></li>
        </ul>-->
    </div>

    <div class="col-xs-8">

    <?php 
        $disabled = false;
        //$tipo = "StandAlone";
        include('inc-modificartarea.php'); 
    ?>

    </div><!-- col -->

<!-- docs -->





<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Documentos
            </div>
            <div class="panel-body">
    <?php
        $docs = $datosTarea->getDocumentos();
        if (sizeof($docs)>0) {
            $small_size = true;
            include('inc-listadocumentos.php');
        }
    ?>
            </div>
            <div class="panel-footer">
                <a data-toggle="modal" data-target="#modalAltaDoc" class="btn btn-outline btn-primary">Adjuntar Documento</a>
            </div>
        </div>
    </div> <!-- col docs -->
</div> <!-- row 1 -->
<!-- docs -->
    
</div><!-- wrapper -->



<!--<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <a data-toggle="modal" data-target="#modalAltaDoc" class="btn btn-outline btn-primary">Adjuntar Documento</a>
        </div>
    </div>
</div>-->

<div id="modalAltaDoc" class="modal fade" role="dialog">
    <?php
    include('inc-altadocumento.php');
    ?>
</div>


<!-- -->


<?php

include("v-panelfooter.php");

?>
