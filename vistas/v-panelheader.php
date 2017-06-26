<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 14:00
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../funciones/comunes.php';
include_once '../controlador/UsuarioController.php';
include_once '../lib/FlashMessages.php';
include_once '../controlador/GrupoController.php';
include_once '../controlador/CalendarioController.php';

//Isto e para poder retornar tralas accions
if (!session_id()) @session_start();
$_SESSION['url2return'] = $_SERVER['REQUEST_URI'];

//if (!session_id()) @session_start();

//Forzar a cargar un usuario
if(!isset($_SESSION['idUsuario']))
    header("location: /".basedir()."/");

/* Cargamos aqui los datos del usuario logueado para usarlo en cualquier lugar */

$controlador = new UsuarioController();
$datosUsuario = $controlador->getDatosUsuario($_SESSION['idUsuario']);
$idioma = CargaIdioma($datosUsuario->getIdioma());

//$controladorNotif = new NotificacionController();
//$notifs = $controladorNotif->getAllNotificaciones();

$controladorGrup = new GrupoController();
$groupsUsr = $controladorGrup->getGroupOfUser($datosUsuario->getIdUsuario());

$controladorCal = new CalendarioController();
$calendarios = $controladorCal->getCalendarios($datosUsuario->getIdUsuario());


$tareaPadreId = isset($_GET['tareaPadreId']) ? $_GET['tareaPadreId'] : '';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tasker - Panel de Usuario</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    
    <!-- jQuery Datepicker JavaScript -->
    <link rel="stylesheet" type="text/css" href="../css/datepicker.css">
    
    <!-- jQuery DataTables JavaScript -->
    <link rel="stylesheet" type="text/css" href="../css/datatables.min.css">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Tasker CSS -->
    <link href="../css/tasker.css" rel="stylesheet">

    <!-- Responsive Calendar -->

    <link href="../css/responsive-calendar.css" rel="stylesheet">

    <!-- color picker CSS -->
    <link href="../css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>
    <!--<script src="../js/jquery-ui.js"></script>-->
    <script src="../js/jquery.autocomplete.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Bootstrap Datetimepicker JavaScript -->
    <script src="../js/moment-with-locales.min.js"></script>
    <script src="../js/bootstrap-datepicker.min.js"></script>
    <script src="../js/bootstrap-datepicker.es.js" charset="UTF-8"></script>
    
    <!-- jQuery Validation JavaScript -->
    <script src="../js/jquery.validate.min.js"></script>
    <script src="../js/messages_es.js"></script>
    <script src="../js/validate-rules.js"></script>

    <!-- Calendar -->

    <script src="../js/responsive-calendar.js"></script>

    <!-- jQuery view-pdf JavaScript -->
    <!--<script src="../js/view-pdf.js"></script>-->
    
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top header" role="navigation" style="margin-bottom: 0; box-shadow: 1px 5px 15px grey;border-bottom: 1px solid black">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="color:white;text-shadow: 1px 0px 10px black;" href="">tasker</a>

        </div>
        <!-- /.navbar-header -->

        <?php
            include_once '../controlador/NotificacionController.php';
            $controladorNotif = new NotificacionController();
            $notifs = $controladorNotif->getNotificacionesUsuario($datosUsuario->getIdUsuario());
        ?>

        <ul class="nav navbar-top-links navbar-right hidden-xs">
            <?php if(sizeof($notifs)>0) { ?>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" style="color:white" data-toggle="dropdown" href="#"><i class="notif"><?=sizeof($notifs)?></i>
                    <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <?php
                        foreach ($notifs as $notif) {
                    ?>
                    <li>
                        <a href="../vistas/v-notificaciones.php#panel-<?=$notif->getId()?>">
                            <div>
                                <i class="fa fa-<?=$notif->getCss()?> fa-fw"></i> <?=$notif->getTextoAbreviado()?>
                                <span class="pull-right text-muted small"><?=$notif->getTimeAgo()?></span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <?php
                        }
                    ?>
                                <!--<i class="fa fa-twitter fa-fw"></i> 3 New Followers          
                                <i class="fa fa-comment fa-fw"></i>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted-->                      
                    <li>
                        <a class="text-center" href="v-notificaciones.php">
                            <strong><?=$idioma['Ver todas']?> </strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                <!-- /.dropdown-alerts -->
            </li>
            <?php } ?>
            
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" style="color:white" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?=$datosUsuario->getUsername()?> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="v-perfil.php"><i class="fa fa-user fa-fw"></i> <?=$idioma['Mi Perfil']?></a>
                    </li>

                    <li class="divider"></li>
                    <li><a href="../index.php?controller=Login&amp;action=logout"><i class="fa fa-sign-out fa-fw"></i><?=$idioma['Salir']?></a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <?php

        if ($controlador->esSuperAdmin($datosUsuario)) {

        //Es Admin
        include("inc-menuadmin.php");

        }
        else {

        include("inc-menu.php");

        }

        ?>

        <div id="page-wrapper">

            <?php

            include("v-panelmessages.php");

            ?>

