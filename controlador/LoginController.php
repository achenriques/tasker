<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 11:50
 */

require_once __DIR__.'/../tools.php';
require_once __DIR__.'/../funciones/basedir.php';
require_once __DIR__ . "/../modelos/LoginMapper.php";

class LoginController {

    private $loginMapper;

    public function __construct() {

        $this->loginMapper = new LoginMapper;

        if (!session_id()) @session_start();

    }

    function index() {

        //@session_start();

        $base_dir = basedir();

        $vista = isset($_SESSION['idUsuario']) ? "v-dashboard.php" : "v-login.php";

        header("location: /$base_dir/vistas/$vista");
        //header("Location: /$base_dir/vistas/v-login.php");
    }

    public function login(){

        //@session_start();

        $base_dir = basedir();

        $login = $_POST['nick'];
        $pass = $_POST['password'];

        $loginMapper = new LoginMapper();

        $usuarioLogin = $loginMapper->checkLogin($login, $pass);

        if (is_null($usuarioLogin)) {

            $_SESSION['badLogin'] = true;
            header("Location: /$base_dir/vistas/v-login.php?msg=errorLogin&tipo=danger");

        } else {


            $_SESSION['idUsuario'] = $usuarioLogin->getIdUsuario();
            //$_SESSION['id_usuario'] = $usuarioLogin->getIdUsuario();
            /*$_SESSION['nombre'] = $usuarioLogin->getNombre();
            $_SESSION['email'] = $usuarioLogin->getEmail();
            $_SESSION['idioma'] = $usuarioLogin->getIdioma();*/


            if ($usuarioLogin->getAdmin()) {


                header("Location: /$base_dir/vistas/v-admindashboard.php");

            } else {

                header("Location: /$base_dir/vistas/v-dashboard.php");

            }

        }
    }

    public function logout(){

        @session_destroy();

        $base_dir = basedir();

        header("Location: /$base_dir/vistas/v-login.php");

    }


}