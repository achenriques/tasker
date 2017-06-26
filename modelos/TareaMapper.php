<?php

/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 12/12/15
 * Time: 9:02
 */

require_once(__DIR__ . "/../modelos/PDOConnection.php");
require_once(__DIR__ . "/../clases/Tarea.php");
//require_once(__DIR__ . "/../modelos/EstadoMapper.php");
require_once(__DIR__ . "/../modelos/DocumentoMapper.php");

class TareaMapper
{

    private $db;

    public function __construct(){
        $this->db = PDOConnection::getInstance();
    }

    /**
     * @param Tarea $tarea
     * @param $id_calendario
     * @return bool
     *
     * Inserta la tarea y la añade al calendario indicado.
     *
     */
    public function add(Tarea $tarea,$idCalendario){

        $codTarea = $tarea->getCodTarea();
        $nombreTarea = $tarea->getNombreTarea();
        $descripcionTarea = $tarea->getDescripcionTarea();
        $tareaPadre  = $tarea->getTareaPadre();
        $estadoTarea = $tarea->getEstadoTarea();
        $fechaEstIni = $tarea->getFechaEstIni();
        $fechaEstFin = $tarea->getFechaEstFin();
        $fechaRealIni = $tarea->getFechaRealIni();
        $fechaRealFin = $tarea->getFechaRealFin();

        $stmt = $this->db->prepare("INSERT INTO TAREA (codTarea,nombreTarea,descripcionTarea,tareaPadre,estadoTarea,fechaEstIni,fechaEstFin,fechaRealIni,fechaRealFin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssiissss', $codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin);
        $stmt->execute();
        $res1 = $stmt->error;

        /* Esto se hace para recuperar el autoincrementado de la tarea insertada */
        $last_insert = $this->db->insert_id;

        $stmt = $this->db->prepare("INSERT INTO CALENDARIO_TAREA (idCalendario, idTarea) VALUES (?, ?)");
        $stmt->bind_param('ii', $idCalendario,$last_insert);
        $stmt->execute();
        $res2 = $stmt->error;

        $stmt->close();
        if ( !$res1 && !$res2 ) { return true; }

        return false;
    }

    //Comproba que no exista una tarea con ese codigo
    public function existsCodTarea($cod, $id = null){
        $id = is_null($id) ? -1 : $id;

        $stmt = $this->db->prepare("SELECT * FROM TAREA WHERE codTarea = ? AND NOT idTarea = ?");
        $stmt->bind_param('si', $cod, $id);
        $stmt->execute();
        $stmt->store_result();
        $res = $stmt->num_rows > 0 ? true : false;
        
        //die("[".$stmt->num_rows."]");
        $stmt->close();
        
        return $res;
    }
    
    /**
     * @param Tarea $tarea
     * @param $id_calendario
     * @return bool
     *
     * Actualiza la tarea y modifica el calendario asociado.
     *
     */
    public function update(Tarea $tarea){
        
        $idTarea = $tarea->getIdTarea();
        $codTarea = $tarea->getCodTarea();
        $nombreTarea = $tarea->getNombreTarea();
        $descripcionTarea = $tarea->getDescripcionTarea();
        $tareaPadre  = $tarea->getTareaPadre();
        $estadoTarea = $tarea->getEstadoTarea();
        $fechaEstIni = $tarea->getFechaEstIni();
        $fechaEstFin = $tarea->getFechaEstFin();
        $fechaRealIni = $tarea->getFechaRealIni();
        $fechaRealFin = $tarea->getFechaRealFin();
                   
        $stmt = $this->db->prepare("UPDATE TAREA SET codTarea=?,nombreTarea=?,descripcionTarea=?,tareaPadre=?,estadoTarea=?,fechaEstIni=?,fechaEstFin=?,fechaRealIni=?,fechaRealFin=? WHERE idTarea=?");
        $stmt->bind_param('sssiissssi', $codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin,$idTarea);
        $stmt->execute();
        //$res1 = $stmt->error;
        
        /* Recoge el error de la consulta. Si está vacio la consulta fue bien, en caso contrario no*/
        $result = $stmt->error;
        $stmt->close();
        if ( !$result ) { return true; }
 
        return false;        
    }
    
    /**
     * @param $id
     * @return Tarea
     *
     * Devuelve un array con los datos de la tarea dada por su id.
     *
     */
    public function getDatosTarea($id){

        $stmt = $this->db->prepare("SELECT idTarea,codTarea,nombreTarea,descripcionTarea,tareaPadre,estadoTarea,fechaEstIni,fechaEstFin,fechaRealIni,fechaRealFin
                                    FROM TAREA
                                    WHERE idTarea=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
         
        $stmt->bind_result($idTarea,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin);
        $stmt->fetch();
        $stmt->close();



        $tarea = new Tarea($idTarea,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin);
        $tarea->setSubTareas($this->getSubTareas($id));

        //$docs = (new DocumentoMapper())->getDocsByTarea($id);
        //$tarea->setDocumentos($docs);
        $tarea->setDocumentos($this->getDocumentos($id));

        return $tarea;
    }
    
    public function getAll(){

        $sql = "SELECT TAREA.idTarea,codTarea,nombreTarea,descripcionTarea,tareaPadre,estadoTarea,fechaEstIni,fechaEstFin,fechaRealIni,fechaRealFin,
                idEstado,codEstado,nombreEstado
                FROM TAREA 
                LEFT JOIN ESTADO ON ESTADO.idEstado = TAREA.estadoTarea
                ";                
        
        $stmt = $this->db->prepare($sql);    
                
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;

        $stmt->bind_result($idTarea,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin,
                $idEstado,$codEstado,$nombreEstado
                );
        
        $tareas = [];
        while ($stmt->fetch()) {   
            $estado = new Estado($idEstado,$codEstado,$nombreEstado);
            $tarea = new Tarea($idTarea,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin);
            $tarea->setEstado($estado);
            //$tarea->setPadre($this->getDatosTarea($tarea->getTareaPadre()));
            //$tarea->setSubTareas($this->getSubTareas($tarea->getIdTarea()));
            $tarea->setDocumentos($this->getDocumentos($idTarea));
            $tareas[] = $tarea;
        }
        
        $stmt->close();

        return $tareas;
    }
    
    public function getSubTareas($id){

        $sql = "SELECT TAREA.idTarea,codTarea,nombreTarea,descripcionTarea,tareaPadre,estadoTarea,fechaEstIni,fechaEstFin,fechaRealIni,fechaRealFin,
                idEstado,codEstado,nombreEstado
                FROM TAREA
                LEFT JOIN ESTADO ON ESTADO.idEstado = TAREA.estadoTarea
                WHERE tareaPadre = ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        
        $tareas = [];
        
        $stmt->bind_result($idTarea,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin,
                $idEstado,$codEstado,$nombreEstado);
        while ($stmt->fetch()) {   
            $estado = new Estado($idEstado,$codEstado,$nombreEstado);
            $tarea = new Tarea($idTarea,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin);
            $tarea->setEstado($estado);
            $tareas[] = $tarea;
        }
        
        $stmt->close();

        return $tareas;
    }

    /**
     * @param $idUsuario
     *
     * Devuelve las tareas del usuario indicado por idUsuario.
     * @return $res
     */

    public function getTareasUsuario($idUsuario, $estado = 0)
    {
        
    
        $sql = "SELECT TAREA.idTarea,codTarea,nombreTarea,descripcionTarea,tareaPadre,estadoTarea,fechaEstIni,fechaEstFin,fechaRealIni,fechaRealFin,
                idEstado,codEstado,nombreEstado,
                idUsuario,
                CALENDARIO.idCalendario,nombreCalendario,color
                FROM TAREA 
                LEFT JOIN ESTADO ON ESTADO.idEstado = TAREA.estadoTarea
                LEFT JOIN CALENDARIO_TAREA ON CALENDARIO_TAREA.idTarea = TAREA.idTarea
                LEFT JOIN USUARIO_CALENDARIO ON USUARIO_CALENDARIO.idCalendario = CALENDARIO_TAREA.idCalendario 
                LEFT JOIN CALENDARIO ON CALENDARIO.idCalendario = USUARIO_CALENDARIO.idCalendario
                WHERE  USUARIO_CALENDARIO.idUsuario = ?";
        
        if($estado>0)
            $sql .= " AND ESTADO.idEstado = $estado";
        
        $sql .= " ORDER BY fechaEstIni";        
        
        
        $stmt = $this->db->prepare($sql);    
        
        $stmt->bind_param("i", $idUsuario);
        
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;

        $stmt->bind_result($idTarea,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin,
                $idEstado,$codEstado,$nombreEstado,
                $idUsuario,
                $idCalendario,$nombreCalendario,$color
                );
        
        $tareas = [];
        while ($stmt->fetch()) {   
            $estado = new Estado($idEstado,$codEstado,$nombreEstado);
            $calendario = new Calendario($idCalendario,$nombreCalendario,$color);
            $tarea = new Tarea($idTarea,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin);
            $tarea->setEstado($estado);
            $tarea->setCalendario($calendario);
            $tarea->setPadre($this->getDatosTarea($tarea->getTareaPadre()));
            //$tarea->setSubTareas($this->getSubTareas($tarea->getIdTarea()));
            $tarea->setDocumentos($this->getDocumentos($idTarea));
            $tareas[] = $tarea;
        }
        
        $stmt->close();

        return $tareas;
    }

    public function setFinTareas($id){

        $stmt = $this->db->prepare("UPDATE TAREA SET estadoTarea=4 WHERE idTarea=?"); //Comprobar cual es el numero de estado de tarea finalizada
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->error;
        $stmt->close();
        if ( !$result ) { return true; }

        return false;
    }

    public function eliminarTarea($id){

        $stmt = $this->db->prepare("DELETE FROM TAREA WHERE idTarea=?"); //Comprobar delete on cascade en la base de datos
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->error;
        $stmt->close();
        
        if ( !$result ) { return true; }

        return false;
    }

    protected function getDocumentos($id){
        $docs = (new DocumentoMapper())->getDocsByTarea($id);
        //$tarea->setDocumentos($docs);
        return $docs;
    }

    public function getTareasByCal($idUsuario,$idCalendario,$estado) {


        $sql = "SELECT TAREA.idTarea,codTarea,nombreTarea,descripcionTarea,tareaPadre,estadoTarea,fechaEstIni,fechaEstFin,fechaRealIni,fechaRealFin,
                idEstado,codEstado,nombreEstado,
                idUsuario,
                CALENDARIO.idCalendario,nombreCalendario,color
                FROM TAREA
                LEFT JOIN ESTADO ON ESTADO.idEstado = TAREA.estadoTarea
                LEFT JOIN CALENDARIO_TAREA ON CALENDARIO_TAREA.idTarea = TAREA.idTarea
                LEFT JOIN USUARIO_CALENDARIO ON USUARIO_CALENDARIO.idCalendario = CALENDARIO_TAREA.idCalendario
                LEFT JOIN CALENDARIO ON CALENDARIO.idCalendario = USUARIO_CALENDARIO.idCalendario
                WHERE  USUARIO_CALENDARIO.idUsuario = ? AND USUARIO_CALENDARIO.idCalendario=?";

        if($estado>0)
            $sql .= " AND ESTADO.idEstado = $estado";

        $sql .= " ORDER BY fechaEstIni";


        $stmt = $this->db->prepare($sql);

        $stmt->bind_param("ii", $idUsuario,$idCalendario);

        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;

        $stmt->bind_result($idTarea,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin,
            $idEstado,$codEstado,$nombreEstado,
            $idUsuario,
            $idCalendario,$nombreCalendario,$color
        );

        $tareas = [];
        while ($stmt->fetch()) {
            $estado = new Estado($idEstado,$codEstado,$nombreEstado);
            $calendario = new Calendario($idCalendario,$nombreCalendario,$color);
            $tarea = new Tarea($idTarea,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin);
            $tarea->setEstado($estado);
            $tarea->setCalendario($calendario);
            $tarea->setPadre($this->getDatosTarea($tarea->getTareaPadre()));
            //$tarea->setSubTareas($this->getSubTareas($tarea->getIdTarea()));
            $tarea->setDocumentos($this->getDocumentos($idTarea));
            $tareas[] = $tarea;
        }

        $stmt->close();

        return $tareas;



    }

    public function getTareasGrupo($idCalendario,$estado) {


        $sql = "SELECT TAREA.idTarea,codTarea,nombreTarea,descripcionTarea,tareaPadre,estadoTarea,fechaEstIni,fechaEstFin,fechaRealIni,fechaRealFin,
  idEstado,codEstado,nombreEstado,
  CALENDARIO.idCalendario,nombreCalendario,color
FROM TAREA
  LEFT JOIN ESTADO ON ESTADO.idEstado = TAREA.estadoTarea
  LEFT JOIN CALENDARIO_TAREA ON CALENDARIO_TAREA.idTarea = TAREA.idTarea
  LEFT JOIN CALENDARIO ON CALENDARIO_TAREA.idCalendario = CALENDARIO.idCalendario
WHERE CALENDARIO_TAREA.idCalendario=?";

        if($estado>0)
            $sql .= " AND ESTADO.idEstado = $estado";

        $sql .= " ORDER BY fechaEstIni";


        $stmt = $this->db->prepare($sql);

        $stmt->bind_param("i", $idCalendario);

        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;

        $stmt->bind_result($idTarea,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin,
            $idEstado,$codEstado,$nombreEstado, $idCalendario,$nombreCalendario,$color
        );

        $tareas = [];
        while ($stmt->fetch()) {
            $estado = new Estado($idEstado,$codEstado,$nombreEstado);
            $calendario = new Calendario($idCalendario,$nombreCalendario,$color);
            $tarea = new Tarea($idTarea,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin);
            $tarea->setEstado($estado);
            $tarea->setCalendario($calendario);
            $tarea->setPadre($this->getDatosTarea($tarea->getTareaPadre()));
            //$tarea->setSubTareas($this->getSubTareas($tarea->getIdTarea()));
            $tarea->setDocumentos($this->getDocumentos($idTarea));
            $tareas[] = $tarea;
        }

        $stmt->close();

        return $tareas;



    }

    public function getNumAllTareas() {


        $sql = "SELECT COUNT(*) as total FROM TAREA";
        $stmt = $this->db->query($sql);
        $res = $stmt->fetch_assoc();
        $stmt->close();

        return $res['total'];



    }




}