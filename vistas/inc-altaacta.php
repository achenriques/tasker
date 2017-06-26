
<div class="drag-drop">
    <input type="file" id="docAcat" name="docActa" />
                          <span class="fa-stack fa-2x">
                            <i class="fa fa-cloud fa-stack-2x bottom pulsating"></i>
                            <i class="fa fa-circle fa-stack-1x top medium"></i>
                            <i class="fa fa-arrow-circle-up fa-stack-1x top"></i>
                          </span>
    <span class="desc"><?=$idioma['Pulse aqui para anadir archivos']?> (Máx: <?=Reunion::$MAX_FILESIZE_TEXT?>)</span>
</div>


<button type="submit" class="btn btn-outline btn-primary" name="crearReunion"><?=$idioma['Subir Documento']?></button>