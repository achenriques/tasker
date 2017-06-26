<?php

/**
 * Created by IntelliJ IDEA.
 * User: rbr
 * Date: 23/12/15
 * Time: 20:50
 */

require_once(__DIR__ . "/../modelos/PDOConnection.php");
require_once(__DIR__ . "/../clases/Reunion.php");

class ReunionMapper
{
    private $db;

    public function __construct(){
        $this->db= PDOConnection::getInstance();
    }


    public function add(Reunion $reunion) {

        $idGrupo = $reunion->getIdGrupo();
        $fechaReunion = $reunion->getFechaReunion();
        $estadoReunion = $reunion->getEstadoReunion();

        $stmt = $this->db->prepare("INSERT INTO REUNION(idGrupo,fechaReunion,estadoReunion) VALUES (?, ?, ?)");
            $stmt->bind_param('isi', $idGrupo,$fechaReunion,$estadoReunion);
            $stmt->execute();

            /* Esto se hace para recuperar el autoincrementado de la reunion creada */
            $last_insert = $this->db->insert_id;
            /* Recoge el error de la consulta. Si está vacio la consulta fue bien, en caso contrario no*/
            $result = $stmt->error;
            $stmt->close();

            //Ya de paso, si to do va bien devolvemos el id de la reunion creada, para su uso por el Controlador
            //return !$result ? $last_insert : false;
            if ( !$result ) { return $last_insert; }
            return false;

    }

    public function delete($id){

        $stmt = $this->db->prepare("DELETE FROM REUNION WHERE idReunion = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->error;
        $stmt->close();

        return !$result;
    }

    //Función mostrar usuarios asignados a un grupo en concreto
    public function getReunionesGrupo($idGrupo)
    {

        $reuniones=[];
        $stmt = $this->db->prepare("SELECT REUNION.* FROM REUNION WHERE idGrupo=? ORDER BY REUNION.fechaReunion");
        $stmt->bind_param('i', $idGrupo);
        $stmt->execute();

        $stmt->bind_result($idReunion,$idGrupo,$fechaReunion,$acta,$estadoReunion);

        while ($stmt->fetch()) {
            $reuniones[] = new Reunion($idReunion,$idGrupo,$fechaReunion,$acta,$estadoReunion);
        }

        $stmt->close();

        return $reuniones;

    }

    //Cambia el estado de una reunion: 0 -> propuesta, 1 -> confirmada, 2 -> realizada, 3-> cancelada

    public function setEstado(Reunion $reunion) {

        $idReunion=$reunion->getIdReunion();
        $estadoReunion=$reunion->getEstadoReunion();
        $stmt = $this->db->prepare("UPDATE REUNION SET estadoReunion=? WHERE idReunion=?");
        $stmt->bind_param('ii', $estadoReunion,$idReunion);
        $stmt->execute();
        $result = $stmt->error;
        $stmt->close();
        return !$result ? true : false;

    }

    //Asigna el acta
    public function setActa(Reunion $reunion) {

        $idActa=$reunion->getActa();
        $idReunion=$reunion->getIdReunion();
        $stmt = $this->db->prepare("UPDATE REUNION SET acta=? WHERE idReunion=?");
        $stmt->bind_param('ii', $idActa,$idReunion);
        $stmt->execute();
        $result = $stmt->error;
        $stmt->close();
        return !$result ? true : false;

    }
    //Actualiza la fecha de la reunion.
    public function updateFecha(Reunion $reunion) {

        $idReunion=$reunion->getIdReunion();
        $fechaReunion=$reunion->getFechaReunion();

        $stmt = $this->db->prepare("UPDATE REUNION SET fechaReunion=? WHERE idReunion=?");
        $stmt->bind_param('si', $fechaReunion,$idReunion);
        $stmt->execute();
        $result = $stmt->error;
        $stmt->close();
        return !$result ? true : false;

    }

    public function getDatosReunion($id){

        $stmt = $this->db->prepare("SELECT *
                                    FROM REUNION
                                    WHERE idReunion = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($idReunion,$idGrupo,$fechaReunion,$acta,$estadoReunion);
        $stmt->fetch();
        $stmt->close();

        $datos = new Reunion($idReunion,$idGrupo,$fechaReunion,$acta,$estadoReunion);

        return $datos;
    }


}