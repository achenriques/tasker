
    <form enctype="multipart/form-data" role="form" action='../index.php?controller=Usuario&amp;action=insertaFoto' method='POST'>

        <div class="panel panel-default">

            <div class="panel-body">

                <div class="modal-body">

                    <div class="drag-drop">
                        <input type="file" id="imgUsuario" name="imgUsuario" />
                          <span class="fa-stack fa-2x">
                            <i class="fa fa-cloud fa-stack-2x bottom pulsating"></i>
                            <i class="fa fa-circle fa-stack-1x top medium"></i>
                            <i class="fa fa-arrow-circle-up fa-stack-1x top"></i>
                          </span>
                        <span class="desc">Cambiar Foto (Máx: 16MB)</span>
                    </div>



                </div>

            </div> <!-- panel body -->

            <input type="hidden" name="MAX_FILE_SIZE" value="16777216"/>
            <input type="hidden" name="username" value="<?=$datosUsuario->getUsername()?>"/>

            <div class="panel-footer">
                <button type="submit" class="btn btn-outline btn-primary" name="guardarImagen"><?=$idioma['Guardar Cambios']?></button>
                <button type="reset" class="btn btn-default" data-dismiss="modal"><?=$idioma['Cancelar']?></button>

            </div>


        </div> <!-- Panel -->
    </form>


