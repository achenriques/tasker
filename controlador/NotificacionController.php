<?php

/**
 * Created by NetBeans.
 * User: aouteiral
 * Date: 19/12/15
 * Time: 16:25
 */

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../clases/Notificacion.php");
require_once(__DIR__ . "/../modelos/NotificacionMapper.php");

class NotificacionController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->mapper = new NotificacionMapper();
    }

    public function add() {
        
        $texto          = $_POST['textoNotif'];
        $tipo           = $_POST['tipoNotif'];
        $destinatario   = $_POST['destinatario'];
        $remitente      = $_POST['remitente'];
        
        //Non hai destinatario
        if(empty($destinatario))
            $this->msg->error($this->idioma['errSinDestinatario']);
        else{
            $notif = new Notificacion(null,$texto,null,$tipo,$destinatario,$remitente);
            $res = $this->mapper->add($notif);
            if ($res) {
                //OK
                $this->msg->success($this->idioma['okAltaNotif']);
            } else {
                //Error
                $this->msg->error($this->idioma['errAltaNotif']);
            }
        }
        //header("location: /$this->base_dir/vistas/$this->return");
        header("location: $this->url2return");
    }

    public function getDatosNotificacion($id) {
        $datos = $this->mapper->getDatosNotificacion($id);
        return $datos;
    }

    public function getNotificacionesUsuario($idUsuario) {
        return $this->mapper->getNotificacionesUsuario($idUsuario);
    }
    
    public function getAllNotificaciones() {
        return $this->mapper->getAll();
    }
    
    public function drop() {
  
        $res = $this->mapper->drop($this->id);

        if ($res) {
            //OK
            $this->msg->success($this->idioma['okDrop']);
        } else {
            //Error
            $this->msg->error($this->idioma['errorDrop']);
        }
        //header("location: /$this->base_dir/vistas/$this->return");
        header("location: $this->url2return");
    }
    
}
