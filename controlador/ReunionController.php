<?php

/**
 * Created by IntelliJ IDEA.
 * User: rbr
 * Date: 23/12/15
 * Time: 20:52
 */
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../clases/Reunion.php");
require_once(__DIR__ . "/../modelos/ReunionMapper.php");
require_once(__DIR__ . "/../modelos/GrupoMapper.php");
require_once(__DIR__ . "/../clases/Notificacion.php");
require_once(__DIR__ . "/../modelos/NotificacionMapper.php");
require_once(__DIR__ . "/../modelos/ReunionMapper.php");
require_once(__DIR__ . "/../funciones/basedir.php");


class ReunionController extends Controller
{

    private $grupoMapper;
    private $notificacionMapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new ReunionMapper();
        $this->grupoMapper = new GrupoMapper();
        $this->notificacionMapper = new NotificacionMapper();
    }

    public function add()

    {

        $idGrupo = $_POST['idGrupo'];
        $idUsuario = $_POST['idUsuario'];
        $fechaReunion = Tools::php2date($_POST['fechaReunion']);
        $estadoReunion = 0;

        /* Estados: 0->Propuesta, 1-> Confirmada, 2-> Realizada, 3->Cancelada */

        $reunion = new Reunion(null,$idGrupo,$fechaReunion,null,$estadoReunion);

        $idReunionCreado = $this->mapper->add($reunion);

        if (!$idReunionCreado) {
            //Error en la insercion.
            //Mensaxe de erro.
            $this->msg->error($this->idioma['errorAlta']);

        } else {

            // Si va bien, enviamos notificacion a todos los miembros del grupo.

            $frase = 'Se ha propuesto una reunion para la fecha ';

            $this->notificaMiembros($idGrupo,$idUsuario,$idReunionCreado,$frase);

            $this->msg->success($this->idioma['okAlta']);


        }

        header("location: /$this->base_dir/vistas/v-reunion.php?id=$idGrupo");



    }

    public function delete() {

        $reunion = $this->mapper->getDatosReunion($this->id);

        if($reunion->getEstadoReunion()>0){
            $this->msg->error($this->idioma['errorDeleteReunionEstado']);
        }else{
            $res = $this->mapper->delete($this->id);

            if ($res) {
                $this->msg->success($this->idioma['okDelete']);
            } else {
                $this->msg->error($this->idioma['errorDelete']);
            }
        }

        header("location: $this->url2return");
    }

    public function getReunionesGrupo($idGrupo) {

        return $this->mapper->getReunionesGrupo($idGrupo);

    }

    public function setCancelada() {

        $idReunion = $_GET['idReunion'];
        $idGrupo = $_GET['idGrupo'];
        $idUsuario = $_GET['idUsuario'];

        $reunion = new Reunion($idReunion,null,null,null,3);
        $res = $this->mapper->setEstado($reunion);

        if (!$res) {

            $this->msg->error($this->idioma['errorAccion']);

        } else {

            $frase = 'Se ha cancelado la reunion para la fecha ';

            $this->notificaMiembros($idGrupo,$idUsuario,$idReunion,$frase);

            $this->msg->success($this->idioma['okAccion']);


        }

        header("location: /$this->base_dir/vistas/v-reunion.php?id=$idGrupo");



    }

    public function setConfirmada() {

        $idReunion = $_GET['idReunion'];
        $idGrupo = $_GET['idGrupo'];
        $idUsuario = $_GET['idUsuario'];

        $reunion = new Reunion($idReunion,null,null,null,1);
        $res = $this->mapper->setEstado($reunion);

        if (!$res) {

            $this->msg->error($this->idioma['errorAccion']);

        } else {

            $frase = 'Se ha confirmado la reunion para la fecha ';

            $this->notificaMiembros($idGrupo,$idUsuario,$idReunion,$frase);

            $this->msg->success($this->idioma['okAccion']);


        }

        header("location: /$this->base_dir/vistas/v-reunion.php?id=$idGrupo");



    }

    public function confirmarAsistencia() {

        $idReunion = $_GET['idReunion'];
        $idGrupo = $_GET['idGrupo'];
        $idUsuario = $_GET['idUsuario'];


        $frase = 'Confirmo asistencia a la reunion para la fecha ';

        $this->notificaAdmins($idGrupo,$idUsuario,$idReunion,$frase);

        $this->msg->success($this->idioma['okAccion']);

        header("location: /$this->base_dir/vistas/v-reunion.php?id=$idGrupo");


    }

    public function confirmarNoAsistencia() {

        $idReunion = $_GET['idReunion'];
        $idGrupo = $_GET['idGrupo'];
        $idUsuario = $_GET['idUsuario'];


        $frase = 'Confirmo la NO asistencia a la reunion para la fecha ';

        $this->notificaAdmins($idGrupo,$idUsuario,$idReunion,$frase);

        $this->msg->success($this->idioma['okAccion']);

        header("location: /$this->base_dir/vistas/v-reunion.php?id=$idGrupo");


    }


    public function uploadActa() {

        $idGrupo = $_GET['idGrupo'];
        $idReunion = $_GET['idReunion'];
        $idUsuario = $_GET['idUsuario'];
        $nombre = basename($_FILES["docActa"]["name"]);

        if (!file_exists($this->files_root.'/'.Reunion::$DOCS_ROOT)) {
            @mkdir($this->files_root.'/'.Reunion::$DOCS_ROOT, 0777);

            if (!file_exists($this->files_root.'/'.Reunion::$DOCS_ROOT)) {
                $this->msg->error("Imposible crear el directorio de documentos. Cree un directorio 'uploads' y asigne permisos de escritura");
                $this->redir();
                return;
            }else{
                $this->msg->info('El directorio de documentos ha sido creado.');
            }
        }

        if($nombre == ""){
            $this->msg->error('Falta el documento.');
            //$this->redir();
            header("location: /$this->base_dir/vistas/v-reunion.php?id=$idGrupo");
            return;
        }

        //$reunion = new Reunion($idReunion,null,null,$nombre,null);
        $reunion = $this->mapper->getDatosReunion($idReunion);
        //$reunion->setActa($nombre);

        $target_file = $reunion->getFicheroPath();
        $uploadOk = 1;

        // Check if file already exists
        if (file_exists($target_file)) {
            $this->msg->error('El documento ya existe.');
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["docActa"]["size"] > Reunion::$MAX_FILESIZE) {

            $this->msg->error('El documento excede el tamaño permitido.');
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $this->msg->error('El documento no se ha subido.');
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["docActa"]["tmp_name"], $target_file)) {
                $this->msg->success(sprintf("El documento %s se ha subido al servidor", $_FILES["docActa"]["name"]));
            } else {
                $uploadOk = 0;
                $this->msg->error('Ha habido un error al subir el documento.');
            }
        }

        if ($uploadOk == 1) {
            $res = $this->mapper->setActa($reunion);

            if ($res) {
                //Fue bien. marcamos la reunion como realizada y enviamos mensaje.

                $reunion = new Reunion($idReunion,null,null,null,2);
                $res = $this->mapper->setEstado($reunion);

                if ($res) {

                    $frase = 'Ya esta disponible el acta de la reunion de fecha ';

                    $this->notificaMiembros($idGrupo,$idUsuario,$idReunion,$frase);
                    $this->msg->success($this->idioma['okActaDoc']);


                } else {

                    $this->msg->error($this->idioma['errorActaDoc']);

                }


            } else {
                //Hubo un error
                $this->msg->error($this->idioma['errorActaDoc']);
            }
        }

        header("location: /$this->base_dir/vistas/v-reunion.php?id=$idGrupo");

    }

    public function updateFecha() {

        $fechaReunion = Tools::php2date($_POST['fechaReunion']);
        $idReunion = $_POST['idReunion'];
        $idGrupo = $_POST['idGrupo'];
        $idUsuario=$_POST['idUsuario'];
        $reunion_vieja = $this->mapper->getDatosReunion($idReunion);
        $reunion = new Reunion($idReunion,null,$fechaReunion,null,null);
        $res = $this->mapper->updateFecha($reunion);

        if (!$res) {

            $this->msg->error($this->idioma['errorAccion']);

        } else {

            //Notifico a los miembros del cambio.

            $frase = $this->idioma['Se ha modificado la fecha de la reunion: '];
            error_log($frase,0);

            $this->notificaMiembros($idGrupo,$idUsuario,$reunion_vieja->getIdReunion(),$frase);
            $this->msg->success($this->idioma['okAccion']);


        }

        header("location: /$this->base_dir/vistas/v-reunion.php?id=$idGrupo");


    }

    public function notificaMiembros($idGrupo,$idRemitente,$idReunion,$texto) {

        $miembros = $this->grupoMapper->getUsuariosGroup($idGrupo);
        $datosGrupo = $this->grupoMapper->getDatosGrupo($idGrupo);
        $datosReunion = $this->mapper->getDatosReunion($idReunion);
        $fecha = Tools::date2php($datosReunion->getFechaReunion());

        $mensaje = '['.$datosGrupo->getNombreGrupo().'] '.$this->idioma[$texto].$fecha;


        foreach ($miembros as $miembro) {

            $notificacion = new Notificacion(null, $mensaje, null, 1, $miembro->getIdUsuario(), $idRemitente);
            $this->notificacionMapper->add($notificacion);

        }


    }

    public function notificaAdmins($idGrupo,$idRemitente,$idReunion,$texto) {

        $miembros = $this->grupoMapper->getUsuariosGroup($idGrupo);
        $datosGrupo = $this->grupoMapper->getDatosGrupo($idGrupo);
        $datosReunion = $this->mapper->getDatosReunion($idReunion);
        $fecha = Tools::date2php($datosReunion->getFechaReunion());

        $mensaje = '['.$datosGrupo->getNombreGrupo().'] '.$this->idioma[$texto].$fecha;


        foreach ($miembros as $miembro) {

            if ($this->grupoMapper->esAdminGrupo($miembro->getIdUsuario(), $idGrupo)) {

                $notificacion = new Notificacion(null, $mensaje, null, 1, $miembro->getIdUsuario(), $idRemitente);
                $this->notificacionMapper->add($notificacion);

            }

        }


    }


}