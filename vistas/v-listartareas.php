<?php
/**
 * Created by NetBeans.
 * User: aouteiral
 * Date: 12/12/15
 * Time: 18:38
 */
?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=$idioma['Tareas']?></h1>
        </div>
    </div>


    <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php //$link_href = "../vistas/v-modificartarea.php"; ?>
        <?php 
            $actions = true;
            include('inc-listatareas.php'); 
        ?>
        <hr/>
    </div><!-- col -->

        </div>
    
<!-- Alta Modal -->    
<div id="modalNuevaTarea" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=$idioma['Crear cuenta']?></h4>
            </div>
            <div class="modal-body">
                <?php include('inc-altatarea.php'); ?>
            </div>
        </div>
    </div>
</div>
    
    
</div><!-- wrapper -->

<?php
include('inc-pluginTableData.php');
include("v-panelfooter.php");

?>
 
