<?php

//recupero lista de todos los usuarios de la plataforma

$allUsers = $controlador->getAllUsuarios();


?>

<?php
if (sizeof($allUsers)>0) {
    ?>


<table class="table table-striped">
        <thead>
        <tr>

            <th><?=$idioma['Nombre']?></th>
            <th><?=$idioma['Admin']?></th>
            <th><?=$idioma['Seleccionar']?></th>
        </tr>
        </thead>
        <tbody>
        <?php if (sizeof($allUsers)) foreach ($allUsers as $user){ ?>
            <tr>

                <?php if (!$controladorGrupo->isInGrupo($user->getIdUsuario(),$datosGrupo->getIdGrupo())) { ?>

                <td><?=$user->getNombre()?></td>
                <td><input type="checkbox" name="admins[]" value="<?=$user->getIdUsuario()?>"></td>
                <td><input type="checkbox" name="seleccionados[]" value="<?=$user->getIdUsuario()?>"></td>

                    <?php } ?>

        <?php } ?>

        </tr>
        </tbody>
    </table>

    <input type="hidden" name="idGrupo" value="<?=$datosGrupo->getIdGrupo()?>">



    <button type="submit" class="btn btn-outline btn-primary" name="addMiembros"><?=$idioma['Anadir Seleccionados']?></button>


<?php } else { echo $idioma['No se han encontrado usuarios'];} ?>

