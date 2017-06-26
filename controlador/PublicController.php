<?php

/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 8/1/16
 * Time: 20:12
 *
 *
 *
 */

require_once(__DIR__ . "/../modelos/GrupoMapper.php");
require_once(__DIR__ . "/../clases/Grupo.php");
require_once(__DIR__ . "/../modelos/EstadoMapper.php");
require_once(__DIR__ . "/../modelos/TareaMapper.php");
require_once(__DIR__ . "/../clases/Tarea.php");
require_once(__DIR__ . "/../clases/Calendario.php");
require_once __DIR__.'/../tools.php';


class PublicController
{

    private $grupoMapper;


    public function __construct()
    {

        $this->grupoMapper = new GrupoMapper();
        $this->tareaMapper = new TareaMapper();
    }

    //Devuelve grupos públicos
    public function getAllPublic()
    {

        $datos = $this->grupoMapper->getAllPublic();
        return $datos;
    }

    //Devuelve las tareas de un grupo por el calendario indicado
    public function getTareasGrupo($idCalendario, $estado = 0) {


        return $this->tareaMapper->getTareasGrupo($idCalendario,$estado);

    }



}