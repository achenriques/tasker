<div id="altaTarea" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=$idioma['Nueva Tarea']?></h4>
            </div>
            <div class="modal-body">
                <?php
                //$tareas = $tareasAll;
                $tipo = "Modal";
                include('inc-altatarea.php');
                //$tareas = $tareasUser;
                ?>
            </div>
        </div>

    </div>

</div>