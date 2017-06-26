<?php
    include("v-panelheader.php");
    include_once '../controlador/CalendarioController.php';
    setlocale(LC_TIME, "es_ES");
    $controlador = new CalendarioController();
    $calendarioId = $_GET['id'];
    $datosCalendario = $controlador->getDatosCalendario($calendarioId);
    $calendarios = $controlador->getCalendarios($datosUsuario->getIdUsuario());
    /*if ($datosCalendario->isNull()){
        $_GET['msg'] = 'errorNoData';
        $_GET['tipo'] = 'danger';
    }*/
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?=$idioma['Modificar Calendario']?>
        </h1>
    </div>
</div>

<div class="col-xs-4">
    <?php
        $disabled = false;
        $tipo = "StandAlone";
        include('inc-modificarcalendario.php');
    ?>
</div>

<?php
    include("v-panelfooter.php");
?>