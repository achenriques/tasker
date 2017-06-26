<?php

/**
 * Created by NetBeans.
 * User: aouteiral
 * Date: 20/12/15
 * Time: 14:25
 */

require_once(__DIR__ . "/../funciones/basedir.php");
require_once(__DIR__ . "/../funciones/comunes.php");
require_once(__DIR__ . "/../lib/FlashMessages.php");
//require_once(__DIR__ . "/../controlador/UsuarioController.php");
require_once(__DIR__ . "/../modelos/UsuarioMapper.php");

if (!session_id()) @session_start();

class Controller
{

    protected $user;
    protected $msg;
    protected $idioma;
    protected $mapper;
    protected $base_dir;
    protected $return;
    protected $url2return;
    protected $id;
    protected $files_root;
    protected $web_root;

    public function __construct()
    {
        if (!session_id()) @session_start();

        $this->base_dir = basedir();

        //$this->files_root = $_SERVER['DOCUMENT_ROOT'] . '/tasker/';
        //$this->web_root = 'tasker/';

        $this->files_root = $_SERVER['DOCUMENT_ROOT'] . "/$this->base_dir/";
        $this->web_root = "$this->base_dir/";

        //if (!isset($_SESSION['idUsuario']))
        //    header("location: /$this->base_dir/");
        // Isto da os problemas de redireccion de crear novo usuario no login

        $this->msg = new \Plasticbrain\FlashMessages\FlashMessages();

        if (isset($_SESSION['idUsuario'])) {

            //$controlador = new UsuarioController();
            //$this->user = $controlador->getDatosUsuario($_SESSION['idUsuario']);
            $this->user = (new UsuarioMapper())->getDatosUsuario($_SESSION['idUsuario']);

            //die($_SESSION['idUsuario']);

            $lang = $this->user->getIdioma();
        } else {
            $lang = 'es';
        }

        $lang_file = file_exists(__DIR__ . "/../lang/$lang.php") ? __DIR__ . "/../lang/$lang.php" : __DIR__ . "/../lang/es.php";
        include($lang_file);
        $this->idioma = $idioma;


        $this->url2return = $_SESSION['url2return'];

        $this->id = isset($_GET['id']) ? $_GET['id'] : null;
        $this->return = isset($_GET['return']) ? $_GET['return'] : "v-dashboard.php";
        if (substr($this->return, -4) != ".php") $this->return .= ".php";
        if (substr($this->return, 0, 2) != "v-") $this->return = "v-" . $this->return;
        
    }
    
    //Haberia q verificar que o usuario e propietario da tarefa ou superadmin
    protected function isAllowed() {
        
        return true;
    }

    protected function redir($dir = null){
        if(is_null($dir))
            $dir = $this->url2return;

        header("location: $dir");
        //header("location: /$this->base_dir/vistas/$this->return");
    }
    
}
