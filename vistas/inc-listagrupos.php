<table class="table table-striped">
    <thead>
    <tr>
        <th><?=$idioma['Nombre Grupo']?></th>
        <th><?=$idioma['Descripción Grupo']?></th>
        <th><?=$idioma['Visibilidad']?></th>
        <th><?=$idioma['Acciones']?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($groups as $grupoconsult){ ?>
        <tr>
            <!-- Como new Grupo non contempla o id, cando se recuperan os datos do select, meteos mal no obxecto Grupo -->
            <td><a href="v-panelgrupo.php?idGrupo=<?=$grupoconsult->getIdGrupo()?>"><?=$grupoconsult->getNombreGrupo()?></a> </td>
            <td><?=$grupoconsult->getDescripcionGrupo()?></td>
            <td><?=$grupoconsult->getVisibilidadTexto()?></td>
            <td>
                <span class="pull-right"><a href="../vistas/v-modificargrupo.php?id=<?=$grupoconsult->getIdGrupo()?>&return=consultagrupo" title="Modificar Grupo"><i class="fa fa-edit fa-fw fa-2x" style="color:orange;"></i></a></span>
                <span class="pull-right"><a href="#" data-href="../index.php?controller=Grupo&amp;action=delete&amp;id=<?=$grupoconsult->getIdGrupo()?>&return=consultagrupo" data-toggle="modal" data-target="#confirm-delete" title="Borrar Grupo"><i class="fa fa-remove fa-fw fa-2x" style="color:red;"></i></a></span>
            </td>
    <?php } ?>
        </tr>
    </tbody>
</table>

<?php 
            /* Parámetros para chamar á modal confirm */
            $confirm = [
                //'title' => 'Confirmar Borrado',
                'text'  => '¿Está seguro de querer eliminar este grupo?',
                //'bOk' => 'Eliminar grupo'
                ];
            /* Inclusion da modal confirm */
            include('inc-confirm.php'); 
            /* Paxinador da táboa */
            include('inc-pluginTableData.php'); 
        ?>