
    <div class="modal fade" id="<?=isset($confirm['id'])?$confirm['id']:'confirm-delete'?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?=isset($confirm['title'])?$confirm['title']:'Confirmar Acción'?></h4>
                </div>
            
                <div class="modal-body">
                    <p><?=isset($confirm['text'])?$confirm['text']:'¿Está seguro de querer eliminar los datos?'?></p>
                    <!--<p class="debug-url"></p>-->
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?=isset($confirm['bCancel'])?$confirm['bCancel']:'Cancelar'?></button>
                    <a class="btn btn-<?=isset($confirm['bOkType'])?$confirm['bOkType']:'danger'?> btn-ok"><?=isset($confirm['bOk'])?$confirm['bOk']:'Eliminar'?></a>
                </div>
            </div>
        </div>
    </div>

    <!--<a href="#" data-href="/delete.php?id=23" data-toggle="modal" data-target="#confirm-delete">Delete record #23</a><br>
    
    <button class="btn btn-default" data-href="/delete.php?id=54" data-toggle="modal" data-target="#confirm-delete">
        Delete record #54
    </button>-->
    
    <script>
        $('#<?=isset($confirm['id'])?$confirm['id']:'confirm-delete'?>').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            //$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>