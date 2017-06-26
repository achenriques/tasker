<?php
    # Vista: Consultar tarea (datos de la tarea)
    # Función: Muestra los datos de la tarea seleccionada en la vista anterior.
    # Creado por: Martín
    include("../Tools.php");
    include("v-panelheader.php");
    include_once '../controlador/TareaController.php';
    setlocale(LC_TIME, "es_ES");
    $controlador = new TareaController();
    $tareaId = $_GET['id'];
    $datosTarea = $controlador->getDatosTarea($tareaId);
    $tareas = $controlador->getAllTareas();
    $estados = $controlador->getAllEstados();
    if ($datosTarea->isNull()){
        $_GET['msg'] = 'errorNoData';
        $_GET['tipo'] = 'danger';
    }
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Consultar Tarea</h1>
    </div>
</div>
<div class="col-xs-9">
    
    <?php $disabled = true ?>
    <?php include('inc-modificartarea.php'); ?>
    <?php /*
    <form role="form" action='../index.php?controller=Tarea&amp;action=update' method='POST' data-toggle="validator">
        <div class="panel panel-default">
            <div class="panel-body">
                <!-- 1ª FILA -->
                <div class="row">
                    <!-- CODIGO -->
                    <div class="form-group col-xs-4">
                        <label for="codTarea">
                            <?=$idioma['Codigo de Tarea']?>
                        </label>
                        <div class="input-group">
                            <input type="text" id="codTarea" name="codTarea" class="form-control" value="<?=$datosTarea->getCodTarea()?>" disabled />
                        </div>
                    </div>
                    <!-- NOMBRE -->
                    <div class="form-group col-xs-8">
                        <label for="nombreTarea">
                            <?=$idioma['Nombre Tarea']?>
                        </label>
                        <div class="input-group">
                            <input type="text" id="nombreTarea" name="nombreTarea" class="form-control" value="<?=$datosTarea->getNombreTarea()?>" disabled />
                        </div>
                    </div>
                </div>
                <!-- 2ª FILA -->
                <div class="row">
                    <!-- DESCRIPCION -->
                    <div class="form-group  col-xs-12">
                        <label class="control-label" for="descripcionTarea">
                            <?=$idioma['Descripcion Tarea']?>
                        </label>
                        <textarea class="form-control" name="descripcionTarea" disabled >
                           <?=$datosTarea->getDescripcionTarea()?>
                        </textarea>
                    </div>
                </div>
                <!-- 3ª FILA -->
                <div class="row">
                    <!-- PADRE -->
                    <div class="form-group col-xs-6">
                        <label for="codPadre">
                            <?=$idioma['Tarea Padre']?>
                        </label>
                        <div class="input-group">
                            <input type="text" id="codPadre" name="codPadre" class="form-control" value="<?=$datosTarea->getTareaPadre()?>" disabled />
                        </div>
                    </div>
                    <!-- ESTADO -->
                    <div class="form-group col-xs-6">
                        <label for="codEstadoTarea">
                            <?=$idioma['Estado Tarea']?>
                        </label>
                        <div class="input-group">
                            <input type="text" id="codEstadoTarea" name="codEstadoTarea" class="form-control" value="<?=$datosTarea->getEstadoTarea()?>" disabled />
                        </div>
                    </div>
                </div>
                <!-- 4ª y 5ª FILA -->
                <div class="row">
                    <!-- INICIO ESTIMADO -->
                    <div class="form-group col-xs-6">
                        <label for="fechaEstIni">Inicio Estimado</label>
                        <input type="text" id="fechaEstIni" name="fechaEstIni" class="form-control" value="<?=Tools::date2php($datosTarea->getFechaEstIni())?>" placeholder="dd/mm/aaaa" disabled >
                    </div>
                    <!-- FIN ESTIMADO -->
                    <div class="form-group col-xs-6">
                        <label for="fechaEstFin">Fin Estimado</label>
                        <input type="text" id="fechaEstFin" name="fechaEstFin" class="form-control" value="<?=Tools::date2php($datosTarea->getFechaEstFin())?>" placeholder="dd/mm/aaaa" disabled >
                    </div>
                    <!-- INICIO REAL -->
                    <div class="form-group col-xs-6">
                        <label for="fechaRealIni">Inicio Real</label>
                        <input type="text" id="fechaRealIni" name="fechaRealIni" class="form-control" value="<?=Tools::date2php($datosTarea->getFechaRealIni())?>" placeholder="dd/mm/aaaa" disabled >
                    </div>
                    <!-- FIN REAL -->
                    <div class="form-group col-xs-6">
                        <label for="fechaRealFin">Fin Real</label>
                        <input type="text" id="fechaRealFin" name="fechaRealFin" class="form-control" value="<?=Tools::date2php($datosTarea->getFechaRealFin())?>" placeholder="dd/mm/aaaa" disabled>
                    </div>
                </div>
                <!-- SUBTAREAS -->
                <div class="row">
                    <fieldset>
                        <legend>Subtareas</legend>
                        <?php $tareas = $datosTarea->getSubTareas(); ?>
                        <div class="col-xs-12">
                            <?php
                                $link_edit = false;
                                include('inc-listatareasconsultar.php');
                            ?>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </form>
    */ ?>
    
</div>
<?php
    include("v-panelfooter.php");
?>