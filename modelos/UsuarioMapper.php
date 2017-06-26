<?php

/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 16:05
 */
require_once(__DIR__ . "/../modelos/PDOConnection.php");
require_once(__DIR__ . "/../clases/Usuario.php");

class UsuarioMapper
{

    private $db;

    public function __construct(){
        $this->db= PDOConnection::getInstance();
    }

    /**
     * @param Usuario $usuario
     * @return bool
     *
     * Recibe un objeto Usuario y lo inserta en la BD
     */
    public function add(Usuario $usuario){

        $username=$usuario->getUsername();
        $nombre=$usuario->getNombre();
        $email=$usuario->getEmail();
        $passw=$usuario->getPassword();
        $idioma=$usuario->getIdioma();
        $admin=$usuario->getAdmin();

        $stmt = $this->db->prepare("INSERT INTO USUARIO(username,nombre,email,password,idioma,admin) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssi', $username, $nombre, $email, $passw, $idioma, $admin);
        $stmt->execute();

        //ultimo auto-incrementado creado
        $last_insert = $this->db->insert_id;

        /* Recoge el error de la consulta. Si está vacio la consulta fue bien, en caso contrario no*/
        $result = $stmt->error;
        $stmt->close();
        if ( !$result ) { return $last_insert; }

        return false;

    }

    /**
     * @param Usuario $usuario
     * @return bool
     *
     * Actualiza los datos del usuario dado un objeto con los datos actualizados.
     */
    public function update(Usuario $usuario) {

        $idUsuario=$usuario->getIdUsuario();
        $username=$usuario->getUsername();
        $nombre=$usuario->getNombre();
        $email=$usuario->getEmail();
        $idioma=$usuario->getIdioma();
        $admin=$usuario->getAdmin();

        $stmt = $this->db->prepare("UPDATE USUARIO SET username=?,nombre=?,email=?,idioma=?,admin=? WHERE idUsuario=?");
        $stmt->bind_param('ssssis', $username, $nombre, $email, $idioma, $admin, $idUsuario);
        $stmt->execute();

        /* Recoge el error de la consulta. Si está vacio la consulta fue bien, en caso contrario no*/
        $result = $stmt->error;
        $stmt->close();
        if ( !$result ) { return true; }

        return false;

    }

    /**
     * @param $username
     * @return bool
     *
     * Borra el usuario
     * TODO Si el usuario tiene alguna tarea no se deberia de borrar, si no que se pone su flag borrado a 1
     */

    public function delete($idUsuario) {

        $stmt = $this->db->prepare("DELETE FROM USUARIO WHERE idUsuario=?");
        $stmt->bind_param('s', $idUsuario);
        $stmt->execute();
        $result = $stmt->error;
        $stmt->close();
        if ( !$result ) { return true; }

        return false;
    }

    /**
     * @param Usuario $usuario
     * @return bool
     *
     * Dado un username indica si ya existe en la BD.
     *
     */

    public function checkValidUsername(Usuario $usuario){
        $username=$usuario->getUsername();
        $stmt=$this->db->query("SELECT * FROM USUARIO ");
        if($stmt!=false) {
            while ($usuarios = $stmt->fetch_assoc()) {
                if ($usuarios['username'] == $username) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @param Usuario $usuario
     * @return bool
     *
     * Comprueba si un email ya existe en la BD.
     *
     */
    public function checkValidEmail(Usuario $usuario){
        $email=$usuario->getEmail();
        $stmt=$this->db->query("SELECT * FROM USUARIO ");
        while($usuarios=$stmt->fetch_assoc()){
            if($usuarios['email']==$email) {
                return false;
            }

        }
        return true;

    }

    /**
     * @param $username
     * @return Usuario
     *
     * Devuelve un array con los datos del usuario dado por su username.
     *
     */
    public function getDatosUsuario($idUsuario){

        $stmt = $this->db->prepare("SELECT *
								  FROM USUARIO
								  WHERE idUsuario=?");
        $stmt->bind_param('s', $idUsuario);
        $stmt->execute();

        $stmt->bind_result($qIdUsuario,$qUsername, $qNombre, $qEmail, $qPassword, $qImagen, $qIdioma, $qBorrado, $qAdmin);
        $stmt->fetch();
        $stmt->close();

        return new Usuario($qIdUsuario,$qUsername, $qNombre, $qEmail, $qPassword, null, $qIdioma, $qBorrado, $qAdmin);

    }

    /**
     * @param $username
     * @param $imagen
     *
     * Almacena la imagen (binaria) en un campo Blob.
     *
     */
    public function insertaFoto($username,$imagen) {

        /* Necesario ralizar este paso*/
        $imagen = $this->db->real_escape_string($imagen);
        $this->db->query("UPDATE USUARIO SET imagen='$imagen' WHERE username='$username'");


    }

    /**
     * @param $username
     * @return mixed
     *
     * Recupera la foto del usuario indicado por username
     *
     */

    public function recuperaFoto($username) {

        $stmt=$this->db->query("SELECT imagen FROM USUARIO WHERE username='$username'");
        $res=$stmt->fetch_assoc();

        return $res['imagen'];
    }


    /**
     * @param $username
     * @param $passNueva
     * @return bool
     *
     *Actualiza la password de un usuario.
     *TODO: Esta función no seria necesaria, lo correcto seria usar objetos y el setter de Pass. y luego realizar el update.
     *
     */
    public function updatePass($idUsuario,$passNueva) {

        $stmt = $this->db->prepare("UPDATE USUARIO SET password=? WHERE idUsuario=?");
        $stmt->bind_param('ss', $passNueva, $idUsuario);
        $stmt->execute();
        $result = $stmt->error;

        $stmt->close();

        if ( !$result ) { return true; }

        return false;

    }
    
    public function getUsersByText($text, $maxResults){

        $result = [];
        
        if(empty($text))
            return json_encode(["suggestions"=>$result]);

        $stmt = $this->db->query("SELECT idUsuario, username, nombre, email
                                    FROM USUARIO
                                    WHERE nombre LIKE '%$text%'
                                    LIMIT $maxResults");

        while ($row = $stmt->fetch_assoc()) {
            $tempArray = array(
                'data' => $row['idUsuario'],
                'value' => $row['nombre']
                //'value' => utf8_encode($row['nombre'])
            );
            $result[] = $tempArray;
        }
        
        
        $result = json_encode(["suggestions"=>$result]);
        
        $stmt->close();

        return $result;

    }

    public function getAll(){

        $usuario = [];

        $stmt = $this->db->prepare("SELECT * FROM USUARIO");
        $stmt->execute();

        $stmt->bind_result($idUsuario,$username,$nombre,$email,$password,$imagen,$idioma,$borrado,$admin);

        while ($stmt->fetch()) {
            $usuario[] = new Usuario($idUsuario,$username,$nombre,$email,$password,$imagen,$idioma,$borrado,$admin);
        }

        $stmt->close();

        return $usuario;

    }

    public function getNumUsers() {


        $sql = "SELECT COUNT(*) as total FROM USUARIO";
        $stmt = $this->db->query($sql);
        $res = $stmt->fetch_assoc();
        $stmt->close();

        return $res['total'];



    }


}
