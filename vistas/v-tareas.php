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
$tareas = $controlador->getAllTareas();
$return = "tareas";

/* TODO  que muestre el usuario de la tarea, viendo a que calendario pertenece y de quien es  ese calendario
Si el calendario es de un grupo, deberia poner el nombre del grupo en lugar de los nombres de los usuarios */

include("v-listartareas.php");

?>