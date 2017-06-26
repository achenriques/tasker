<?php
    include("v-panelheader.php");
    include_once '../controlador/CalendarioController.php';
    $controlador = new CalendarioController();
    $calendarios = $controlador->getCalendariosUsuario($datosUsuario->getIdUsuario());
    $return = "miscalendarios";
    include("v-listarcalendarios.php");