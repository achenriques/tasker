<?php

/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 12/12/15
 * Time: 9:03
 */

require_once(__DIR__ . "/../modelos/PDOConnection.php");
require_once(__DIR__ . "/../clases/Grupo.php");

class GrupoMapper
{


    private $db;

    public function __construct(){
        $this->db= PDOConnection::getInstance();
    }

    public function add(Grupo $grupo){


        $nombre     = $grupo->getNombreGrupo();
        $descripcion= $grupo->getDescripcionGrupo();
        $visibilidad= $grupo->getVisibilidad();
        $calendario= $grupo->getCalendario();

        $stmt = $this->db->prepare("INSERT INTO GRUPO(nombreGrupo, descripcionGrupo, visibilidad,calendario) VALUES (?, ?, ?,?)");
        $stmt->bind_param('ssii', $nombre, $descripcion, $visibilidad,$calendario);
        $stmt->execute();

        /* Esto se hace para recuperar el autoincrementado del grupo creado */
        $last_insert = $this->db->insert_id;
        /* Recoge el error de la consulta. Si está vacio la consulta fue bien, en caso contrario no*/
        $result = $stmt->error;
        $stmt->close();

        //Ya de paso, si todo va bien devolvemos el id del grupo creado, para su uso por el Controlador
        return !$result ? $last_insert : false;
        //if ( !$result ) { return $last_insert; }
        //return false;
    }

    public function update(Grupo $grupo){

        $id         = $grupo->getIdGrupo();
        $nombre     = $grupo->getNombreGrupo();
        $descripcion= $grupo->getDescripcionGrupo();
        $visibilidad= $grupo->getVisibilidad();

        $stmt = $this->db->prepare("UPDATE GRUPO SET nombreGrupo = ?, descripcionGrupo = ?, visibilidad = ? WHERE idGrupo = ?");
        $stmt->bind_param('ssii', $nombre, $descripcion, $visibilidad, $id);
        $stmt->execute();

        /* Recoge el error de la consulta. Si está vacio la consulta fue bien, en caso contrario no*/
        $result = $stmt->error;
        $stmt->close();
        return !$result;
        //if ( !$result ) { return true; }
        //return false;
    }

    public function checkValidGrupo(Grupo $grupo){
        $nombreG=$grupo->getNombreGrupo();
        $stmt=$this->db->query("SELECT * FROM GRUPO ");
        if($stmt!=false) {
            while ($grupos = $stmt->fetch_assoc()) {
                if ($grupos['nombreGrupo'] == $nombreG) {
                    return false;
                }
            }
        }
        return true;
    }
    // Función obtener todos los grupos
    public function getAll(){

        $grupoarray = [];
        $stmt = $this->db->prepare("SELECT * FROM GRUPO");
        $stmt->execute();

        $stmt->bind_result($idGrupo, $nombreGrupo, $descripcionGrupo, $visibilidad, $calendario);

        while ($stmt->fetch()) {
            $grupoarray[] = new Grupo ($idGrupo, $nombreGrupo, $descripcionGrupo, $visibilidad, $calendario);
        }

        $stmt->close();

        return $grupoarray;

    }

    public function getAllMyGrupos($idUsuario) {

        $grupoarray = [];
        $stmt = $this->db->prepare("SELECT GRUPO.* FROM GRUPO JOIN USUARIO_GRUPO ON USUARIO_GRUPO.idGrupo = GRUPO.idGrupo WHERE USUARIO_GRUPO.admin = 1 AND USUARIO_GRUPO.idUsuario = ?");
        $stmt->bind_param('i', $idUsuario);
        $stmt->execute();

        $stmt->bind_result($idGrupo, $nombreGrupo, $descripcionGrupo, $visibilidad, $calendario);

        while ($stmt->fetch()) {
            $grupoarray[] = new Grupo ($idGrupo, $nombreGrupo, $descripcionGrupo, $visibilidad, $calendario);
        }

        $stmt->close();

        return $grupoarray;


    }

    public function getDatosGrupo($id){

        $stmt = $this->db->prepare("SELECT *
                                    FROM GRUPO
                                    WHERE idGrupo = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($idGrupo,$nombreGrupo,$descripcionGrupo,$visibilidad,$calendario);
        $stmt->fetch();
        $stmt->close();

        $dato = new Grupo($idGrupo,$nombreGrupo,$descripcionGrupo,$visibilidad,$calendario);

        return $dato;
    }

    /*
    // Función obtener asociados grupos con miembros
    public function getAllMembers(){

        $stmt = $this->db->prepare("SELECT nombreGrupo, rol FROM GRUPO, USUARIO_GRUPO, USUARIO
                                    WHERE GRUPO.idGrupo=USUARIO_GRUPO.idGrupo AND USUARIO.idUsuario=USUARIO_GRUPO.idUsuario");
        $stmt->execute();

        $stmt->bind_result($nombregrup, $rol);

        while ($stmt->fetch()) {
            $miembroarray[] = new Miembro ($nombregrup, $rol);
        }

        $stmt->close();

        return $miembroarray;

    }
    */

    //Función mostrar grupo del usuario logueado en el sistema
    public function getGroupUser($idUser)
    {
        $grupoarray2 = [];

        /*$sql = "SELECT GRUPO.idGrupo, nombreGrupo, descripcionGrupo, visibilidad
                FROM GRUPO
                LEFT JOIN USUARIO_GRUPO ON USUARIO_GRUPO.idGrupo = GRUPO.idGrupo
                WHERE idUsuario = ?";
        $stmt = $this->db->prepare($sql);*/

        //A pesares de que funciona, as anidadas non son indicadas. Non funciionaba, uso JOIN.
        /*$stmt = $this->db->prepare("SELECT *
                                    FROM GRUPO
                                    WHERE idGrupo = (SELECT idGrupo
                                                     FROM USUARIO_GRUPO WHERE idUsuario=?)");*/

        $stmt = $this->db->prepare("SELECT GRUPO.* FROM GRUPO JOIN USUARIO_GRUPO ON USUARIO_GRUPO.idGrupo = GRUPO.idGrupo WHERE USUARIO_GRUPO.idUsuario=?");

        $stmt->bind_param('i', $idUser);
        $stmt->execute();

        $stmt->bind_result($idGrupo, $nombreGrupo, $descripcionGrupo, $visibilidad, $calendario);

        while ($stmt->fetch()) {
            $grupoarray2[] = new Grupo ($idGrupo, $nombreGrupo, $descripcionGrupo, $visibilidad, $calendario);
            //Coidado co nome das variables!!!!!!!    $grupoarray2 != $grouparray2
            //$grouparray2[] = new Grupo ($idGrupo, $nombreGrupo, $descripcionGrupo, $visibilidad);
        }

        $stmt->close();
        return $grupoarray2;
    }

    //Función mostrar usuarios asignados a un grupo en concreto
    public function getUsuariosGroup($idGroup)
    {

        $usersarray=[];
        $stmt = $this->db->prepare("SELECT USUARIO.*
                                    FROM USUARIO, GRUPO, USUARIO_GRUPO
                                    WHERE GRUPO.idGrupo=USUARIO_GRUPO.idGrupo
                                    AND USUARIO.idUsuario=USUARIO_GRUPO.idUsuario
                                    AND USUARIO_GRUPO.idGrupo=$idGroup");
        $stmt->execute();

        $stmt->bind_result($idUser, $nick, $nombre, $email, $password, $imagen, $idioma,$borrado, $admin);

        while ($stmt->fetch()) {
            $usersarray[] = new Usuario ($idUser, $nick, $nombre, $email, $password, $imagen, $idioma,$borrado, $admin);
        }

        $stmt->close();

        return $usersarray;

    }


    //Función borrar grupo
    public function delete($idgrupo) {
        $resultado=false;
        $stmt = $this->db->prepare("SELECT USUARIO_GRUPO.idUsuario FROM GRUPO, USUARIO_GRUPO
                                    WHERE GRUPO.idGrupo=USUARIO_GRUPO.idGrupo AND GRUPO.idGrupo=?");
        $stmt->bind_param('i', $idgrupo);
        $stmt->execute();
        $result = $stmt->num_rows;
        $stmt->close();
        if ( $result > 0) {
            $resultado=false;
        } else {
            $stmt = $this->db->prepare("DELETE FROM GRUPO WHERE idGrupo=?");
            $stmt->bind_param('i', $idgrupo);
            $stmt->execute();
            $result = $stmt->error;
            $stmt->close();
            if ( !$result ) { $resultado=true; }
        }
        return $resultado;
    }

    //Rober: asigna usuario a grupo con el rol indicado
    public function asignaUsuario($idGrupo,$idUsuario,$admin){

        $stmt = $this->db->prepare("INSERT INTO USUARIO_GRUPO(idGrupo, idUsuario, admin) VALUES (?,?,?)");
        $stmt->bind_param('iii', $idGrupo,$idUsuario,$admin);
        $stmt->execute();
        $result = $stmt->error;
        $stmt->close();
        if ( !$result ) { return true; }
        return false;

}

    //Rober: de-asigna usuario de grupo.
    public function deasignaUsuario($idGrupo,$idUsuario){

        $stmt = $this->db->prepare("DELETE FROM USUARIO_GRUPO WHERE idGrupo=? AND idUsuario=?");
        $stmt->bind_param('ii', $idGrupo,$idUsuario);
        $stmt->execute();
        $result = $stmt->error;
        $stmt->close();
        if ( !$result ) { return true; }
        return false;

    }

    //Comprueba si el usuario es admin del grupo.

    public function  esAdminGrupo($idUsuario,$idGrupo) {


        $admin = 1;
        $stmt = $this->db->prepare("SELECT * FROM USUARIO_GRUPO WHERE idGrupo=? AND idUsuario=? AND admin=?");
        $stmt->bind_param('iii', $idGrupo,$idUsuario,$admin);
        $stmt->execute();
        $res=$stmt->fetch();

        $stmt->close();

        if (sizeof($res) > 0) {

            return true;

        }

        else {

            return false;

        }


    }

    //Comprueba si un usuario pertenece al grupo
    public function  isInGrupo($idUsuario,$idGrupo) {


        $stmt = $this->db->prepare("SELECT * FROM USUARIO_GRUPO WHERE idGrupo=? AND idUsuario=?");
        $stmt->bind_param('ii', $idGrupo,$idUsuario);
        $stmt->execute();
        $res=$stmt->fetch();

        $stmt->close();

        if (sizeof($res) > 0) {

            return true;

        }

        else {

            return false;

        }


    }

    //Añade miembro al grupo y le asigna el calendario al usuario rol que tiene en el grupo.
    public function addMiembros($idGrupo,$idCalendario,$idUsuario,$admin) {


        $sql="insert into USUARIO_GRUPO (idGrupo, idUsuario,admin) values(?,?,?)";

        $stmt=$this->db->prepare($sql);
        $stmt->bind_param('iii', $idGrupo,$idUsuario,$admin);
        $stmt->execute();
        $result = $stmt->error;
        $stmt->close();

        $sql2="insert into USUARIO_CALENDARIO(idUsuario, idCalendario) values (?,?)";
        $stmt=$this->db->prepare($sql2);
        $stmt->bind_param('ii', $idUsuario,$idCalendario);
        $stmt->execute();
        $result2 = $stmt->error;
        $stmt->close();


        if ( !$result && !$result2 ) { return true; }
        return false;

    }

    public function getAllPublic(){

        $grupoarray = [];
        $stmt = $this->db->prepare("SELECT * FROM GRUPO WHERE GRUPO.visibilidad=2");
        $stmt->execute();

        $stmt->bind_result($idGrupo, $nombreGrupo, $descripcionGrupo, $visibilidad, $calendario);

        while ($stmt->fetch()) {
            $grupoarray[] = new Grupo ($idGrupo, $nombreGrupo, $descripcionGrupo, $visibilidad, $calendario);
        }

        $stmt->close();

        return $grupoarray;

    }

    public function getNumGrupos() {


        $sql = "SELECT COUNT(*) as total FROM GRUPO";
        $stmt = $this->db->query($sql);
        $res = $stmt->fetch_assoc();
        $stmt->close();

        return $res['total'];



    }

}