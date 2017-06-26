<?php
/**
 * Created by IntelliJ IDEA.
 * User: crmiguez
 * Date: 14/12/15
 * Time: 22:15
 */

include("v-panelheader.php");
include_once '../controlador/GrupoController.php';
include_once '../modelos/GrupoMapper.php';

$controladorGrup = new GrupoController();

/* Solo muestro los grupos de los cuales soy admin, salvo que sea superadmin que muestro todos */

if ($controlador->esSuperAdmin($datosUsuario)) {


$groups = $controladorGrup->getAllGrupos();


} else {

        $groups = $controladorGrup->getAllMyGrupos($datosUsuario->getIdUsuario());

}

?>



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Grupos</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <!--<a data-toggle="modal" data-target="#modalNuevoGrupo" class="btn btn-outline btn-primary"><?=$idioma['Nuevo Grupo']?></a>-->
                <a href="v-altagrupo.php?return=consultagrupo" class="btn btn-outline btn-primary"><?=$idioma['Nuevo Grupo']?></a>
            </div>
        </div>
    </div>

    <div class="col-xs-12">


    <?php if (sizeof($groups) > 0) {

        include('inc-listagrupos.php');

        } else {

            echo '<h3>'.$idioma['No existen grupos para gestionar'].'</h3>';

        } ?>

    </div><!-- col -->



</div><!-- wrapper -->

<?php

include("v-panelfooter.php");

?>