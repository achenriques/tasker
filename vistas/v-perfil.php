<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 18:38
 */

include("v-panelheader.php");



?>


    <!-- Manejo de mensajes -->




    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=$idioma['Mi Perfil']?></h1>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5 text-center">
            <div class="panel panel-default" style="border:none">
                <div class="panel-body">

                    <a data-toggle="modal" data-target="#mImgUsu" disabled>

                        <img class="img-responsive"
                             style="border:5px solid white;border-radius: 300px;box-shadow: 0px 1px 5px grey;"
                             src="../lib/img.php?id=<?=$datosUsuario->getUsername();?>"
                             alt="Foto">

                    </a>

                </div>
            </div>

            <p class="text-muted hidden-xs hidden-sm"><?=$idioma['Haz click en la imagen para cambiarla']?></p>

        </div>



        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">

            <form role="form" action='../index.php?controller=Usuario&amp;action=update' method='POST'
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
                                   placeholder="<?= $idioma['Introduce tu nombre y apellidos'] ?>" value="<?=$datosUsuario->getNombre()?>" required>
                        </div>
                        <input type="hidden" name="username" value="<?=$datosUsuario->getUsername()?>"/>
                        <label for="email">E-Mail</label>

                        <div class="form-group input-group">
                            <span class="input-group-addon">@</span>
                            <input type="email" class="form-control"
                                   placeholder="<?= $idioma['Ejemplo: correo@gmail.com'] ?>" value="<?=$datosUsuario->getEmail()?>" name="email" maxlength="30"
                                   id="email" required>
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

                        <input type="hidden" name="idUsuario" value="<?=$datosUsuario->getIdUsuario()?>"/>
                        <input type="hidden" name="admin" value="<?=$datosUsuario->getAdmin()?>"/>


                    </div> <!-- body panel -->

                    <div class="panel-footer" style="background-color: white">

                        <button type="submit" class="btn btn-outline btn-primary" name="modificar"><?=$idioma['Guardar Cambios']?></button>


                    </div>
                </div>

            </form>
        </div>


        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

            <form role="form" name='modificarPass' action='../index.php?controller=Usuario&amp;action=updatePass' method='POST' onsubmit='return encriptaPass()'>



                <div class="panel panel-default">

                    <div class="panel-heading">
                        <i class="fa fa-"></i><?=$idioma['Cambiar contrasena']?>
                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label for="passwordU"><?=$idioma['Nueva contrasena']?></label>
                            <input type="password" id="passwordU" name="passwordU" class="form-control"
                                   placeholder="<?=$idioma['Introduce tu contrasena']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="passwordConf"><?=$idioma['Confirma tu contrasena']?></label>
                            <input type="password" id="passwordConf" name="passwordConf" class="form-control"
                                   placeholder="<?=$idioma['Confirma tu contrasena']?>" required>
                        </div>
                        <input type="hidden" name="idUsuario" value="<?=$datosUsuario->getIdUsuario()?>"/>

                    </div>
                        <div class="panel-footer" style="background-color: white">

                        <button type="submit" class="btn btn-outline btn-primary" name="cambiarPass"><?=$idioma['Guardar Cambios']?></button>

                    </div>
                </div>
            </form>


        </div>


    </div> <!-- row -->


</div>

<div class="modal fade" id="mImgUsu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?=$idioma['Imagen de Usuario']?></h4>
            </div>

            <?php include('inc-subirimagen.php')?>
            <!--<form enctype="multipart/form-data" role="form" action='../index.php?controller=Usuario&amp;action=insertaFoto' method='POST'>

                <div class="modal-body">

                    <label class="control-label" for="imgUsuario">Cambiar Foto</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="16777216"/>
                    <input type="hidden" name="username" value="<?=$datosUsuario->getUsername()?>"/>
                    <input type="file" name="imgUsuario"/>

                    <p class="text-warning">(Máx: 16MB)</p>


                </div>


                <div class="modal-footer">

                    <button type="submit" class="btn btn-outline btn-primary" name="guardarImagen">Guardar</button>
                    <button type="button" class="btn btn-outline btn-default" data-dismiss="modal">Cerrar</button>

                </div>

            </form>-->
        </div>

    </div>
</div>

<?php

include("v-panelfooter.php");

?>
