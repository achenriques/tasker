        <?php 
            if (sizeof($tareas)>0) {
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th class="hidden-xs">Estado</th>
                    <th>Fecha Estimada Inicio</th>
                    <th>Fecha Estimada Fin</th>
                    <?php if(isset($actions)) { ?>
                    <th>Acciones</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
            <?php if (sizeof($tareas)) foreach ($tareas as $tarea){ ?>
                <tr>
                    
                    <td><?=$tarea->getNombreTarea()?></td>
                    <td class="hidden-xs"><?=$tarea->getEstado()->getNombreEstado()?></td>
                    <td><?=Tools::date2php($tarea->getFechaEstIni())?></td>
                    <td><?=Tools::date2php($tarea->getFechaEstFin())?></td>
                    <?php if(isset($actions)) { ?>
                    <td>
                        <span class="pull-right"><a href="#" data-href="../index.php?controller=Tarea&amp;action=delete&amp;id=<?=$tarea->getIdTarea()?>&return=<?=$return?>" data-toggle="modal" data-target="#confirm-delete" title="Borrar Tarea"><i class="fa fa-remove fa-fw fa-2x" style="color:red;"></i></a></span>
                        <span class="pull-right"><a href="../vistas/v-modificartarea.php?id=<?=$tarea->getIdTarea()?>&return=<?=$return?>" title="Modificar Tarea"><i class="fa fa-edit fa-fw fa-2x" style="color:orange;"></i></a></span>
                    </td>
                    <?php } ?>
                </tr>
            <?php } ?>    
            </tbody>
        </table>
        <?php } ?>

        <?php 
            $confirm = [
                //'title' => 'Confirmar Acción',
                'text'  => '¿Está seguro de querer eliminar esta tarea?',
                //'bOk' => 'Eliminar notificación'
                ];
            include('inc-confirm.php'); 
            //include('inc-pluginTableData.php');
        ?>
