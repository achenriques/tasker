<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 18:38
 */

include("v-panelheader.php");


$usu = $datosUsuario;

$datosUsuario = $controlador->getDatosUsuario($_GET['id']);


?>


    <!-- Manejo de mensajes -->




    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Usuario</h1>
        </div>
    </div>
    <div class="row">





        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">

            <form role="form" name='modificarUsuario' action='../index.php?controller=Usuario&amp;action=update&amp;return=<?=$_GET['return']?>' method='POST'
                  onsubmit='return calculaMD5()'>
                <!--  Panel 2 -->


                <div class="panel panel-default">

                    <div class="panel-heading">
                        <i class="fa fa-"></i><?=$idioma['Datos Personales']?>
                    </div>

                    <div class="panel-body">


                        <div class="form-group">
                            <label for="nombre"><?= $idioma['Nick'] ?></label>
                            <input type="text" id="nick" name="nick" class="form-control"
                                   placeholder="<?= $idioma['Introduce tu nick'] ?>" disabled value="<?=$datosUsuario->getUsername()?>">
                        </div>
                        <div class="form-group">
                            <label for="apellidos"><?= $idioma['Nombre Completo'] ?></label>
                            <input type="text" id="nombre" name="nombre" class="form-control"
                                   placeholder="<?= $idioma['Introduce tu nombre y apellidos'] ?>" value="<?=$datosUsuario->getNombre()?>" maxlength="30" pattern="^.{3,30}$" required>
                        </div>
                        <input type="hidden" name="username" value="<?=$datosUsuario->getUsername()?>"/>
                        <label for="email">E-Mail</label>

                        <div class="form-group input-group">
                            <span class="input-group-addon">@</span>
                            <input type="email" class="form-control"
                                   placeholder="<?= $idioma['Ejemplo: correo@gmail.com'] ?>" value="<?=$datosUsuario->getEmail()?>" name="email" maxlength="45"
                                   id="email" pattern="^\S+@\S+$" required>
                        </div>

                        <div class="form-group input-group">
                            <label class="control-label" for="idioma"><?=$idioma['Idioma por defecto']?></label>
                            <select class="form-control" id="idioma" name="idioma">


                                <?php

                                /* Comprobamos cual de las opciones debe estar seleccionada*/

                                $selEs=$selEn=null;
                                switch($datosUsuario->getIdioma()) {

                                    case 'en':
                                        $selEn = "selected";
                                        break;
                                    case 'es':
                                        $selEs = "selected";
                                        break;
                                }

                                ?>

                                <option value="es" <?=$selEs?>><?=$idioma['Espanol']?></option>
                                <option value="en" <?=$selEn?>><?=$idioma['English']?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="admin"><?=$idioma['Administrador']?></label>
                            <input type="checkbox" id="admin" name="admin" value="1" <?=$datosUsuario->getAdmin()?'checked':''?> >
                        </div>

                        <input type="hidden" name="idUsuario" value="<?=$datosUsuario->getIdUsuario()?>"/>


                    </div> <!-- body panel -->

                    <div class="panel-footer" style="background-color: white">

                        <button type="submit" class="btn btn-outline btn-primary" name="modificar"><?=$idioma['Guardar Cambios']?></button>


                    </div>
                </div>

            </form>
        </div>
        <script src="../js/validation.modificarusuario.js"></script>

<?php

$datosUsuario = $usu;


include("v-panelfooter.php");

?>
