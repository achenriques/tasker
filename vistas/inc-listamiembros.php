
<div class="panel panel-default">

                <div class="panel-heading">
                      <i class="fa fa-"></i><?=$idioma['Miembros del Grupo']?>
                 </div>


                <div class="panel-body">

                    <table class="table table-striped">

                        <tbody>
                        <?php if (sizeof($usuarios)) foreach ($usuarios as $usuario){ ?>
                            <tr>


                                <td><a data-toggle="modal" data-target="#verImagen-<?=$usuario->getIdUsuario()?>" disabled><img class="img-responsive"
                                                                                                                                style="max-width:25px; border-radius: 300px;"
                                                                                                                                src="../lib/img.php?id=<?=$usuario->getUsername()?>"
                                                                                                                                alt="Foto"></a></td>
                                <td><?=$usuario->getNombre()?><?php if ($controladorGrupo->esAdminGrupo($usuario->getIdUsuario(),$datosGrupo->getIdGrupo())) { echo ' (A)';}?></td>

                                <td>
                                    <?php if ($soyAdmin || $soySuperAdmin) { ?>
                                    <span class="pull-right"><a href="#" data-href="../index.php?controller=Grupo&amp;action=dropMiembro&amp;idGrupo=<?=$datosGrupo->getIdGrupo()?>&amp;idUsuario=<?=$usuario->getIdUsuario()?>" data-toggle="modal" data-target="#confirm-drop" title="Quitar Miembro"><i class="fa fa-remove fa-fw" style="color:orange;"></i></a></span>
                                    <?php } ?>
                                    <span class="pull-right"><a href="../vistas/v-altanotificacion.php?destinatario=<?=$usuario->getIdUsuario()?>&return=listarusuarios" title="Enviar Notificación"><i class="fa fa-send fa-fw"></i></a></span>
                                    <span class="pull-right"><a data-toggle="modal" data-target="#verUsuario-<?=$usuario->getIdUsuario()?>" title="Ver Datos"><i class="fa fa-eye fa-fw"></i></a></span>
                                </td>


                            </tr>

                            <div id="verImagen-<?=$usuario->getIdUsuario()?>" class="modal fade" role="dialog">

                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">

                                            <div align="center">
                                                <img class="img-responsive"
                                                     style="border-radius: 15px;"
                                                     src="../lib/img.php?id=<?=$usuario->getUsername()?>"
                                                     alt="Foto">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div id="verUsuario-<?=$usuario->getIdUsuario()?>" class="modal fade" role="dialog">

                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><?=$usuario->getNombre()?><?php if ($controladorGrupo->esAdminGrupo($usuario->getIdUsuario(),$datosGrupo->getIdGrupo())) { echo ' ('.$idioma['Administrador'].')';}?></h4>

                                        </div>
                                        <div class="modal-body">

                                            <div class="row">

                                                <div class="col-lg-4">

                                                <img class="img-responsive"
                                                     style="border-radius: 15px;"
                                                     src="../lib/img.php?id=<?=$usuario->getUsername()?>"
                                                     alt="Foto">


                                             </div>



                                            <div class="col-lg-8">
                                                <div class="panel panel-default">

                                                <div class="panel-body" >

                                                    <div class="form-group">
                                                        <label class="control-label" for="nick"><?=$idioma['Nick']?></label>
                                                        <input type="text" id="nick" name="nick" class="form-control" value="<?=$usuario->getUsername()?>" disabled />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="email"><?=$idioma['E-Mail']?></label>
                                                        <input type="text" id="email" name="email" class="form-control" value="<?=$usuario->getEmail()?>" disabled />
                                                    </div>

                                                    </div>

                                                </div>
                                            </div>

                                                </div>
                                        </div>


                                        </div>
                                    </div>

                                </div>

                            </div>






                        <?php } ?>

                        <?php
                        $confirm = [
                            //'title' => 'Confirmar Acción',
                            'id' => 'confirm-drop',
                            'text'  => '¿Está seguro de querer eliminar el miembro del grupo?',
                            'bOk' => 'Eliminar miembro'
                        ];
                        include('inc-confirm.php');
                        //include('inc-pluginTableData.php');
                        ?>
                        </tbody>
                    </table>

                    <?php if ($soyAdmin || $soySuperAdmin) { ?>
                    <a data-toggle="modal" data-target="#altaMiembro" class="btn btn-outline btn-primary"><?=$idioma['Anadir Miembro']?></a>
                    <?php } ?>


                </div> <!-- panel-body -->
</div> <!-- panel-default -->


<div id="altaMiembro" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?=$idioma['Selecciona Usuarios']?></h4>
            </div>
            <div class="modal-body">

                <form id="addMiembro" name="addMiembro" role="form" action="../index.php?controller=Grupo&amp;action=addMiembros<?=isset($_GET['return'])?'&return='.$_GET['return']:''?>" method='POST'>


                <?php include('inc-altamiembro.php'); ?>


                    </form>

                </div>
            </div>
        </div>

    </div>

</div>