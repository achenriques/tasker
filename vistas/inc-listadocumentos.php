<table class="table table-striped">
    <thead>
    <tr>
        <th><?=$idioma['Nombre Documento']?></th>
        <th><?=$idioma['Acciones']?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($docs as $doc){ ?>
    <tr>
        <td><?=$doc->getNombre()?></td>
        <td>
        <?php if($small_size) { ?>
            <span class="pull-right"><a href="#" data-href="../index.php?controller=Documento&amp;action=delete&amp;id=<?=$doc->getId()?>" data-toggle="modal" data-target="#confirm-delete" title="Borrar Documento"><i class="fa fa-remove fa-fw" style="color:red;"></i></a></span>
            <span class="pull-right"><a class="view-pdf" href="../<?=$doc->getFicheroPath()?>" title="<?=$doc->getNombre()?>"><i class="fa fa-eye fa-fw"></i></a></span>
        <?php } else { ?>
            <span class="pull-right"><a href="#" data-href="../index.php?controller=Documento&amp;action=delete&amp;id=<?=$doc->getId()?>" data-toggle="modal" data-target="#confirm-delete" title="Borrar Documento"><i class="fa fa-remove fa-fw fa-2x" style="color:red;"></i></a></span>
            <span class="pull-right"><a class="view-pdf" href="../<?=$doc->getFicheroPath()?>" title="<?=$doc->getNombre()?>"><i class="fa fa-file-pdf-o fa-fw fa-2x"></i></a></span>
        <?php } ?>
        </td>
        <?php } ?>
    </tr>
    </tbody>
</table>

<?php
/* Parámetros para chamar á modal confirm */
$confirm = [
    //'title' => 'Confirmar Borrado',
    'text'  => '¿Está seguro de querer eliminar este documento?',
    //'bOk' => 'Eliminar grupo'
];
/* Inclusion da modal confirm */
include('inc-confirm.php');
/* Paxinador da táboa */
//include('inc-pluginTableData.php');
?>

<!-- jQuery view-pdf JavaScript -->
<script src="../js/view-pdf.js"></script>
