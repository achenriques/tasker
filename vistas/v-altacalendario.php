<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 18:38
 */

include("v-panelheader.php");

?>


        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?=$idioma['Nuevo Calendario']?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

        <form role="form" name="addCalendario" action='../index.php?controller=Calendario&amp;action=add' method='POST'>

            <div class="panel panel-default">

                <div class="panel-body">

                    <div class="form-group">
                        <label for="nombreCalendario"><?=$idioma['Nombre para el Calendario']?></label>
                        <input type="text" id="nombreCalendario" name="nombreCalendario" class="form-control"
                               placeholder="<?=$idioma['Introduce un nombre para el calendario']?>" maxlength="45" pattern="^.{3,45}$" required>
                    </div>

                    <div class="form-group">
                        <label for="nombreCalendario"><?=$idioma['Color para el Calendario']?></label>

                    <div class="input-group demo2">

                     <input id="colorCalendario" name="colorCalendario" type="text" value="blue" class="form-control" />
                        <span class="input-group-addon"><i></i></span>
                    </div>
                    <script>
                             $(function(){
                             $('.demo2').colorpicker();
                     });
                    </script>


                    </div>

                    <input type="hidden" name="idUsuario" value="<?=$datosUsuario->getIdUsuario()?>"/>


                </div> <!-- panel body -->
                <div class="panel-footer">
                    <button type="submit" class="btn btn-outline btn-primary" name="crearCalendario"><?=$idioma['Crear Calendario']?></button>
                </div>

            </div> <!-- Panel -->
        </form> <!-- Form -->

    </div><!-- col -->


<script src="../js/validation.modificarcalendario.js"></script>


    </div>

<?php

include("v-panelfooter.php");

?>