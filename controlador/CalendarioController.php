<?php

/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 12/12/15
 * Time: 13:05
 */

require_once(__DIR__ . "/../modelos/CalendarioMapper.php");
require_once(__DIR__ . "/../clases/Calendario.php");
require_once(__DIR__ . "/../funciones/basedir.php");

class CalendarioController
{

    private $calendarioMapper;

    public function __construct()
    {

        $this->calendarioMapper = new CalendarioMapper();

    }

    public function add() {

        $nombreCalendario = $_POST['nombreCalendario'];
        $colorCalendario = $_POST['colorCalendario'];
        $idUsuario = $_POST['idUsuario'];

        $calendario = new Calendario(null,$nombreCalendario,$colorCalendario);

        $idCalendario = $this->calendarioMapper->add($calendario);

        $base_dir = basedir();

        if (!$idCalendario) {

            header("location: /$base_dir/vistas/v-altacalendario.php?msg=errAltaCal&tipo=danger");


        }
        else {

            //exito: asignamos el calendario al usuario

            $calendario->setIdCalendario($idCalendario);
            $res = $this->calendarioMapper->asignaCalendario($calendario,$idUsuario);

            if (!$res) {

                header("location: /$base_dir/vistas/v-miscalendarios.php?msg=errAltaCal&tipo=danger");

            }

            else {

                header("location: /$base_dir/vistas/v-miscalendarios.php?msg=okAltaCal&tipo=success");


            }

        }




    }

    public function getCalendariosUsuario($idUsuario){
        return $this->calendarioMapper->getCalendarios($idUsuario);
    }

    public function update(){

        $nombreCalendario = $_POST['nombreCalendario'];
        $colorCalendario = $_POST['colorCalendario'];
        $idCalendario = $_POST['idCalendario'];




        $calendario = new Calendario(null,$nombreCalendario,$colorCalendario);
        $calendario->setIdCalendario($idCalendario);

        $res = $this->calendarioMapper->update($calendario);

        $base_dir = basedir();

        if (!$res) {

            header("location: /$base_dir/vistas/v-modificarcalendario.php?id=$idCalendario&msg=errorUpdate&tipo=danger");


        }
        else {

            header("location: /$base_dir/vistas/v-modificarcalendario.php?id=$idCalendario&msg=okUpdate&tipo=success");

        }

    }

    public function getCalendarios($idUsuario){


        return $this->calendarioMapper->getCalendarios($idUsuario);

    }

    public function getDatosCalendario($id){

        $datos = $this->calendarioMapper->getDatosCalendario($id);
        return $datos;

    }

    public function delete() {


        $idCalendario = $_GET['id'];
        $res = $this->calendarioMapper->delete($idCalendario);

        $base_dir = basedir();

        switch ($res) {

            case '0': /* Exito*/

                header("location: /$base_dir/vistas/v-miscalendarios.php?msg=okDelete&tipo=success");
                break;
            case '1': /*Tiene Tareas*/
                header("location: /$base_dir/vistas/v-miscalendarios.php?msg=errorDeleteTieneTareas&tipo=danger");
                break;
            case '2': /* Error en el proceso de borrado */
                header("location: /$base_dir/vistas/v-miscalendarios.php?msg=errorDelete&tipo=danger");
                break;


        }


    }

    public function getNumTareas($idCalendario) {

        return $this->calendarioMapper->getNumTareas($idCalendario);

    }


    //Comprueba si un calendario es de un grupo
    public function calIsFromGroup($idCalendario) {

        return $this->calendarioMapper->calIsFromGroup($idCalendario);



    }

    public function getGroupByCal($idCalendario) {

        return $this->calendarioMapper->getGroupByCal($idCalendario);


    }


}