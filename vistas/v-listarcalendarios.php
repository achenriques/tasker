
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?=$idioma['Calendarios']?>
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <!-- <a href="v-altacalendario.php?return=<?=$return?>" class="btn btn-outline btn-primary">

            </a> -->

            <a data-toggle="modal" data-target="#altaCalendario" class="btn btn-outline btn-primary"><?=$idioma['Nuevo Calendario']?></a>
        </div>
    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php
        $actions = true;
        include('inc-listacalendarios.php');
    ?>
    <hr/>
</div>

<div id="altaCalendario" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=$idioma['Nuevo Calendario']?></h4>
            </div>
            <div class="modal-body">

                <form role="form" action='../index.php?controller=Calendario&amp;action=add' method='POST'>

                <?php

                include('inc-altacalendario.php');

                ?>

                    </form>
            </div>
        </div>

    </div>

</div>

<?php
    include("v-panelfooter.php");
?>


