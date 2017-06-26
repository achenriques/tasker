<?php
/**
 * Created by IntelliJ IDEA.
 * User: Anxo
 * Date: 23/12/2015
 * Time: 12:01
 */
require_once(__DIR__ . "/../modelos/PDOConnection.php");
require_once(__DIR__ . "/../clases/Documento.php");

class DocumentoMapper{
    private $db;

    public function __construct(){

        $this->db = PDOConnection::getInstance();

    }

    public function add(Documento $doc)
    {
        $nombre     = $doc->getNombre();
        $fichero    = $doc->getFichero();
        $tareaId    = $doc->getTareaId();
        $usuarioId  = $doc->getUsuarioId();

        $stmt = $this->db->prepare("INSERT INTO DOCUMENTO(nombreDoc,fichero,tareaId,usuarioId) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssii', $nombre, $fichero, $tareaId, $usuarioId);
        $stmt->execute();
        $result = $stmt->error;
        $stmt->close();

        return !$result;
    }

    public function delete($id){

        $doc = $this->getDatosDocumento($id);

        //unlink ($doc->getFicheroPath());

        $stmt = $this->db->prepare("DELETE FROM DOCUMENTO WHERE idDocumento = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->error;
        $stmt->close();

        return !$result;
    }

    // Función obtener todos los documentos (Probando Borrar Documento)
    public function getAll(){

        $documentosarray = [];
        $stmt = $this->db->prepare("SELECT * FROM DOCUMENTO");
        $stmt->execute();

        $stmt->bind_result ($idDocumento, $nombreDoc, $fichero, $tareaId, $usuarioId);

        while ($stmt->fetch()) {
            $documentosarray[] = new Documento ($idDocumento, $nombreDoc, $fichero, $tareaId, $usuarioId);
        }

        $stmt->close();

        return $documentosarray;

    }

    public function getDocsByTarea($id){

        $documentos = [];
        $stmt = $this->db->prepare("SELECT * FROM DOCUMENTO WHERE tareaId = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $stmt->bind_result ($idDocumento, $nombreDoc, $fichero, $tareaId, $usuarioId);

        while ($stmt->fetch()) {
            $documentos[] = new Documento ($idDocumento, $nombreDoc, $fichero, $tareaId, $usuarioId);
        }

        $stmt->close();

        return $documentos;

    }

    public function getDatosDocumento($id){

        $stmt = $this->db->prepare("SELECT * FROM DOCUMENTO WHERE idDocumento = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result ($idDocumento, $nombreDoc, $fichero, $tareaId, $usuarioId);
        $stmt->fetch();

        $documento = new Documento ($idDocumento, $nombreDoc, $fichero, $tareaId, $usuarioId);

        $stmt->close();

        return $documento;
    }

    public function getNumDocs() {


        $sql = "SELECT COUNT(*) as total FROM DOCUMENTO";
        $stmt = $this->db->query($sql);
        $res = $stmt->fetch_assoc();
        $stmt->close();

        return $res['total'];



    }


}