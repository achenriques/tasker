<?php

/**
 * Created by NetBeans.
 * User: aouteiral
 * Date: 13/12/15
 * Time: 14:01
 */
class Estado
{
    private $idEstado;
    private $codEstado;
    private $nombreEstado;
  
    /**
     * Estado constructor.
     * @param $idEstado
     * @param $codEstado
     * @param $nombreEstado
     */
    public function __construct($idEstado,$codEstado,$nombreEstado)
    {
        $this->idEstado = $idEstado;
        $this->codEstado = $codEstado;
        $this->nombreEstado = $nombreEstado;
    }

    /**
     * @return boolean
     */
    public function isNull()
    {
        return $this->idEstado == '';
    }
    
    /**
     * @return mixed
     */
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    /**
     * @param mixed $idEstado
     */
    /*public function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;
    }*/
    
    /**
     * @return mixed
     */
    public function getCodEstado()
    {
        return $this->codEstado;
    }

    /**
     * @param mixed $codEstado
     */
    public function setCodEstado($codEstado)
    {
        $this->codEstado = $codEstado;
    }

    /**
     * @return mixed
     */
    public function getNombreEstado()
    {
        return $this->nombreEstado;
    }

    /**
     * @param mixed $nombreEstado
     */
    public function setNombreEstado($nombreEstado)
    {
        $this->nombreEstado = $nombreEstado;
    }

}