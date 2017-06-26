<?php
/**
 * Created by IntelliJ IDEA.
 * User: rbr
 * Date: 30/12/15
 * Time: 18:34
 */

include("v-panelheader.php");
include_once '../controlador/GrupoController.php';
include_once '../controlador/ReunionController.php';

$controladorGrupo = new GrupoController();
$idGrupo = $_GET['id'];
$usuarios = $controladorGrupo->getGroupUsers($idGrupo);
$datosGrupo = $controladorGrupo->getDatosGrupo($idGrupo);

$controladorReunion = new ReunionController();
$reuniones = $controladorReunion->getReunionesGrupo($idGrupo);

$soyAdmin = $controladorGrupo->esAdminGrupo($datosUsuario->getIdUsuario(),$idGrupo);

?>



<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=$idioma['Reuniones']?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<?php if ($soyAdmin) { ?>

<div class="row">
    <div class="col-lg-12">
        <a data-toggle="modal" data-target="#altaReunion" class="btn btn-outline btn-primary"><?=$idioma['Nueva Reunion']?></a>

    </div>
</div>
    <br>
<?php } ?>


<div class="row">
    <div class="col-lg-12">

        <?php include('inc-listareuniones.php'); ?>

    </div>
</div>

<div id="altaReunion" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=$idioma['Nueva Reunion']?></h4>
            </div>
            <div class="modal-body">



                <?php include('inc-altareunion.php'); ?>


            </div>
        </div>

    </div>

</div>


<?php

include("v-panelfooter.php");

?>

