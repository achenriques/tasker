<?php
/**
 * Created by NetBeans.
 * User: aouteiral
 * Date: 12/12/15
 * Time: 18:38
 */

include("v-panelheader.php");
include_once '../controlador/TareaController.php';

$controlador = new TareaController();
$tareas = $controlador->getTareasUsuario($datosUsuario->getIdUsuario());
$return = "mistareas";

include("v-listartareas.php");

?>
 
