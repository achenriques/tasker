<?php
if (sizeof($reuniones)>0) {
?>

<table class="table table-striped">
    <thead>
    <tr>
        <th><?=$idioma['Fecha Reunion']?></th>
        <th><?=$idioma['Estado']?></th>
        <th class="hidden-xs"><?=$idioma['Acta']?></th>
        <th><?=$idioma['Acciones']?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($reuniones as $reunion){ ?>
    <tr>
        <!-- Como new Grupo non contempla o id, cando se recuperan os datos do select, meteos mal no obxecto Grupo -->
        <td><?=Tools::date2php($reunion->getFechaReunion())?></td>
        <td>
            <?php switch ($reunion->getEstadoReunion()) {

                case '0':
                    echo $idioma['Propuesta'];
                    break;
                case '1':
                    echo $idioma['Confirmada'];
                    break;
                case '2':
                    echo $idioma['Realizada'];
                    break;
                case '3':
                    echo $idioma['Cancelada'];
                    break;


            }?>

        </td>
        <td class="hidden-xs"><?php if($reunion->hasActa()){ ?><a href="../<?=$reunion->getFicheroPath()?>" target="_blank"><?=$idioma['Acta']?></a><?php } ?></td>
        <td>
           <?php if ($reunion->getEstadoReunion() == 0) { ?>

                <?php if ($soyAdmin) { ?>

                   <span class="pull-right"><a href="#" data-href="../index.php?controller=Reunion&amp;action=delete&amp;id=<?=$reunion->getIdReunion()?>" data-toggle="modal" data-target="#confirm-delete" title="Eliminar Reunion"><i class="fa fa-remove fa-fw fa-2x" style="color:red;"></i></a></span>
                   <!--<span class="pull-right"><a href="#" data-href="../index.php?controller=Reunion&amp;action=setCancelada&amp;idReunion=<?=$reunion->getIdReunion()?>&amp;idGrupo=<?=$idGrupo?>&amp;idUsuario=<?=$datosUsuario->getIdUsuario()?>" data-toggle="modal" data-target="#confirm-cancel" title="Cancelar Reunion"><i class="fa fa-remove fa-fw fa-2x" style="color:red;"></i></a></span>-->
                   <span class="pull-right"><a data-toggle="modal" data-target="#modificarFecha-<?=$reunion->getIdReunion()?>" title="Cambiar Fecha"><i class="fa fa-calendar-o fa-fw fa-2x" style="color:orange;"></i></a></span>
                   <span class="pull-right"><a href="#" data-href="../index.php?controller=Reunion&amp;action=setConfirmada&amp;idReunion=<?=$reunion->getIdReunion()?>&amp;idGrupo=<?=$idGrupo?>&amp;idUsuario=<?=$datosUsuario->getIdUsuario()?>" data-toggle="modal" data-target="#confirm-close" title="Marcar como Confirmada"><i class="fa fa-check-circle fa-fw fa-2x" style="color:orange;"></i></a></span>

               <?php } else { ?>

                   <span class="pull-right"><a href="#" data-href="../index.php?controller=Reunion&amp;action=confirmarNoAsistencia&amp;idReunion=<?=$reunion->getIdReunion()?>&amp;idGrupo=<?=$idGrupo?>&amp;idUsuario=<?=$datosUsuario->getIdUsuario()?>" data-toggle="modal" data-target="#confirm-no-asistencia" title="Confirmar la No Asistencia"><i class="fa fa-reply fa-fw fa-2x" style="color:red;"></i></a></span>
                   <span class="pull-right"><a href="#" data-href="../index.php?controller=Reunion&amp;action=confirmarAsistencia&amp;idReunion=<?=$reunion->getIdReunion()?>&amp;idGrupo=<?=$idGrupo?>&amp;idUsuario=<?=$datosUsuario->getIdUsuario()?>" data-toggle="modal" data-target="#confirm-asistencia" title="Confirmar Asistencia"><i class="fa fa-reply fa-fw fa-2x" style="color:green;"></i></a></span>

               <?php } ?>

               <?php } ?>

            <?php if ($reunion->getEstadoReunion() == 1 && $soyAdmin) { ?>


                <span class="pull-right"><a href="#" data-href="../index.php?controller=Reunion&amp;action=setCancelada&amp;idReunion=<?=$reunion->getIdReunion()?>&amp;idGrupo=<?=$idGrupo?>&amp;idUsuario=<?=$datosUsuario->getIdUsuario()?>" data-toggle="modal" data-target="#confirm-cancel" title="Cancelar Reunion"><i class="fa fa-remove fa-fw fa-2x" style="color:red;"></i></a></span>
                <span class="pull-right"><a href="#" data-toggle="modal" data-target="#subirActa-<?=$reunion->getIdReunion()?>" title="Generar Acta"><i class="fa fa-copy fa-fw fa-2x" style="color:...;"></i></a></span>
                <span class="pull-right"><i class="fa fa-check fa-fw fa-2x" style="color:green;"></i></span>

            <?php } ?>

            <!-- Si esta cancelada, ya no muestro nada -->

        </td>


        <?php } ?>
    </tr>
    </tbody>
</table>


<?php } ?>


<?php foreach ($reuniones as $key){

$idReunion = $key->getIdReunion();

    ?>



<div id="modificarFecha-<?=$idReunion?>" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=$idioma['Cambiar Fecha']?></h4>
            </div>
            <div class="modal-body">
                <form id="cambiarFecha" name="cambiarFecha" role="form" action="../index.php?controller=Reunion&amp;action=updateFecha" method='POST'>


                    <?php include('inc-altareunion.php'); ?>

                </form>
            </div>
        </div>

    </div>

</div>

    <div id="subirActa-<?=$idReunion?>" class="modal fade" role="dialog">

        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?=$idioma['Acta Reunion']?>(WIP)</h4>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" role="form" action='../index.php?controller=Reunion&amp;action=uploadActa&amp;idUsuario=<?=$datosUsuario->getIdUsuario()?>&amp;idReunion=<?=$idReunion?>&amp;idGrupo=<?=$idGrupo?>' method='POST'>


                        <?php include('inc-altaacta.php'); ?>

                    </form>
                </div>
            </div>

        </div>

    </div>

<?php } ?>




<?php
/* Parámetros para chamar á modal confirm */
$confirm = [
    'text'  => '¿Está seguro de querer eliminar esta reunion?',
    'bOk' => 'Eliminar Reunión'
];
include('inc-confirm.php');
    $confirm = [
    'id' => 'confirm-cancel',
    'text'  => '¿Está seguro de querer cancelar esta reunion?',
        'bOk' => 'Cancelar Reunión'
];
include('inc-confirm.php');
$confirm = [
        'id' => 'confirm-close',
        'text'  => '¿Está seguro de querer confirmar la reunión?',
        'bOkType' => 'warning',
        'bOk' => 'Confirmar Reunión'
    ];
include('inc-confirm.php');
$confirm = [
    'id' => 'confirm-asistencia',
    'text'  => '¿Está seguro de querer confirmar la asistencia?',
    'bOkType' => 'warning',
    'bOk' => 'Confirmar'
];
include('inc-confirm.php');
$confirm = [
    'id' => 'confirm-no-asistencia',
    'text'  => '¿Está seguro de querer confirmar la NO asistencia?',
    'bOkType' => 'warning',
    'bOk' => 'Confirmar'
];
include('inc-confirm.php');

/* Inclusion da modal confirm */


?>

