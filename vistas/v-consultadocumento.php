<?php
/**
 * Created by IntelliJ IDEA.
 * User: Candi
 * Date: 26/12/2015
 * Time: 18:41
 */
include("v-panelheader.php");
include_once '../controlador/DocumentoController.php';
include_once '../modelos/DocumentoMapper.php';

$controladorDocs = new DocumentoController();
$docs = $controladorDocs->getAllDocumentos();

?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Documentos</h1>
    </div>
</div>

<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
<?php
    $small_size = false;
    include('inc-listadocumentos.php');
?>
</div><!-- col -->

</div><!-- wrapper -->

<?php

include("v-panelfooter.php");

?>
