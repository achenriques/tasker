<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 18:38
 */

include("v-panelheader.php");

?>

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Notificaciones</h1>
            </div>
            <!-- /.col-lg-12 -->
            
            
            
            
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
<?php foreach ($notifs as $notif) { ?>
            <div id="#panel-<?=$notif->getId()?>" class="panel panel-default">
                <div class="panel-body">
                    <div class="titTarea">
                        <i class="fa fa-<?=$notif->getCss()?> fa-fw"></i> <?=$notif->getTexto()?>
                        <span class="pull-right"><i class="fa fa-calendar fa-fw"></i><em><?=$notif->getTimeAgo()?></em></span>
                    </div>
                    <span class="pull-left text-muted small remitenteNotif"><em><?=$notif->getRemitenteNombre()?></em></span>
                    <span class="pull-right"><a href="#" data-href="../index.php?controller=Notificacion&amp;action=drop&amp;id=<?=$notif->getId()?>&return=notificaciones" data-toggle="modal" data-target="#confirm-delete" title="Descartar Notificación"><i class="fa fa-remove fa-fw fa-2x" style="color:red;"></i></a></span>
                </div> <!-- panel-body -->
            </div> <!-- panel-default -->
<?php } ?>
        </div> <!-- cierre col 8 -->
        <!-- /.col-lg-8 -->
        <!-- <?php /*include('inc-notifications.php'); */?> -->
    <!-- /.row -->
    </div>            
            
            
        </div>

        <?php 
            $confirm = [
                //'title' => 'Confirmar Acción',
                'text'  => '¿Está seguro de querer descartar esta notificación?',
                'bOk' => 'Descartar notificación'
                ];
            include('inc-confirm.php'); 
        ?>

    </div>


<?php

include("v-panelfooter.php");

?>