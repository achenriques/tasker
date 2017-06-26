<?php
/**
 * Created by IntelliJ IDEA.
 * User: rbr
 * Date: 23/12/15
 * Time: 19:21
 */

include("../tools.php");
include("v-panelheader.php");
include_once '../controlador/GrupoController.php';
include_once '../controlador/TareaController.php';
include_once '../controlador/CalendarioController.php';

$idGrupo = $_GET['idGrupo'];


$controladorTarea = new TareaController();

$controladorGrupo = new GrupoController();



$usuarios = $controladorGrupo->getGroupUsers($idGrupo);



$datosGrupo = $controladorGrupo->getDatosGrupo($_GET['idGrupo']);

$soySuperAdmin = $controlador->esSuperAdmin($datosUsuario);

if ($controladorGrupo->isInGrupo($datosUsuario->getIdUsuario(),$idGrupo) || $soySuperAdmin) {

$soyAdmin = $controladorGrupo->esAdminGrupo($datosUsuario->getIdUsuario(),$idGrupo);

//$controladorCal = new CalendarioController();
//$calendarios = $controladorCal->getCalendarios($datosUsuario->getIdUsuario());
//$estados = $controladorTarea->getAllEstados(); */

//Buscamos las tareas del usuario actual
//$tareas = $controladorTarea->getTareasUsuario($datosUsuario->getIdUsuario());

if ($soySuperAdmin) {

    //Aunque no este en el grupo, muestro todas.
    $tareas = $controladorTarea->getTareasGrupo($datosGrupo->getCalendario());


} else {


    $tareas = $controladorTarea->getTareasByCal($datosUsuario->getIdUsuario(),$datosGrupo->getCalendario());


}


?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=$datosGrupo->getNombreGrupo()?><?php if ($soyAdmin || $soySuperAdmin) { echo ' ('.$idioma['Administrador'].')'; }?>
            </h1>
        </div>

        <!-- /.col-lg-12 -->
    </div>



    <div class="row">

        <div class="col-lg-12">


                <div class="form-group">

                    <?php if ($soyAdmin || $soySuperAdmin) { ?>

                        <a data-toggle="modal" data-target="#altaTarea" class="btn btn-outline btn-primary"><?=$idioma['Nueva Tarea']?></a>



                    <?php  } ?>

                    <a href="v-reunion.php?id=<?=$datosGrupo->getIdGrupo()?>" class="btn btn-outline btn-primary"><?=$idioma['Reuniones']?></a>

                </div>

        </div>

    </div>




<div class="row">
    <div class="col-lg-8 col-md-8">

<?php
    if (count($tareas) > 0)  {
        include('inc-paneltareas.php');
    } else {
        //if (!$finalizadas)
        echo '<h3>'.$idioma['¡Genial! No tienes tareas pendientes.'].'</h3>';
    }
?>

    </div> <!-- col tareas -->

    <div class="row">
        <div class="col-lg-4 col-md-4">

            <?php include('inc-listamiembros.php'); ?>

        </div> <!-- col miembros -->

    </div> <!-- row 1 -->


    <!-- /#page-wrapper -->

</div> <!-- Da warning porque se abre en el header pero esta bien -->

    <div id="altaTarea" class="modal fade" role="dialog">

        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?=$idioma['Nueva Tarea']?></h4>
                </div>
                <div class="modal-body">
                    <?php
                    //$tareas = $tareasAll;
                    $tipo = "Modal";
                    include('inc-altatarea.php');

                    ?>
                </div>
            </div>

        </div>

    </div>

<?php } else { ?>

    <div class="row">
        <div class="col-lg-12">
            <h3><?=$idioma['NoPertenecesAlGrupo']?></h3>
        </div>

        <!-- /.col-lg-12 -->
    </div>



<?php } ?>

<?php

include("v-panelfooter.php");

?>