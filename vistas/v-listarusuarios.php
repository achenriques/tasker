<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 20/12/15
 * Time: 13:29
 */

include("v-panelheader.php");
include_once '../controlador/UsuarioController.php';

$controlador = new UsuarioController();
$usuarios = $controlador->getAllUsuarios();

/* Controla la redireccion de los modales*/

$destino_ok = "v-listarusuarios.php";
$destino_error = "v-listarusuarios.php";

?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=$idioma['Usuarios']?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <a data-toggle="modal" data-target="#modalRegistrarse" class="btn btn-outline btn-primary"><?=$idioma['Nuevo Usuario']?></a>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <?php include('inc-listausuarios.php'); ?>
        <hr/>
        <!-- <button class='btn btn-default btn-primary' onclick="location.href='v-altausuario.php'">Crear</button> -->
    </div><!-- col -->

  <?php include('inc-modal-registrarusuario.php'); ?>

</div><!-- wrapper -->

<?php

include("v-panelfooter.php");

?>