<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 18:38
 */

include("../tools.php");
include("v-panelheader.php");
include_once '../controlador/TareaController.php';
include_once '../controlador/GrupoController.php';

$controladorTarea = new TareaController();
$controladorGrupo = new GrupoController();


$estados = $controladorTarea->getAllEstados();

$finalizadas = (isset($_GET['e']) && ($_GET['e'] == "closed")) ? true : false;
$filtroEstado = (isset($_GET['e']) && ($_GET['e'] == "closed")) ? Tarea::$EST_FINALIZADA : Tarea::$EST_CREADA;

//Buscamos las tareas del usuario actual
$tareas = $controladorTarea->getTareasUsuario($datosUsuario->getIdUsuario(), $filtroEstado);
$tareasAll = $controladorTarea->getAllTareas();
$tareasUser = $tareas;

?>

    <div class="row">
        <div class="col-lg-12">
            <h1><?=$finalizadas ? $idioma['Tareas Finalizadas'] : $idioma['Tareas Pendientes']?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <?php if ($finalizadas) { ?>
                <a href="?" class="btn btn-info"><?=$idioma['Ver pendientes']?></a>
                <?php } else { ?>
                <a data-toggle="modal" data-target="#altaTarea" class="btn btn-outline btn-primary"><?=$idioma['Nueva Tarea']?></a>
                <a href="?e=closed" class="btn btn-info"><?=$idioma['Ver finalizadas']?></a>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="row">

    <div class="col-lg-8">

<?php
    if (count($tareas) > 0)  {
        include('inc-paneltareas.php');
    } else {
        if (!$finalizadas)
        echo '<h3>'.$idioma['¡Genial! No tienes tareas pendientes.'].'</h3>';
    }
?>

        </div> <!-- col -->

<div class="col-lg-4">


<?php include('inc-calendar.php'); ?>

</div>

        </div> <!-- row -->

    <!-- /#page-wrapper -->

</div> <!-- Da warning porque se abre en el header pero esta bien -->


<?php

/*
foreach ($tareas as $tarea) {
    include ("inc-modificartarea-modal.php");
}*/

include("inc-altatarea-modal.php");

include("v-panelfooter.php");

?>