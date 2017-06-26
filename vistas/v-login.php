<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 11:53
 */


include_once '../funciones/comunes.php';
include_once '../controlador/PublicController.php';
include_once '../lib/FlashMessages.php';

//Isto e para poder retornar tralas accions
if (!session_id()) @session_start();
$_SESSION['url2return'] = $_SERVER['REQUEST_URI'];

$controller = new PublicController();

if (isset($_GET['idioma'])) {
    $idioma = CargaIdioma($_GET['idioma']);
} else {
    $idioma = CargaIdioma("es");
}


$gruposPublicos = $controller->getAllPublic();



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tasker - Gestor de Tareas</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->

    <link href="../css/sb-admin-2.css" rel="stylesheet">

    <!-- Tasker CSS -->

    <link href="../css/tasker.css" rel="stylesheet">

    <!-- Stylish Portfolio CSS -->

    <link href="../css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>



    <!-- Header -->
    <header id="top" class="header">



        <div class="text-vertical-center">


            <h1 class="logo">tasker</h1>
            <br>
            <!-- <a href="#about" class="btn btn-dark btn-lg">Find Out More</a> -->
            <div class="container">




            <div class="row row-centered">

                <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 col-centered">

                    <?php
                    //$msg = new \Plasticbrain\FlashMessages\FlashMessages();
                    //$msg->error($idioma['passDistintas2']);
                    include("v-panelmessages.php");

                    ?>

                    <form role="form" name="login" action='../index.php?controller=Login&amp;action=login' method='POST' onsubmit='return calculaMD5()'>
            <!--  Panel 2 -->


                    <div class="panel panel-default">

                        <div class="panel-heading">

                            <?php $idiomas=['en','es'];

                            foreach ($idiomas as $key) {

                            ?>


                                <span class="pull-right"><a href="v-login.php?idioma=<?=$key?>"><img src="../img/<?=$key?>.png"></a></span>


                            <?php } ?>

                        </div>

                <div class="panel-body">
                    <div class="form-group">
                        <label for="nick"><?=$idioma['Usuario']?></label>
                        <input type="text" id="nick" name="nick" class="form-control"
                               placeholder="<?=$idioma['Introduce usuario']?>" maxlength="15" pattern="^.{3,15}$" required>
                    </div>
                    <div class="form-group">
                        <label for="password"><?=$idioma['Contrasena']?></label>
                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="<?=$idioma['Introduce contrasena']?>" required>
                    </div>

                    <?php

                    if (isset($_GET['msg']) && isset($_GET['tipo'])) {

                        $mensaje = $_GET['msg'];
                        Mensaje($idioma[$mensaje],$_GET['tipo']);

                    }

                    ;?>

                    <hr>
                    <div class="text-center"><a onclick="muestraRegistro()" data-toggle="modal"><?=$idioma['Haz clic aqui si no tienes cuenta']?></a></div>
                </div>

                <div class="panel-footer text-center" style="background-color: white">

                    <button type="submit" class="btn btn-outline btn-primary" name="submit"><?=$idioma['Acceder']?></button>


                </div>
            </div>
                    </form>
                    </div>


                </div>
            </div>


            <a href="#tareasPublicas" class="btn btn-dark btn-lg"><?=$idioma['Tareas Publicas']?></a>

        </div>


    <script src="../js/validation.login.js"></script>


    </header>



    <?php include('inc-modal-registrarusuario.php'); ?>


    <?php include('inc-tareaspublicas.php'); ?>





    <!-- jQuery -->

    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>


    <!-- Tasker -->

    <script src="../js/tasker.js"></script>
    <script src="../js/md5.js"></script>

    <?php /*if (isset($_GET['msg']) && isset($_GET['tipo']) && $_GET['msg'] = 'passDistintas2') {


        echo '<script>';
        echo '$(document).ready(function(){';
        echo '$("#modalRegistrarse").modal("show");';
        echo '});';
        echo '</script>';

    }*/

    ?>

    <script>


        function muestraRegistro() {

            $("#modalRegistrarse").modal("show");
            document.getElementById('grupo').style.display = "none";
            document.getElementById('grupoSel').value = null;



        }


    </script>





    <script>



    // Scrolls to the selected menu item on the page
    $(function() {
    $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
    if (target.length) {
    $('html,body').animate({
    scrollTop: target.offset().top
    }, 1000);
    return false;
    }
    }
    });
    });
    </script>

</body>

</html>

