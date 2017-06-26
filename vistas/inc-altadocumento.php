<?php
/**
 * Created by IntelliJ IDEA.
 * User: aouteiral
 * Date: 29/12/15
 * Time: 14:12
 */
?>




    <!--<form role="form" action='../index.php?controller=Documento&amp;action=subirDocumento' method='POST' enctype="multipart/form-data">

        <label for="photo">Documentos</label>
        <div class="drag-drop">
            <input type="file" multiple="multiple" id="photo" />
      <span class="fa-stack fa-2x">
        <i class="fa fa-cloud fa-stack-2x bottom pulsating"></i>
        <i class="fa fa-circle fa-stack-1x top medium"></i>
        <i class="fa fa-arrow-circle-up fa-stack-1x top"></i>
      </span>
            <span class="desc">Pulse aquí para añadir archivos</span>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <button type="reset" class="btn btn-default">Cancelar</button>
    </form>-->





    <form enctype="multipart/form-data" role="form" action='../index.php?controller=Documento&amp;action=upload' method='POST'>

        <div class="panel panel-default">

            <div class="panel-body">

                <div class="modal-body">

                    <div class="drag-drop">
                        <input type="file" id="documento" name="documento" />
                          <span class="fa-stack fa-2x">
                            <i class="fa fa-cloud fa-stack-2x bottom pulsating"></i>
                            <i class="fa fa-circle fa-stack-1x top medium"></i>
                            <i class="fa fa-arrow-circle-up fa-stack-1x top"></i>
                          </span>
                        <span class="desc">Pulse aquí para añadir archivos (Máx: <?=Documento::$MAX_FILESIZE_TEXT?>)</span>
                    </div>



                    <!-- <label class="control-label" for="doc">Selecciona Documento</label>
                     <input id="doc" type="file" name="docUsuario"/>
                     <p class="text-warning">(Máx: 16MB)</p>-->

                </div>

            </div> <!-- panel body -->

            <input type="hidden" name="MAX_FILE_SIZE" value="<?=Documento::$MAX_FILESIZE?>"/>
            <input type="hidden" name="tareaId" value="<?=$datosTarea->getIdTarea()?>" />
            <input type="hidden" name="usuarioId" value="<?=$datosUsuario->getIdUsuario()?>" />

            <div class="panel-footer">
                <button type="submit" class="btn btn-outline btn-primary" name="subirDocumento"><?=$idioma['Subir Documento']?></button>
                <button type="reset" class="btn btn-default" data-dismiss="modal"><?=$idioma['Cancelar']?></button>
                <!--<button type="button" class="close" data-dismiss="modal">×</button>-->
            </div>


        </div> <!-- Panel -->
    </form>


