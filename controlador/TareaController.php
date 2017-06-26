<?php

/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 14:00
 */

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../modelos/EstadoMapper.php");
require_once(__DIR__ . "/../modelos/TareaMapper.php");
require_once(__DIR__ . "/../clases/Tarea.php");
require_once(__DIR__. "/../funciones/basedir.php");

class TareaController extends Controller
{

    private $tareaMapper;
    private $estadoMapper;
    
    public function __construct()
    {
        parent::__construct();
        $this->tareaMapper = new TareaMapper();
        $this->estadoMapper = new EstadoMapper();
    }
        
    //Haberia q verificar que o usuario e propietario da tarefa ou superadmin
    protected function isAllowed() {
        return parent::isAllowed();
    }

    public function add() {
        
        $codTarea = $_POST['codTarea'];
        $nombreTarea = $_POST['nombreTarea'];
        $descripcionTarea = $_POST['descripcionTarea'];
        $tareaPadre = $_POST['codPadre']>0 ? $_POST['codPadre'] : null;
        $fechaEstIni = Tools::php2date($_POST['fechaEstIni']);
        $fechaEstFin = Tools::php2date($_POST['fechaEstFin']);
        $idUsuario = $_POST['idUsuario'];
        //$fechaRealIni = $_POST['fechaRealIni'];
        //$fechaRealFin = $_POST['fechaRealFin'];
        $calendario = $_POST['calendario'];

        $fechaRealIni = $fechaEstIni;
        $fechaRealFin = $fechaEstFin;
        $estadoTarea = 1;

        $tarea = new Tarea(null,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin);



        //Check FechaEstimada
        if(!$this->checkFechaEstimada($tarea)) {
            $this->msg->error(sprintf($this->idioma['errorFechaEstimada'], $tarea->getFechaEstFin()));
            //header("Location: javascript://history.go(-1)"); //regresa a formulario
            header("Location: $this->url2return");
            return;
        }

        //Check FechaTareaPadre
        if(!$this->checkFechaTareaPadre($tarea)) {
            $padre = $this->tareaMapper->getDatosTarea($tarea->getTareaPadre());
            $this->msg->error(sprintf($this->idioma['errorFechaTareaPadre'], $padre->getFechaEstFin()));
            //header("Location: javascript://history.go(-1)"); //regresa a formulario
            header("Location: $this->url2return");
            return;
        }

        //Check exists codTarea
        if(!$this->checkExistsCodTarea($tarea)) {
            $this->msg->error(sprintf($this->idioma['errorUpdateExistsCode'], $tarea->getCodTarea()));
            //header("Location: javascript://history.go(-1)"); //regresa a formulario
            header("Location: $this->url2return");
            return;
        }

        $res = $this->tareaMapper->add($tarea,$calendario);

        if ($res) {
            $this->msg->success($this->idioma['okAltaTarea']);
        } else {
            $this->msg->error($this->idioma['errAltaTarea']);
        }
        //header("location: /$this->base_dir/vistas/$this->return");
        header("Location: $this->url2return");
    }

    public function getAllTareas(){

        $datos = $this->tareaMapper->getAll();
        return $datos;

    }
    
    public function getSubTareas($id){

        $datos = $this->tareaMapper->getSubTareas($id);
        return $datos;

    }

    public function getAllEstados(){

        $datos = $this->estadoMapper->getAll();
        return $datos;

    }
    
    public function getDatosTarea($id){

        $datos = $this->tareaMapper->getDatosTarea($id);
        return $datos;

    }
    
    public function update() {
        
        //Haberia q verificar que o usuario e propietario da tarefa ou superadmin
        if (!$this->isAllowed()) {
            $this->msg->error($this->idioma['errorNotAllowed']);
            header("location: $this->url2return");
            //header("location: /$this->base_dir/vistas/$this->return");
            return;
        }
        
        $idTarea = $_POST['idTarea'];
        
        $tarea = $this->getDatosTarea($idTarea);

        if (isset($_POST['codTarea']))          $tarea->setCodTarea($_POST['codTarea']);
        if (isset($_POST['nombreTarea']))       $tarea->setNombreTarea($_POST['nombreTarea']);
        if (isset($_POST['descripcionTarea']))  $tarea->setDescripcionTarea($_POST['descripcionTarea']);
        if (isset($_POST['codPadre']))          $tarea->setTareaPadre($_POST['codPadre']>0 ? $_POST['codPadre'] : null);
        if (isset($_POST['codEstadoTarea']))    $tarea->setEstadoTarea($_POST['codEstadoTarea']);
        if (isset($_POST['fechaEstIni']))       $tarea->setFechaEstIni(Tools::php2date($_POST['fechaEstIni']));
        if (isset($_POST['fechaEstFin']))       $tarea->setFechaEstFin(Tools::php2date($_POST['fechaEstFin']));
        if (isset($_POST['fechaRealIni']))      $tarea->setFechaRealIni(Tools::php2date($_POST['fechaRealIni']));
        if (isset($_POST['fechaRealFin']))      $tarea->setFechaRealFin(Tools::php2date($_POST['fechaRealFin']));

        //Check FechaEstimada
        if(!$this->checkFechaEstimada($tarea)) {
            $this->msg->error(sprintf($this->idioma['errorFechaEstimada'], $tarea->getFechaEstFin()));
            //header("Location: javascript://history.go(-1)"); //regresa a formulario
            header("Location: $this->url2return");
            return;
        }

        //Check FechaTareaPadre
        if(!$this->checkFechaTareaPadre($tarea)) {
            $padre = $this->tareaMapper->getDatosTarea($tarea->getTareaPadre());
            $this->msg->error(sprintf($this->idioma['errorFechaTareaPadre'], $padre->getFechaEstFin()));
            //header("Location: javascript://history.go(-1)"); //regresa a formulario
            header("Location: $this->url2return");
            return;
        }

        //Check exists codTarea
        if(!$this->checkExistsCodTarea($tarea)) {
            $this->msg->error(sprintf($this->idioma['errorUpdateExistsCode'], $tarea->getCodTarea()));
            //header("Location: javascript://history.go(-1)"); //regresa a formulario
            header("Location: $this->url2return");
            return;
        }

        $res = $this->tareaMapper->update($tarea);

        if ($res) {
            //Correcto
            $this->msg->success($this->idioma['okUpdate']);
        } else {
            //Hubo algun problema.
            $this->msg->error($this->idioma['errorUpdate']);
        }
        header("location: $this->url2return");
        //header("location: /$this->base_dir/vistas/$this->return");
        //header("location: /$this->base_dir/vistas/$this->return?id=$idTarea");
    }

    public function getTareasUsuario($idUsuario, $estado = 0) {

        return $this->tareaMapper->getTareasUsuario($idUsuario, $estado);

    }

    public function close() {
        
        //Haberia q verificar que o usuario e propietario da tarefa ou superadmin
        if (!$this->isAllowed()) {
            $this->msg->error($this->idioma['errorNotAllowed']);
            header("location: $this->url2return");
            //header("location: /$this->base_dir/vistas/$this->return");
            return;
        }
        
        $res = $this->tareaMapper->setFinTareas($this->id);

        if ($res) {
            //Correcto
            $this->msg->success($this->idioma['okUpdate']);
        } else {
            //Hubo algun problema.
            $this->msg->error($this->idioma['errorUpdate']);
        }
        //header("location: /$this->base_dir/vistas/$this->return");
        header("location: $this->url2return");
    }
    
    public function delete() {
        
        //Haberia q verificar que o usuario e propietario da tarefa ou superadmin
        if (!$this->isAllowed()) {
            $this->msg->error($this->idioma['errorNotAllowed']);
            header("location: $this->url2return");
            //header("location: /$this->base_dir/vistas/$this->return");
            return;
        }
        
        if($this->tieneTareasHijas($this->id)){
            //$this->msg->error($this->idioma['errorDelete']);
            $this->msg->error('No se puede eliminar esta tarea. Hay tareas que dependen de ella');
            header("location: $this->url2return");
            //header("location: /$this->base_dir/vistas/$this->return");
            return;
        }
        
        $res = $this->tareaMapper->eliminarTarea($this->id);
        
        if ($res) {
            //Correcto
            $this->msg->success($this->idioma['okDelete']);
        } else {
            //Hubo algun problema.
            $this->msg->error($this->idioma['errorDelete']);
        }
        header("location: $this->url2return");
        //header("location: /$this->base_dir/vistas/$this->return");
    }

    protected function tieneTareasHijas($id) {
        return $this->isParent($id);
    }

    protected function hasHijas($id) {
        return $this->isParent($id);
    }

    protected function isParent($id) {

        $subtareas = $this->tareaMapper->getSubTareas($id);

        return !empty($subtareas);
    }

    protected function checkExistsCodTarea($tarea) {
        $res = $this->tareaMapper->existsCodTarea($tarea->getCodTarea(), $tarea->getIdTarea());
        return (!$res);
    }

    protected function checkFechaTareaPadre($tarea) {

        if(!$tarea->hasParent())
            return true;

        $padre = $this->tareaMapper->getDatosTarea($tarea->getTareaPadre());

        $fechaHija = $tarea->getFechaEstFin();
        $fechaPadre = $padre->getFechaEstFin();

        return $fechaHija<=$fechaPadre;
    }

    protected function checkFechaEstimada($tarea) {
        return $tarea->getFechaEstIni()<=$tarea->getFechaEstFin();
    }

    //Devuelve las tareas de un usuario por el calendario indicado
    public function getTareasByCal($idUsuario, $idCalendario, $estado = 0) {


        return $this->tareaMapper->getTareasByCal($idUsuario,$idCalendario,$estado);

    }

    public function getNumAllTareas() {


        return $this->tareaMapper->getNumAllTareas();

    }

    public function getTareasGrupo($idCalendario,$estado=0) {


        return $this->tareaMapper->getTareasGrupo($idCalendario,$estado);


    }


}
