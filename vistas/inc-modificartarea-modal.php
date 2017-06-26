<div id="modificarTarea-<?=$tarea->getIdTarea()?>" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=$idioma['Modificar Tarea']?></h4>
            </div>
            <div class="modal-body">
                <?php
                $datosTarea = $tarea;
                $tareas = $tareasAll;
                $disabled = false;
                $tipo = "Modal";
                include('inc-modificartarea.php');
                $tareas = $tareasUser;
                ?>
            </div>
        </div>

    </div>

</div>