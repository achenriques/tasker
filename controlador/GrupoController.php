<?php

/**
 * Created by IntelliJ IDEA.
 * User: crmiguez
 * Date: 15/12/15
 * Time: 22:30
 */

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../modelos/GrupoMapper.php");
require_once(__DIR__ . "/../clases/Grupo.php");
require_once(__DIR__ . "/../clases/Calendario.php");
require_once(__DIR__ . "/../modelos/CalendarioMapper.php");
require_once(__DIR__. "/../funciones/basedir.php");

/* Ao extender Controller temos unha serie de propiedades da clase como
 * $this->base_dir
 * $this->id
 * $this->idioma
 * $this-msg (Envia mensaxes a traves da sesion. Podemos envialo en calquera momomento e máis de unha.)
 */
class GrupoController extends Controller
{

    private $grupoMapper;


    public function __construct()
    {
        /* Iniciamos as propiedades antes referidas */
        parent::__construct();
        $this->grupoMapper = new GrupoMapper();
    }

    public function add()

    {

        $nombreG = $_POST['nombreGrupo'];
        $descripcion = $_POST['descripcionGrupo'];
        $visibilidad = $_POST['visibilidad'];
        //Incorpora id no __construct da clase grupo
        $grupo = new Grupo(null, $nombreG, $descripcion, $visibilidad, null);
        $idUsuario = $_POST['idUsuario'];

        //Validamos el grupo indicado
        $ok_grupo = $this->grupoMapper->checkValidGrupo($grupo);

        //Comprueba si existe el grupo
        if (!$ok_grupo) {
            //Mensaxe de erro. Meter a clave no diccionario
            //$this->msg->error($this->idioma['errorExistsGrupo']);
            $this->msg->error('El grupo ya existe');
        } else {

            //Creamos un Calendario para el Grupo.

            $calendarioMapper = new CalendarioMapper();
            $calendario = new Calendario(null,"G-".$nombreG,"#00000");

            $idCalendarioCreado = $calendarioMapper->add($calendario);

            if (!$idCalendarioCreado) {

                //Error al crear calendario
                $this->msg->error($this->idioma['errorAltaGrupoCalendario']);

            }

            else {

                //Creacion de Calendario correcta.
                $grupo->setCalendario($idCalendarioCreado);
                $idGrupo_creado = $this->grupoMapper->add($grupo);
                if (!$idGrupo_creado) {
                    //Error en la insercion.
                    $this->msg->error($this->idioma['errorAltaGrupo']);
                } else {
                    //Todo  fue bien.
                    //tenemos que añadir el usuario actual al grupo que acaba de crear y ponerlo como Administrador del mismo.
                    //$res=$this->grupoMapper->asignaUsuario($idGrupo_creado,$idUsuario,1);
                    $res = $this->grupoMapper->addMiembros($idGrupo_creado,$idCalendarioCreado,$idUsuario,1);


                    if (!$res) {
                        //Error al asignar grupo.
                        $this->msg->error($this->idioma['errorAltaGrupo']);
                        header("location: /$this->base_dir/vistas/v-altagrupo.php?idGrupo=$idGrupo_creado");
                    } else {
                        //Mensaxe de OK.
                        $this->msg->success($this->idioma['okAltaGrupo']);
                        header("location: /$this->base_dir/vistas/v-panelgrupo.php?idGrupo=$idGrupo_creado");
                    }

                }



            }


        }
        //So hai que facer unha devolucion.
        //Non debería devolvelo a v-consultagrupo.php?????
        //header("location: /$this->base_dir/vistas/v-altagrupo.php");
        //Alternativa con retorno solicitado
        header("location: /$this->base_dir/vistas/$this->return");
        //Se queremos que retorne o aoutro sitio podemos enviar unha variable por $_GET
        //Se na chamada a add, pasamos result=grupo, o retorno faise a v-grupo.php e non a v-altagrupo.php
    }


    // Funcion obtener todos los grupos
    public function getAllGrupos()
    {

        $datos = $this->grupoMapper->getAll();
        return $datos;
    }

    //Devuelve los grupos de los cuales el usuario indicado es admin
    public function getAllMyGrupos($idUsuario) {

        return $this->grupoMapper->getAllMyGrupos($idUsuario);

    }

    //Devuelve un objeto con los datos del grupo referenciado por idGrupo.
    public function getDatosGrupo($idGrupo){

        $datos = $this->grupoMapper->getDatosGrupo($idGrupo);
        return $datos;

    }

    public function update() {

        //Comprobar se esta autorizado a modificar
        if (!$this->isAllowed()) {
            $this->msg->error($this->idioma['errorNotAllowed']);
            header("location: /$this->base_dir/vistas/$this->return");
            return;
        }

        $id = $_POST['idGrupo'];

        $grupo = $this->getDatosGrupo($id);

        if (isset($_POST['nombreGrupo']))       $grupo->setNombreGrupo($_POST['nombreGrupo']);
        if (isset($_POST['descripcionGrupo']))  $grupo->setDescripcionGrupo($_POST['descripcionGrupo']);
        if (isset($_POST['visibilidad']))       $grupo->setVisibilidad($_POST['visibilidad']);

        $res = $this->grupoMapper->update($grupo);

        if ($res) {
            //Correcto
            $this->msg->success($this->idioma['okUpdate']);
        } else {
            //Hubo algun problema.
            $this->msg->error($this->idioma['errorUpdate']);
        }
        header("location: /$this->base_dir/vistas/$this->return");
    }

    //Función obtener datos del usuario a través del grupo
    function getGroupOfUser($idUser)
    {
        $datos2 = $this->grupoMapper->getGroupUser($idUser);
        return $datos2;
    }

    //Función obtener usuarios del grupo concreto
    function getGroupUsers($idGrupo)
    {

        $datos3 = $this->grupoMapper->getUsuariosGroup($idGrupo);
        return $datos3;

    }


//Funcion borrar grupo
    public function delete()
    {

        //if (grupo ten asociados => inactivo)

        $res= $this->grupoMapper->delete($this->id);

        if ($res) {
            //Fue bien
            $this->msg->success($this->idioma['okDeleteGrupo']);
        } else {
            //Hubo un error
            $this->msg->error($this->idioma['errorDeleteGrupo']);
        }

        header("location: /$this->base_dir/vistas/v-consultagrupo.php");

    }

    public function esAdminGrupo($idUsuario,$idGrupo) {

        return $this->grupoMapper->esAdminGrupo($idUsuario,$idGrupo);


    }

    //Funcion que devuelve si un usuario pertenece al grupo

    public function isInGrupo($idUsuario,$idGrupo) {

        return $this->grupoMapper->isInGrupo($idUsuario,$idGrupo);

    }

    //Funcion añade miembros a grupo

    public function addMiembros() {

        $res = true;

        $datosGrupo = $this->grupoMapper->getDatosGrupo($_POST['idGrupo']);
        $idGrupo = $datosGrupo->getIdGrupo();

        if (isset($_POST['admins'])) {

            $admins = $_POST['admins'];

        }
        else { $admins = [];}

        $seleccionados = $_POST['seleccionados'];

        if (empty($seleccionados)) {

            $this->msg->error($this->idioma['errorAddMiembrosSeleccion']);


        }


        else {

            foreach ($seleccionados as $seleccion) {

                if (in_array($seleccion, $admins)) {
                    $admin = true;
                } else {
                    $admin = false;
                }
                $res = $this->grupoMapper->addMiembros($datosGrupo->getIdGrupo(),$datosGrupo->getCalendario(),$seleccion,$admin);

            }


            if ($res) {

                $this->msg->success($this->idioma['okAddMiembros']);


            } else {
                //Hubo un error
                $this->msg->error($this->idioma['errorAddMiembros']);
            }

        }

        header("location: /$this->base_dir/vistas/v-panelgrupo.php?idGrupo=$idGrupo");

    }


    public function dropMiembro() {

        $res = $this->grupoMapper->deasignaUsuario($_GET['idGrupo'],$_GET['idUsuario']);

        if ($res) {
            $this->msg->success($this->idioma['okDropMiembro']);
        } else {
            $this->msg->error($this->idioma['errorDroMiembro']);
        }

        //header("location: /$this->base_dir/vistas/v-panelgrupo.php?idGrupo=$idGrupo");
        header("Location: $this->url2return");

    }

    public function getNumGrupos(){


        return $this->grupoMapper->getNumGrupos();


    }


}