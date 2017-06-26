<table class="table table-striped">
    <thead>
    <tr>
        <th><?=$idioma['Nombre Grupo']?></th>
        <th><?=$idioma['Descripción Grupo']?></th>
        <th><?=$idioma['Visibilidad']?></th>
        <th></th>
        <!--<th></th>-->
    </tr>
    </thead>
    <tbody>
    <?php foreach ($groupsUsr as $gconsult){ ?>
    <tr>
        <td><?=$gconsult->getNombreGrupo()?> </td>
        <td><?=$gconsult->getDescripcionGrupo()?></td>
        <td><?=$gconsult->getVisibilidad()?></td>
        <!--<td><button class='btn btn-default btn-danger' onclick='doBorrar("usuario",21)'>X</button></td>-->
        <?php } ?>
        <td></td>
    </tr>
    </tbody>
</table>
