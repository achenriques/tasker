<?php

/**
 * Created by NetBeans.
 * User: aouteiral
 * Date: 19/12/15
 * Time: 15:58
 */

require_once(__DIR__ . "/../modelos/PDOConnection.php");

class NotificacionMapper
{

    private $db;
    
    const TABLE = "NOTIFICACION";

    public function __construct(){
        $this->db= PDOConnection::getInstance();
    }

    /**
     * @param $notificacion
     *
     * Crea una notificacion y devuelve su id.
     */
    public function add(Notificacion $notificacion) {

        $texto          = $notificacion->getTexto();
        $estado         = $notificacion->getEstado();
        $tipo           = $notificacion->getTipo();
        $destinatario   = $notificacion->getDestinatario();
        $remitente      = $notificacion->getRemitente();
        
        $sql = "INSERT INTO " . self::TABLE . " (textoNotif,estadoNotif,tipo,destinatario,remitente) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('siiii', $texto,Notificacion::$EST_ENVIADA,$tipo,$destinatario,$remitente);
        $stmt->execute();

        //Recupero el ultimo Autoincrementado insertado//
        $last_insert = $this->db->insert_id;

        $stmt->close();
        if ( $last_insert ) { return $last_insert; }

        return false;

    }

    public function getNotificacion($id){
        
        $sql = "SELECT idNotif,textoNotif,estadoNotif,tipo,destinatario,remitente,timestamp
                FROM " . self::TABLE . " WHERE idNotif = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
                
        //if ($stmt->num_rows == 0)
        //    return null;
        
        $stmt->bind_result($id,$texto,$estado,$tipo,$destinatario,$remitente,$timestamp);
        $stmt->fetch();
        $stmt->close();
        $notificacion = new Notificacion($id,$texto,$estado,$tipo,$destinatario,$remitente,$timestamp);
    
        return $notificacion;
    }
    
    public function getNotificacionesUsuario($idUsuario){

        $notificaciones = [];
        
        $sql = "SELECT idNotif,textoNotif,estadoNotif,tipo,destinatario,remitente,timestamp,nombre
                FROM " . self::TABLE . " 
                INNER JOIN USUARIO ON USUARIO.idUsuario = " . self::TABLE . ".remitente
                WHERE destinatario = ? AND estadoNotif < 3";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $idUsuario);

        $stmt->execute();

        $stmt->bind_result($id,$texto,$estado,$tipo,$destinatario,$remitente,$timestamp,$remitenteNombre);

        while ($stmt->fetch()) {

            $notificacion = new Notificacion($id,$texto,$estado,$tipo,$destinatario,$remitente,$timestamp);
            $notificacion->setRemitenteNombre($remitenteNombre);
                    
            $notificaciones[] = $notificacion;
        }

        $stmt->close();

        return $notificaciones;
        
    }    
    
    public function getAll(){

        $notificaciones = [];
        
        $sql = "SELECT idNotif,textoNotif,estadoNotif,tipo,destinatario,remitente,timestamp
                FROM " . self::TABLE ;

        $stmt = $this->db->prepare($sql);
        //$stmt->bind_param('i', $idUsuario);

        $stmt->execute();

        $stmt->bind_result($id,$texto,$estado,$tipo,$destinatario,$remitente,$timestamp);

        while ($stmt->fetch()) {

            $notificacion = new Notificacion($id,$texto,$estado,$tipo,$destinatario,$remitente,$timestamp);
            
            $notificaciones[] = $notificacion;
        }

        $stmt->close();

        return $notificaciones;
        
    }
    
    public function drop($id){
        
        $id = $_GET['id'];
        
        $sql = "UPDATE " . self::TABLE . " SET estadoNotif = ? WHERE idNotif = ?";
      
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', Notificacion::$EST_DESCARTADA, $id);
        $stmt->execute();
        
        /* Recoge el error de la consulta. Si está vacio la consulta fue bien, en caso contrario no*/
        $result = $stmt->error;
        $stmt->close();
        if ( !$result ) { return true; }
 
        return false;
    }

}