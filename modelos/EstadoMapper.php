<?php

/**
 * Created by NetBeans.
 * User: aouteiral
 * Date: 13/12/15
 * Time: 14:20
 */

require_once(__DIR__ . "/../modelos/PDOConnection.php");
require_once(__DIR__ . "/../clases/Estado.php");

class EstadoMapper
{

    private $db;

    public function __construct(){
        $this->db= PDOConnection::getInstance();
    }

    /**
     * @param Estado $estado
     * @return bool
     *
     * Inserta el estado
     *
     */
    public function add(Estado $estado){

        $codEstado = $estado->getCodEstado();
        $nombreEstado = $estado->getNombreEstado();       
                
        $stmt = $this->db->prepare("INSERT INTO ESTADO (codEstado,nombreEstado,) VALUES (?, ?)");
        $stmt->bind_param('ss', $codEstado,$nombreEstado);
        $stmt->execute();

        $result = $stmt->error;
        $stmt->close();
        if ( !$result ) { return true; }
 
        return false;

    }
    
    /**
     * @param Estado $estado
     * @return bool
     *
     * Actualiza el estado.
     *
     */
    public function update(Estado $estado,$id_calendario){

        $idEstado = $estado->getIdEstado();
        $codEstado = $estado->getCodEstado();
        $nombreEstado = $estado->getNombreEstado();
                
        $stmt = $this->db->prepare("UPDATE ESTADO SET codEstado=?,nombreEstado=?,descripcionEstado=? WHERE idEstado=?");
        $stmt->bind_param('sssi', $codEstado,$nombreEstado,$descripcionEstado);
        $stmt->execute();
        
        /* Recoge el error de la consulta. Si está vacio la consulta fue bien, en caso contrario no */
        $result = $stmt->error;
        $stmt->close();
        if ( !$result ) { return true; }
 
        return false;
        
    }
    
    /**
     * @param $id
     * @return Estado
     *
     * Devuelve un array con los datos del esatdo dado por su id.
     *
     */
    public function getDatosEstado($id){

        $stmt = $this->db->prepare("SELECT idEstado,codEstado,nombreEstado,descripcionEstado
                                    FROM ESTADO
                                    WHERE idEstado=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        
        //if ($stmt->num_rows == 0)
        //    return null;
        
        $stmt->bind_result($idEstado,$codEstado,$nombreEstado,$descripcionEstado);
        $stmt->fetch();
        $stmt->close();

        return new Estado($idEstado,$codEstado,$nombreEstado,$descripcionEstado);

    }
    
    public function getAll(){

        $stmt = $this->db->prepare("SELECT * FROM ESTADO");
        $stmt->execute();
        $stmt->store_result();
        
        $stmt->bind_result($idEstado,$codEstado,$nombreEstado);

        while ($stmt->fetch()) {
            $estado[] = new Estado($idEstado,$codEstado,$nombreEstado);
        }

        $stmt->close();

        return $estado;

    }
    
}