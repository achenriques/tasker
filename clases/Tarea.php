<?php

/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 14:01
 */
class Tarea
{
    
    public static $EST_CREADA = 1;
    public static $EST_ASIGNADA = 2;
    public static $EST_ENPROCESO = 3;
    public static $EST_FINALIZADA = 4;
    
    private $idTarea;
    private $codTarea;
    private $nombreTarea;
    private $descripcionTarea;
    private $tareaPadre;
    private $estadoTarea;
    private $fechaEstIni;
    private $fechaEstFin;
    private $fechaRealIni;
    private $fechaRealFin;
    private $subTareas;
    private $estadoEntidad;
    private $padreEntidad;
    private $calendarioEntidad;
    private $documentos;

    /**
     * Tarea constructor.
     * @param $idTarea
     * @param $codTarea
     * @param $nombreTarea
     * @param $descripcionTarea
     * @param $tareaPadre
     * @param $estadoTarea
     */
    public function __construct($idTarea,$codTarea,$nombreTarea,$descripcionTarea,$tareaPadre,$estadoTarea,$fechaEstIni,$fechaEstFin,$fechaRealIni,$fechaRealFin)
    {
        $this->idTarea = $idTarea;
        $this->codTarea = $codTarea;
        $this->nombreTarea = $nombreTarea;
        $this->descripcionTarea = $descripcionTarea;
        $this->tareaPadre = $tareaPadre;
        $this->estadoTarea = $estadoTarea;
        $this->fechaEstIni = $fechaEstIni;
        $this->fechaEstFin = $fechaEstFin;
        $this->fechaRealIni = $fechaRealIni;
        $this->fechaRealFin = $fechaRealFin;
    }

    /**
     * @return boolean
     */    
    public function isNull()
    {
        return $this->idTarea == '';
    }
    
    /**
     * @return mixed
     */
    public function getIdTarea()
    {
        return $this->idTarea;
    }

    /**
     * @param mixed $idTarea
     */
    /*public function setIdTarea($idTarea)
    {
        $this->idTarea = $idTarea;
    }*/
    
    /**
     * @return mixed
     */
    public function getCodTarea()
    {
        return $this->codTarea;
    }

    /**
     * @param mixed $codTarea
     */
    public function setCodTarea($codTarea)
    {
        $this->codTarea = $codTarea;
    }

    /**
     * @return mixed
     */
    public function getNombreTarea()
    {
        return $this->nombreTarea;
    }

    /**
     * @param mixed $nombreTarea
     */
    public function setNombreTarea($nombreTarea)
    {
        $this->nombreTarea = $nombreTarea;
    }

    /**
     * @return mixed
     */
    public function getDescripcionTarea()
    {
        return $this->descripcionTarea;
    }

    /**
     * @param mixed $descripcionTarea
     */
    public function setDescripcionTarea($descripcionTarea)
    {
        $this->descripcionTarea = $descripcionTarea;
    }

    /**
     * @return mixed
     */
    public function getTareaPadre()
    {
        return $this->tareaPadre;
    }

    /**
     * @param mixed $tareaPadre
     */
    public function setTareaPadre($tareaPadre)
    {
        $this->tareaPadre = $tareaPadre;
    }

    /**
     * @return mixed
     */
    public function getEstadoTarea()
    {
        return $this->estadoTarea;
    }

    /**
     * @param mixed $estadoTarea
     */
    public function setEstadoTarea($estadoTarea)
    {
        $this->estadoTarea = $estadoTarea;
    }

    /**
     * @return mixed
     */
    public function getFechaEstIni()
    {
        return $this->fechaEstIni;
    }

    /**
     * @param mixed $fechaEstIni
     */
    public function setFechaEstIni($fechaEstIni)
    {
        $this->fechaEstIni = $fechaEstIni;
    }

    /**
     * @return mixed
     */
    public function getFechaEstFin()
    {
        return $this->fechaEstFin;
    }

    /**
     * @param mixed $fechaEstFin
     */
    public function setFechaEstFin($fechaEstFin)
    {
        $this->fechaEstFin = $fechaEstFin;
    }

    /**
     * @return mixed
     */
    public function getFechaRealIni()
    {
        return $this->fechaRealIni;
    }

    /**
     * @param mixed $fechaRealIni
     */
    public function setFechaRealIni($fechaRealIni)
    {
        $this->fechaRealIni = $fechaRealIni;
    }
    
    /**
     * @return mixed
     */
    public function getFechaRealFin()
    {
        return $this->fechaRealFin;
    }

    /**
     * @param mixed $fechaRealFin
     */
    public function setFechaRealFin($fechaRealFin)
    {
        $this->fechaRealFin = $fechaRealFin;
    }
    
    /**
     * @return mixed
     */
    public function getSubTareas()
    {
        return $this->subTareas;
    }

    /**
     * @param mixed $subTareas
     */
    public function setSubTareas($subTareas)
    {
        $this->subTareas = $subTareas;
    }    
    
    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estadoEntidad;
    }

    /**
     * @param mixed $estadoEntidad
     */
    public function setEstado($estadoEntidad)
    {
        $this->estadoEntidad = $estadoEntidad;
    }   
    
    /**
     * @return mixed
     */
    public function getPadre()
    {
        return $this->padreEntidad;
    }

    /**
     * @param mixed $padreEntidad
     */
    public function setPadre($padreEntidad)
    {
        $this->padreEntidad = $padreEntidad;
    }      
    
    /**
     * @return mixed
     */
    public function getCalendario()
    {
        return $this->calendarioEntidad;
    }

    /**
     * @param mixed $calendarioEntidad
     */
    public function setCalendario($calendario)
    {
        $this->calendarioEntidad = $calendario;
    }

    public function getDocumentos()
    {
        return $this->documentos;
    }


    public function setDocumentos($documentos)
    {
        $this->documentos = $documentos;
    }

    public function isClosed()
    {
        return $this->estadoTarea == 4;
    }

    public function hasParent()
    {
        return !($this->tareaPadre == null);
    }

    /*public function getListaDocumentos()
    {
        return "a.pdf, B.pdf";
    }*/
}