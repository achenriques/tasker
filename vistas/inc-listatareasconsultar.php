<?php
# Tabla: Listado de tareas
# Función: Devuelve un listado de tareas para la vista de consultar tareas.
# Creador por: Martín
    if(!isset($link_edit)) $link_edit = true
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th><?=$idioma['Nombre']?></th>
            <th><?=$idioma['Estado']?></th>
            <th><?=$idioma['Fecha Estimada Inicio']?></th>
            <th><?=$idioma['Fecha Estimada Fin']?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tareas as $tarea){ ?>
        <tr>
            <td>
                <?php if ($link_edit) { ?>
                <a href="../vistas/v-consultartarea2.php?id=<?=$tarea->getIdTarea()?>"><?=$tarea->getNombreTarea()?></a>
                <?php } else { ?>
                <?=$tarea->getNombreTarea()?><?php } ?>
            </td>
            <td><?=$tarea->getEstadoTarea()?></td>
            <td><?=Tools::date2php($tarea->getFechaEstIni())?></td>
            <td><?=Tools::date2php($tarea->getFechaEstFin())?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>