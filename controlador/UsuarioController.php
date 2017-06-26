<?php

/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 14:00
 */

require_once(__DIR__ . "/../modelos/UsuarioMapper.php");
require_once(__DIR__ . "/../clases/Usuario.php");
require_once(__DIR__ . "/../modelos/CalendarioMapper.php");
require_once(__DIR__ . "/../clases/Calendario.php");
require_once(__DIR__ . "/../modelos/GrupoMapper.php");
require_once(__DIR__ . "/../clases/Grupo.php");
require_once(__DIR__ . "/Controller.php");

require_once(__DIR__. "/../funciones/basedir.php");

class UsuarioController extends Controller
{

    private $usuarioMapper;
    private $calendarioMapper;


    public function __construct()
    {
        if(!isset($_GET['return'])) $_GET['return'] = "v-perfil";
        parent::__construct();
        $this->return = isset($_GET['return']) ? $_GET['return'] : "v-perfil.php";
        $this->usuarioMapper = new UsuarioMapper();
        $this->calendarioMapper = new CalendarioMapper();
    }

    public function add()
    {

        $base_dir = basedir();

        /* Recogemos los datos del POST*/

        $nick = $_POST['nick'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['passwordU'];
        $passwordConf = $_POST['passwordConf'];
        $idioma = $_POST['idioma'];
        if (isset($_POST['admin'])) { $admin = $_POST['admin']; } else { $admin = 0;};
        if (isset($_POST['grupoSelCod'])) { $idGrupo = $_POST['grupoSelCod']; };
        $hay_errores = false;
        $borrado = 0;

        /*Comprobamos si las password introducidas son iguales*/

        if ($password != $passwordConf) {


            //Error
            $this->msg->error($this->idioma['passDistintas2']);
//            header("location: /$base_dir/vistas/v-login.php?msg=passDistintas2&tipo=danger");

        } else {

            //Las passwords son iguales.

            $usuario = new Usuario(null,$nick, $nombre, $email, $password,null,$idioma,$borrado,$admin);

            //Validamos el username indicado y el email
            $ok_username = $this->usuarioMapper->checkValidUsername($usuario);
            $ok_email = $this->usuarioMapper->checkValidEmail($usuario);

            if (!$ok_username) {

                // El usuario ya existe.
                $_SESSION['yaExisteUsu'] = true;
                $hay_errores = true;
                $this->msg->error($this->idioma['yaExisteUsu']);
            }

            //El usuario no existe, validamos email.

            elseif (!$ok_email) {

                //El el email ya existe
                $_SESSION['yaExisteEmail'] = true;
                $hay_errores = true;
                $this->msg->error($this->idioma['yaExisteEmail']);


            }

            else {

                // tanto email como usuario no existen. Insertamos el usuario.

                $idCreado = $this->usuarioMapper->add($usuario);

                if (!$idCreado) {

                    //Error en la insercion.
                    $hay_errores = true;
                    $_SESSION['errorAdd'] = true;
                    $this->msg->error($this->idioma['errorAddUsu']);

                }
                else {

                    //To do  fue bien.


                    $_SESSION['okAdd'] = true;
                    $this->msg->success($this->idioma['okAlta']);

                    //Creamos su Calendario.

                    $calendario = new Calendario(null,'Predeterminado','white');
                    $idCalendario = $this->calendarioMapper->add($calendario);

                    $calendario->setIdCalendario($idCalendario);
                    $this->calendarioMapper->asignaCalendario($calendario,$idCreado);


                    // Si es un usuario publico lo añadimos al grupo publico que ha elegido:


                    if (isset($idGrupo)) {

                        $grupoMapper = new GrupoMapper();
                        $datosGrupo = $grupoMapper->getDatosGrupo($idGrupo);


                        $grupoMapper->addMiembros($idGrupo,$datosGrupo->getCalendario(),$idCreado,0);


                    }


                    $base_dir = basedir();
//                    header("location: /$base_dir/vistas/v-login.php?msg=altaUsuarioOK&tipo=success");

                }


            }


        }

        /* Si no hay errores, volvemos al login*/

        if ($hay_errores) {

            /*Recuperamos la url del server*/
            $base_dir = basedir();
//            header("location: /$base_dir/vistas/v-login.php");

        }


        header("location: $this->url2return");
    }

    public function getDatosUsuario($idUsuario){


        $datosUsuario = $this->usuarioMapper->getDatosUsuario($idUsuario);
        return $datosUsuario;


    }

    public function recuperaFoto($username){


        return $this->usuarioMapper->recuperaFoto($username);

    }

    public function insertaFoto(){


        /* Capturamos la imagen*/
        $tmp = $_FILES['imgUsuario']['tmp_name'];
        $username = $_POST['username'];

        /*Tamaño maximo*/
        $max_tamano=2097152;

        if (filesize($tmp) > $max_tamano) {

            // Error, tamaño de la imagen excedido.
            $_SESSION['errorTamano'] = true;

        }

        else {

            // Abrimos la imagen, en modo lectura y binario
            $fp = fopen($tmp,'rb');
            // Leemos la imagen abierta,hasta el final
            $imagen = fread($fp,filesize($tmp));
            fclose($fp);

            // Lamamos al modelo.
            $this->usuarioMapper->insertaFoto($username,$imagen);

        }
        //Recuperamos url servidor.
        $base_dir = basedir();
        //Redirigimos
        header("location: /$base_dir/vistas/v-perfil.php");


    }

    public function delete(){

        //recuperamos url del servidor.

        $base_dir = basedir();
        //$idUsuario = $_POST['idUsuario'];
        $idUsuario = $_GET['id'];
        $res = $this->usuarioMapper->delete($idUsuario);

        if ($res) {

            //Fue bien
            header("location: /$base_dir/vistas/v-listarusuarios.php?msg=okDelete&tipo=success");

        }
        else
        {

            //Hubo un error
            header("location: /$base_dir/vistas/v-listarusuarios.php?msg=errorDelete&tipo=danger");


        }


    }

    public function update(){

        //recuperamos url del servidor.
        $base_dir = basedir();

        $idUsuario = $_POST['idUsuario'];
        $username = $_POST['username'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $idioma = $_POST['idioma'];
        $admin = $_POST['admin'];


        $usuario = new Usuario($idUsuario,$username,$nombre,$email,null,null,$idioma,null,$admin);

        $res = $this->usuarioMapper->update($usuario);

        if ($res) {
            //Correcto
            $this->msg->success($this->idioma['okUpdate']);
        } else {
            //Hubo algun problema.
            $this->msg->error($this->idioma['errorUpdate']);
        }
        header("location: $this->url2return");

    }

    public function updatePass() {

        $base_dir = basedir();
        $idUsuario = $_POST['idUsuario'];
        $passNueva = $_POST['passwordU'];
        $passNuevaConf = $_POST['passwordConf'];

        // Comprobamos que sean iguales
        if ($passNueva == $passNuevaConf) {
            $res = $this->usuarioMapper->updatePass($idUsuario,$passNueva);
            if ($res) {
                //Correcto
                $this->msg->success($this->idioma['okUpdate']);
            } else {
                //Hubo algun problema.
                $this->msg->error($this->idioma['errorUpdate']);
            }
        } else {
            $this->msg->error($this->idioma['passDistintas']);
        }

        header("location: $this->url2return");

    }
    
    public function consult(){

        $text = isset($_GET['query']) ? $_GET['query'] : '';
        $maxResults = isset($_GET['maxResults']) ? $_GET['maxResults'] : 5;
        
        $results = $this->usuarioMapper->getUsersByText($text, $maxResults);
        
        echo $results;

    }

    public function getAllUsuarios(){

        $datos = $this->usuarioMapper->getAll();
        return $datos;

    }

    public function esSuperAdmin(Usuario $usuario) {


        if ($usuario->getAdmin()) {

            return true;

        }

        else {return false;}


    }

    public function getNumUsers() {

        return $this->usuarioMapper->getNumUsers();


    }

}