<?php
    # Vista: Consultar tarea (listado)
    # Función: Muestra un listado de tareas que se pueden consultar.
    # Creador por: Martín
    include("v-panelheader.php");
    include_once '../controlador/TareaController.php';
    $controlador = new TareaController();
    $tareas = $controlador->getAllTareas();
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Consultar Tarea</h1>
    </div>
</div>
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
    <?php
        //include('inc-listatareasconsultar.php');
        $link_href = "../vistas/v-consultartarea2.php";
        include('inc-listatareas.php');
    ?>
</div>
<?php
    include("v-panelfooter.php");
?>