<?php
    if (sizeof($calendarios)>0) {
?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><?=$idioma['Nombre']?></th>
                <th><?=$idioma['Color']?></th>
                <th><?=$idioma['NumTareas']?></th>
                <?php if(isset($actions)) { ?>
                    <th>Acciones</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php if (sizeof($calendarios)) foreach ($calendarios as $calendario){ ?>
            <tr>
                <td><?=$calendario->getNombreCalendario()?></td>
                <td><i class="fa fa-circle fa-fw" style="color:<?=$calendario->getColor()?>"></i></td>
                <td><?=$controladorCal->getNumTareas($calendario->getIdCalendario())?></td>
                <?php if(isset($actions)) { ?>
                    <td>
                        <span class="pull-right"><a href="#" data-href="../index.php?controller=Calendario&amp;action=delete&amp;id=<?=$calendario->getIdCalendario()?>&return=<?=$return?>" data-toggle="modal" data-target="#confirm-delete" title="Eliminar Calendario"><i class="fa fa-remove fa-fw fa-2x" style="color:red;"></i></a></span>
                        <span class="pull-right"><a href="../vistas/v-modificarcalendario.php?id=<?=$calendario->getIdCalendario()?>&return=<?=$return?>" title="Modificar Calendario"><i class="fa fa-edit fa-fw fa-2x" style="color:orange;"></i></a></span>
                    </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php
    $confirm = [
        'text'  => '¿Está seguro de querer eliminar este calendario?',
    ];
    include('inc-confirm.php');
    include('inc-pluginTableData.php');
?>