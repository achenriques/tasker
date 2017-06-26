<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 18:38
 */

include("v-panelheader.php");
include_once '../controlador/TareaController.php';
include_once '../controlador/GrupoController.php';

$controladorGrupo = new GrupoController();

$controladorTarea = new TareaController();

$estados = $controladorTarea->getAllEstados();

$idCalendario = $_GET['idCalendario'];

$datosCalendario = $controladorCal->getDatosCalendario($idCalendario);

$finalizadas = (isset($_GET['e']) && ($_GET['e'] == "closed")) ? true : false;
$filtroEstado = (isset($_GET['e']) && ($_GET['e'] == "closed")) ? Tarea::$EST_FINALIZADA : Tarea::$EST_CREADA;

//Buscamos las tareas del usuario actual en el calendario seleccionado.
$tareas = $controladorTarea->getTareasByCal($datosUsuario->getIdUsuario(),$datosCalendario->getIdCalendario(),$filtroEstado);

?>

<div class="row">
    <div class="col-lg-12">
        <h1>[<?=$datosCalendario->getNombreCalendario()?>] <?=$finalizadas ? $idioma['Tareas Finalizadas'] : $idioma['Tareas Pendientes']?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <?php if ($finalizadas) { ?>
                <a href="?&idCalendario=<?=$datosCalendario->getIdCalendario()?>" class="btn btn-info"><?=$idioma['Ver pendientes']?></a>
            <?php } else { ?>
                <a href="?e=closed&idCalendario=<?=$datosCalendario->getIdCalendario()?>" class="btn btn-info"><?=$idioma['Ver finalizadas']?></a>
            <?php } ?>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-lg-12">

        <?php
        if (count($tareas) > 0)  {
            include('inc-paneltareas.php');
        } else {
            if (!$finalizadas)
                echo '<h3>'.$idioma['¡Genial! No tienes tareas pendientes.'].'</h3>';
        }
        ?>

    </div> <!-- col -->
</div> <!-- row -->

<!-- /#page-wrapper -->

</div> <!-- Da warning porque se abre en el header pero esta bien -->

</div>

<?php

include("v-panelfooter.php");

?>
