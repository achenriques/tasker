<?php

/**
 * Created by IntelliJ IDEA.
 * User: rbr
 * Date: 23/12/15
 * Time: 20:48
 */
class Reunion
{

    private $idReunion;
    private $idGrupo;
    private $fechaReunion;
    private $acta;
    private $estadoReunion;
    //private $ficheroActa;

    public static $DOCS_ROOT = 'uploads/reunion/';
    public static $MAX_FILESIZE = 16777216;
    public static $MAX_FILESIZE_TEXT = "16MB";
    public static $FILE_TYPES = array('pdf');

    /**
     * Reunion constructor.
     * @param $idReunion
     * @param $idGrupo
     * @param $fechaReunion
     * @param $acta
     * @param $estadoReunion
     */
    public function __construct($idReunion, $idGrupo, $fechaReunion, $acta, $estadoReunion)
    {
        $this->idReunion = $idReunion;
        $this->idGrupo = $idGrupo;
        $this->fechaReunion = $fechaReunion;
        $this->acta = $acta;
        $this->estadoReunion = $estadoReunion;
    }

    /**
     * @return mixed
     */
    public function getIdReunion()
    {
        return $this->idReunion;
    }

    /**
     * @param mixed $idReunion
     */
    public function setIdReunion($idReunion)
    {
        $this->idReunion = $idReunion;
    }

    /**
     * @return mixed
     */
    public function getIdGrupo()
    {
        return $this->idGrupo;
    }

    /**
     * @param mixed $idGrupo
     */
    public function setIdGrupo($idGrupo)
    {
        $this->idGrupo = $idGrupo;
    }

    /**
     * @return mixed
     */
    public function getFechaReunion()
    {
        return $this->fechaReunion;
    }

    /**
     * @param mixed $fechaReunion
     */
    public function setFechaReunion($fechaReunion)
    {
        $this->fechaReunion = $fechaReunion;
    }

    /**
     * @return mixed
     */
    public function getActa()
    {
        return $this->getFicheroPath();
        return $this->acta;
    }

    /**
     * @param mixed $acta
     */
    public function setActa($acta)
    {
        $this->acta = $acta;
    }

    /**
     * @return mixed
     */
    public function getEstadoReunion()
    {
        return $this->estadoReunion;
    }

    /**
     * @param mixed $estadoReunion
     */
    public function setEstadoReunion($estadoReunion)
    {
        $this->estadoReunion = $estadoReunion;
    }

    public function getFicheroPath()
    {
        return self::$DOCS_ROOT . $this->calculateFileName();
    }

    public function hasActa($root = null){
        if(is_null($root)) $root = $_SERVER['DOCUMENT_ROOT'].'/tasker';

        return file_exists($root.'/'.$this->getFicheroPath());
    }

    protected function calculateFileName()
    {
        return $this->idReunion . ".ActaReunion.pdf";
    }

}