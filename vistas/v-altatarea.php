<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 18:38
 */

include("v-panelheader.php");
include_once '../controlador/TareaController.php';
include_once '../controlador/CalendarioController.php';

$controlador = new TareaController();
$controladorCal = new CalendarioController();

//Buscamos las tareas del usuario actual
$tareas = $controlador->getTareasUsuario($datosUsuario->getIdUsuario());

//$tareas = $controlador->getAllTareas();
$calendarios = $controladorCal->getCalendarios($datosUsuario->getIdUsuario());

?>


    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Alta Tarea</h1>
        </div>

        </div>


            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php
                $disabled = false;
                $tipo = "StandAlone";
                include('inc-altatarea.php');
            ?>


</div><!-- col -->


</div><!-- wrapper -->

<?php

include("v-panelfooter.php");

?>
