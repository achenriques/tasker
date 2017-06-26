

<?php foreach ($tareas as $tarea) { ?>
            <div class="panel panel-default">

                <?php

               $display='block';

                //Si la tarea es de un grupo...

                if ($controladorCal->calIsFromGroup($tarea->getCalendario()->getIdCalendario())) {

                    //Obtengo datos del grupo

                    $grupo = $controladorCal->getGroupByCal($tarea->getCalendario()->getIdCalendario());

                    //Si no es admin o super admin no muestro los iconos de editar o borrar.

                    if (!$controladorGrupo->esAdminGrupo($datosUsuario->getIdUsuario(),$grupo->getIdGrupo()) && !$controlador->esSuperAdmin($datosUsuario)) {

                        $display='none';
                    }



                }


                ?>


                <div class="panel-body" style="border-left: 10px solid <?=$tarea->getCalendario()->getColor()?>">

                <div class="titTarea"><?=Tools::date2php($tarea->getFechaEstIni())?>- <?=$tarea->getNombreTarea()?> <?=$tarea->hasParent()?' [<a title="Ir a Tarea Padre" href="v-modificartarea.php?id='.$tarea->getTareaPadre().'">'.$tarea->getPadre()->getNombreTarea().'</a>]':''?>

                    <span class="pull-right hidden-xs hidden-sm" style="display:<?=$display?>"><a href="#" data-href="../index.php?controller=Tarea&amp;action=delete&amp;id=<?=$tarea->getIdTarea()?>" data-toggle="modal" data-target="#confirm-delete" title="Borrar Tarea"><i class="fa fa-remove fa-fw fa-2x" style="color:red;"></i></a></span>
                    <span class="pull-right hidden-xs hidden-sm" style="display:<?=$display?>"><a href="v-altatarea.php?tareaPadreId=<?=$tarea->getIdTarea()?>" title="Dividir Tarea"><i class="fa fa-tasks fa-fw fa-2x" style="color:blue;"></i></a></span>

                    <!--Modificar Tarea NON Modal-->
                    <span class="pull-right hidden-xs hidden-sm" style="display:<?=$display?>"><a href="v-modificartarea.php?id=<?=$tarea->getIdTarea()?>" title="Editar Tarea"><i class="fa fa-edit fa-fw fa-2x" style="color:orange;"></i></a></span>

                    <!--Modificar Tarea Modal-->
                    <!--<span class="pull-right hidden-xs hidden-sm"><a data-toggle="modal" data-target="#modificarTarea-<?=$tarea->getIdTarea()?>" title="Editar Tarea"><i class="fa fa-edit fa-fw fa-2x" style="color:orange;"></i></a></span>-->
                    <?php if (!$tarea->isClosed()) { ?>
                    <span class="pull-right hidden-xs hidden-sm"><a href="#" data-href="../index.php?controller=Tarea&amp;action=close&amp;id=<?=$tarea->getIdTarea()?>" data-toggle="modal" data-target="#confirm-close" title="Marcar como Finalizada"><i class="fa fa-check-circle fa-fw fa-2x" style="color:green;"></i></a></span>
                    <?php } ?>

                    <span class="pull-right" onclick="toggler('vermas-<?=$tarea->getIdTarea()?>')"><a title="Ver Más"><i class="fa fa-angle-double-down fa-fw fa-2x" style="color:lightgray;"></i></a></span> </div>



                    <div id="vermas-<?=$tarea->getIdTarea()?>" style="display:none"><hr>
                <p class="text-justify"><?=$tarea->getDescripcionTarea()?> </p>
                <hr>

                    <span class="pull-left text-muted small"><em>
                        <?php foreach($tarea->getDocumentos() as $doc){ ?><a href="../<?=$doc->getFicheroPath()?>" target="_blank"><?=$doc->getNombre()?></a> <?php } ?>
                    </em></span>

                        <span class="pull-right hidden-xs hidden-sm"><a href="v-calendario.php?idCalendario=<?=$tarea->getCalendario()->getIdCalendario()?>" style="font-weight: bold; color:<?=$tarea->getCalendario()->getColor()?>;" title="<?=$tarea->getCalendario()->getNombreCalendario()?>"> <?=$tarea->getCalendario()->getNombreCalendario()?> </a></span>


                    <span class="pull-right hidden-lg hidden-md" style="display:<?=$display?>"><a href="#" data-href="../index.php?controller=Tarea&amp;action=delete&amp;id=<?=$tarea->getIdTarea()?>" data-toggle="modal" data-target="#confirm-delete" title="Borrar Tarea"><i class="fa fa-remove fa-fw fa-2x" style="color:red;"></i></a></span>
                    <span class="pull-right hidden-lg hidden-md" style="display:<?=$display?>"><a href="v-modificartarea.php?id=<?=$tarea->getIdTarea()?>" title="Editar Tarea"><i class="fa fa-edit fa-fw fa-2x" style="color:orange;"></i></a></span>



                        <?php if (!$tarea->isClosed()) { ?>
                        <span class="pull-right hidden-lg hidden-md"><a href="#" data-href="../index.php?controller=Tarea&amp;action=close&amp;id=<?=$tarea->getIdTarea()?>" data-toggle="modal" data-target="#confirm-close" title="Marcar como Finalizada"><i class="fa fa-check-circle fa-fw fa-2x" style="color:green;"></i></a></span>
                    <?php } ?>


                </div>




                                  </div> <!-- panel-body -->
            </div> <!-- panel-default -->

<?php } ?>





        <!-- <?php /*include('inc-notifications.php'); */?> -->



    
        <?php 
            $confirm = ['text'  => '¿Está seguro de querer eliminar esta tarea?'];
            include('inc-confirm.php'); 
            $confirm = [
                'id' => 'confirm-close',
                'text'  => '¿Está seguro de querer finalizar esta tarea?',
                'bOkType' => 'warning',
                'bOk' => 'Finalizar tarea'
                ];
            include('inc-confirm.php'); 
        ?>

    <script type="text/javascript">
    function toggler(divId) {
    $("#" + divId).toggle();
    }

    </script>