<section id="tareasPublicas" class="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 text-center">
                <h2><?=$idioma['Tareas Publicas']?></h2>
                <hr class="small">
                <div class="row">

                    <?php foreach ($gruposPublicos as $grupoPublico) { ?>

                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-"></i><?=$idioma['Grupo']?>: <?=$grupoPublico->getNombreGrupo()?>
                                </div>

                                <div class="panel-body">

                                    <?php //Tareas de cada grupo

                                    $tareas = $controller->getTareasGrupo($grupoPublico->getCalendario());

                                    if (count($tareas)>0) {

                                        foreach ($tareas as $tarea) { ?>


                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th><?=$idioma['Nombre']?></th>
                                                    <th><?=$idioma['Fecha Estimada Inicio']?></th>
                                                    <th><?=$idioma['Fecha Estimada Fin']?></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <tr>
                                                    <td><?=$tarea->getNombreTarea()?></td>
                                                    <td><?=Tools::date2php($tarea->getFechaEstIni())?></td>
                                                    <td><?=Tools::date2php($tarea->getFechaEstFin())?></td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        <?php } } else {

                                        echo '<p>'.$idioma['Este grupo no tiene tareas en este momento'].'</p>';

                                    }

                                    ?>


                                </div>

                                <div class="panel-footer">


                                    <button type="button" onclick="muestraModal(this)" class="btn btn-outline btn-primary" name="unirse" id="<?=$grupoPublico->getNombreGrupo()?>" value="<?=$grupoPublico->getIdGrupo()?>"><?=$idioma['Unirse a Grupo']?></button>


                                </div>
                            </div>

                        </div>

                    <?php } ?>

                </div>
                <!-- /.row (nested) -->

            </div>
            <!-- /.col-lg-10 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

<script>

    function muestraModal(elemento) {

        $("#modalRegistrarse").modal("show");
        document.getElementById('grupo').style.display = "block";
        document.getElementById('grupoSel').value = elemento.id;
        document.getElementById('grupoSelCod').value = elemento.value;





    }

</script>