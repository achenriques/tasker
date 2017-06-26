<form action="inc-usuariosgrupo.php" method="POST">
<select name="idGrupoSeleccion" class = "form-control">
    <?php foreach ($groups as $grupoconsult){ ?>
    <option value="<?=$grupoconsult->getIdGrupo()?>"><?=$grupoconsult->getNombreGrupo()?></option>
    <?php } ?>
</select>
    <input type="submit" value="Enviar datos!" >
</form>
<table class="table table-striped">
    <?$groupsUsrs = $controladorGrup->getGroupUsers();?>
    <thead>
    <tr>
        <th><?=$idioma['Usuario']?></th>
        <th><?=$idioma['Nombre']?></th>
        <th><?=$idioma['Email']?></th>
        <!--<th></th>-->
    </tr>
    </thead>
    <tbody>
    <?php foreach ($groupsUsrs as $grsconsult){ ?>
    <tr>
        <td><?=$grsconsult->getUsername()?> </td>
        <td><?=$grsconsult->getNombre()?></td>
        <td><?=$grsconsult->getEmail()?></td>
        <td>
        </td>
        <!--<td><button class='btn btn-default btn-danger' onclick='doBorrar("usuario",21)'>X</button></td>-->
        <?php } ?>
        <td></td>
    </tr>
    </tbody>
</table>

