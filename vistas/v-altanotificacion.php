<?php

/**
 * Created by NetBeans.
 * User: aouteiral
 * Date: 19/12/15
 * Time: 16:52
 */

include("v-panelheader.php");
include_once '../clases/Notificacion.php';
include_once '../controlador/NotificacionController.php';
include_once '../modelos/UsuarioMapper.php';

$controladorNotif = new NotificacionController();
$notifs = $controladorNotif->getNotificacionesUsuario($datosUsuario->getIdUsuario());

if (isset($_GET['destinatario'])) {
    $destId = $_GET['destinatario'];
    $destinatario = $controlador->getDatosUsuario($destId);
}

?>


    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=$idioma['Alta de Notificación']?></h1>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?php
            //$disabled = false;
            //$tipo = "StandAlone";
            //include('inc-altanotificacion.php');
        ?>
        <form role="form" name="addNotificacion" action="../index.php?controller=Notificacion&amp;action=add<?=isset($_GET['return'])?'&return='.$_GET['return']:''?>" method='POST'>
            <div class="form-group">
                <label class="control-label" for="textoNotif"><?=$idioma['Texto de la notificación']?></label>
                <input type="text" id="textoNotif" name="textoNotif" class="form-control"
                       placeholder="<?=$idioma['Introduce el texto de la notificación']?>" pattern="^.{3,45}$" maxlength="140" required>
            </div>
            
            <div class="form-group">
                    <label class="control-label" for="tipoNotif"><?=$idioma['Tipo de notificación']?></label>
                    <select id="tipoNotif" name="tipoNotif" class="form-control"  >
                        <?php foreach(Notificacion::$TIPOS_HUMAN as $key=>$val){ ?>
                        <option value="<?=$key?>" ><?=$val?></option>    
                        <?php } ?>
                    </select>
            </div>           
            
            <div class="form-group">
                <label class="control-label" for="destinatarioNombre"><?=$idioma['Destinatario de la notificación']?></label>
                <input type="text" id="destinatarioNombre" name="destinatarioNombre" class="form-control" value="<?=isset($destinatario)?$destinatario->getNombre():''?>"
                       placeholder="<?=$idioma['Introduce el ID del destinatario']?>" required <?=isset($destinatario)?'disabled':''?>/>
            </div>
          
            <input type="hidden" id="destinatario" name="destinatario" value="<?=isset($destinatario)?$destinatario->getIdUsuario():''?>" required />
            <input type="hidden" id="remitente" name="remitente" value="<?=$datosUsuario->getIdUsuario()?>" required />

            <div class="modal-footer">
                <!--<button type="submit" class="btn btn-outline" name="cancel"><?=$idioma['Cancelar']?></button>-->
                <button type="submit" class="btn btn-outline btn-primary" name="crearNotif"><?=$idioma['Crear Notificación']?></button>
            </div>
            
        </form> 
        
        
    </div><!-- col -->


</div><!-- wrapper -->


<script type="text/javascript">  
$('#destinatarioNombre').autocomplete({
    serviceUrl: '../index.php?controller=Usuario&action=consult&maxResults=5',
    paramName: 'query',
    minChars: 1,
    lookupLimit: 5,
    onSelect: function (suggestion) {
        $("#destinatario").val( suggestion.data );
    }
});
</script>
<script src="../js/validation.notificacion.js"></script>

<?php

include("v-panelfooter.php");

?>
