

<div id="modalRegistrarse" class="modal fade" role="dialog">


        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?=$idioma['Crear cuenta']?></h4>
</div>
<div class="modal-body">
    <form role="form" name="registrarse" action='../index.php?controller=Usuario&amp;action=add' method='POST' onsubmit='return encriptaPass()'>

        <div class="form-group" id="grupo" style="display:none">
            <label for="grupoSel"><?=$idioma['Acceso a:']?></label>
            <input type="text" id="grupoSel" name="grupoSel" class="form-control" disabled>
            <input type="hidden" id="grupoSelCod" name="grupoSelCod" class="form-control" value="">
        </div>

        <div class="form-group">
            <label for="nick"><?=$idioma['Nick']?></label>
            <input type="text" id="nick" name="nick" class="form-control"
                   placeholder="<?=$idioma['Introduce nick']?>" maxlength="15" pattern="^.{3,15}$" required>
        </div>
        <div class="form-group">
            <label for="nombre"><?=$idioma['Nombre Completo']?></label>
            <input type="text" id="nombre" name="nombre" class="form-control"
                   placeholder="<?=$idioma['Introduce nombre y apellidos']?>" maxlength="30" pattern="^.{3,30}$" required>
        </div>
        <label for="email"><?=$idioma['E-Mail']?></label>

        <div class="form-group input-group">
            <span class="input-group-addon">@</span>
            <input type="email" class="form-control" name="email" placeholder="<?=$idioma['Ejemplo: correo@gmail.com']?>" maxlength="30"
                   id="email" pattern="^\S+@\S+$" required>



        </div>

        <?php if (isset($_GET['idioma'])) {  ?>

            <input type="hidden" name="idioma" value="<?=$_GET['idioma']?>"

        <?php }  else  { ?>

        <input type="hidden" name="idioma" value="es"/>

        <?php } ?>

        <?php if (isset($datosUsuario)) {

          if ($datosUsuario->getAdmin()) { ?>

              <div class="form-group">
                  <label for="admin"><?=$idioma['Administrador']?></label>
                  <input type="checkbox" id="admin" name="admin" value="1">
              </div>

        <?php
          }

        }

        ?>

        <hr>
        <div class="form-group">
            <label for="passwordU"><?=$idioma['Contrasena']?></label>
            <input type="password" id="passwordU" name="passwordU" class="form-control"
                   placeholder="<?=$idioma['Introduce contrasena']?>" required>
        </div>
        <div class="form-group">
            <label for="passwordConf"><?=$idioma['Confirma contrasena']?></label>
            <input type="password" id="passwordConf" name="passwordConf" class="form-control"
                   placeholder="<?=$idioma['Confirma contrasena']?>" required>
        </div>



        <div class="modal-footer">

            <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12 col-centered">

                <!-- // Para mensajes de error -->

            </div>

            <button type="submit" class="btn btn-outline btn-primary" name="registro"><?=$idioma['Crear cuenta']?></button>
            <button type="button" class="btn btn-outline btn-default" data-dismiss="modal"><?=$idioma['Cerrar']?></button>
        </div>

    </form> <!-- Form -->
    <script src="../js/validation.altausuario.js"></script>

</div>
</div>

</div>
</div>


