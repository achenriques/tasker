<?php

/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 12/12/15
 * Time: 13:05
 */

require_once(__DIR__ . "/../modelos/PDOConnection.php");

class CalendarioMapper
{

    private $db;

    public function __construct(){
        $this->db= PDOConnection::getInstance();
    }


    /**
     * @param $calendario
     *
     * Crea un calendario y devuelve su id.
     */
    public function add(Calendario $calendario) {

        $nombreCalendario = $calendario->getNombreCalendario();
        $colorCalendario = $calendario->getColor();

        $stmt = $this->db->prepare("INSERT INTO CALENDARIO (nombreCalendario, color) VALUES (?, ?)");
        $stmt->bind_param('ss', $nombreCalendario,$colorCalendario);
        $stmt->execute();

        //Recupero el ultimo Autoincrementado insertado//
        $last_insert = $this->db->insert_id;


        $stmt->close();
        if ( $last_insert ) { return $last_insert; }

        return false;

    }

    /**
     * @param Calendario $calendario
     * @return bool
     *
     * Actualiza Calendario.
     */
    public function update(Calendario $calendario) {

        $nombreCalendario = $calendario->getNombreCalendario();
        $colorCalendario = $calendario->getColor();
        $idCalendario = $calendario->getIdCalendario();

        $stmt = $this->db->prepare("UPDATE CALENDARIO SET nombreCalendario=?, color=? WHERE idCalendario=?");
        $stmt->bind_param('ssi', $nombreCalendario,$colorCalendario,$idCalendario);
        $stmt->execute();
        $res = $stmt->error;

        $stmt->close();
        if ( !$res ) { return true; }

        return false;

    }

    public function getCalendarios($idUsuario){

            $calendarios=[];
            /*$stmt = $this->db->prepare("SELECT CALENDARIO.*
                                        FROM CALENDARIO
                                        JOIN CALENDARIO_TAREA
                                              ON CALENDARIO_TAREA.idCalendario = CALENDARIO.idCalendario
                                        JOIN USUARIO_TAREA
                                              ON USUARIO_TAREA.idUsuario = ?
                                        GROUP BY idCalendario;");*/

        $stmt = $this->db->prepare("SELECT CALENDARIO.*
                                    FROM CALENDARIO
                                      JOIN USUARIO_CALENDARIO
                                        ON USUARIO_CALENDARIO.idCalendario = CALENDARIO.idCalendario AND USUARIO_CALENDARIO.idUsuario = ?");
        $stmt->bind_param('i', $idUsuario);

        $stmt->execute();

            $stmt->bind_result($idCalendario,$nombreCalendario,$color);

            while ($stmt->fetch()) {

                $calendario = new Calendario(null,$nombreCalendario,$color);
                $calendario->setIdCalendario($idCalendario);

                $calendarios[] = $calendario;
            }

            $stmt->close();

            return $calendarios;




    }


    public function asignaCalendario(Calendario $calendario,$idUsuario) {

        $idCalendario = $calendario->getIdCalendario();
        $stmt = $this->db->prepare("INSERT INTO USUARIO_CALENDARIO(idUsuario, idCalendario) VALUES (?,?)");
        $stmt->bind_param('ii',$idUsuario,$idCalendario);
        $stmt->execute();
        $res = $stmt->error;

        $stmt->close();
        if ( !$res ) { return true; }

        return false;


    }

    public function getDatosCalendario($id){

        $stmt = $this->db->prepare("SELECT idCalendario,nombreCalendario,color
                                    FROM CALENDARIO
                                    WHERE idCalendario=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($idCalendario,$nombreCalendario,$color);
        $stmt->fetch();
        $stmt->close();
        $calendario = new Calendario($idCalendario,$nombreCalendario,$color);
        return $calendario;
    }

    public function delete($idCalendario){

        //Usar on cascade

        /*$sql = "DELETE FROM CALENDARIO WHERE CALENDARIO.idCalendario=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $idCalendario);
        $stmt->execute();
        $res = $stmt->error;
        $stmt->close();*/



        //comprobamos que no tenga ninguna tarea ese Calendario.

            $sql2 = "SELECT CALENDARIO_TAREA.idTarea FROM CALENDARIO_TAREA WHERE CALENDARIO_TAREA.idCalendario = ?";
            $stmt = $this->db->prepare($sql2);
            $stmt->bind_param('i', $idCalendario);
            $stmt->execute();
            $res2 = $stmt->fetch();
            $stmt->close();
            if (sizeof($res2) > 0) { return 1; /*Tiene Tareas*/} else {

                //No tiene tareas, borramos primero de la tabla CALENDARIO_TAREA

                $sql2 = "DELETE FROM CALENDARIO_TAREA WHERE CALENDARIO_TAREA.idCalendario=?";
                $stmt = $this->db->prepare($sql2);
                $stmt->bind_param('i', $idCalendario);
                $stmt->execute();
                $res2 = $stmt->error;
                $stmt->close();
                if ($res2) { return 2; /*Error al Borrar*/} else {

                    //Seguimos borrando en la tabla USUARIO_CALENDARIO.

                    $sql3 = "DELETE FROM USUARIO_CALENDARIO WHERE USUARIO_CALENDARIO.idCalendario=?";
                    $stmt = $this->db->prepare($sql3);
                    $stmt->bind_param('i', $idCalendario);
                    $stmt->execute();
                    $res3 = $stmt->error;
                    $stmt->close();
                    if ($res3) { return 2; /*Error al Borrar*/} else {

                        // Seguimos borrando a tutiplen

                        $sql4 = "DELETE FROM CALENDARIO WHERE CALENDARIO.idCalendario=?";
                        $stmt = $this->db->prepare($sql4);
                        $stmt->bind_param('i', $idCalendario);
                        $stmt->execute();
                        $res4 = $stmt->error;
                        $stmt->close();
                        if ($res4) { error_log($res4,0);return 2; /*Error de Borrado*/}

                        else
                        {

                            return 0; /*Exito */

                        }



                    }



                }




            }


        }


    public function getNumTareas($idCalendario) {


        //$sql = "SELECT * FROM TAREA JOIN CALENDARIO_TAREA ON CALENDARIO_TAREA.idTarea = TAREA.idTarea WHERE CALENDARIO_TAREA.idCalendario=?";

        $sql = "SELECT COUNT(*) as total FROM CALENDARIO_TAREA WHERE idCalendario=$idCalendario";
        $stmt = $this->db->query($sql);
        $res = $stmt->fetch_assoc();
        $stmt->close();

        return $res['total'];



    }


    public function calIsFromGroup($idCalendario) {

        $stmt = $this->db->prepare("SELECT * FROM GRUPO WHERE GRUPO.Calendario = ?");
        $stmt->bind_param('i', $idCalendario);
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

    public function getGroupByCal($idCalendario) {

        $stmt = $this->db->prepare("SELECT *
                                    FROM GRUPO
                                    WHERE calendario = ?");
        $stmt->bind_param('i', $idCalendario);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($idGrupo,$nombreGrupo,$descripcionGrupo,$visibilidad,$calendario);
        $stmt->fetch();
        $stmt->close();

        $dato = new Grupo($idGrupo,$nombreGrupo,$descripcionGrupo,$visibilidad,$calendario);

        return $dato;


    }




}