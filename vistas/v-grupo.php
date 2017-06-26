<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 18:38
 */

include("v-panelheader.php");

include_once '../controlador/GrupoController.php';

$controladorGrup = new GrupoController();
$groupsUsr = $controladorGrup->getGroupOfUser($datosUsuario->getIdUsuario());
//$groups = $controladorGrup->getAllGrupos();


?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=$idioma['Mis Grupos']?></h1>
</div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <!--<a data-toggle="modal" data-target="#modalNuevoGrupo" class="btn btn-outline btn-primary"><?=$idioma['Nuevo Grupo']?></a>-->
                <a href="v-altagrupo.php?return=consultagrupo" class="btn btn-outline btn-primary"><?=$idioma['Nuevo Grupo']?></a>
            </div>
        </div>
    </div>

      <div class="row">
          <div class="col-lg-12">
        <?php include('inc-grupousuario.php'); ?>
        <?php //include('inc-usuariosgrupo.php');
        //Por favor, arranxádeme este código de esta páxina. Trátase de consultar os usuarios
        //dun grupo en concreto mediante un select. Grazas?>
        </div>
       </div> <!-- row -->




    <!--
        <input type="hidden" name="idGrupo" value=""/>
        <button type="submit" class="btn btn-outline btn-danger" name="eliminar" formaction="../index.php?controller=Grupo&amp;action=deleteGroup" onclick='return confirm("<?=$idioma['¿Estas seguro/a?']?>")'><?=$idioma['Eliminar Grupo']?></button>
        -->

    <!-- /.col-lg-12 -->
</div>
</div>


<?php

include("v-panelfooter.php");

?>
