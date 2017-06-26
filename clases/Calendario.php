<?php

/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 12/12/15
 * Time: 13:03
 */
class Calendario
{

    private $idCalendario;
    private $nombreCalendario;
    private $color;

    /**
     * Calendario constructor.
     * @param $nombreCalendario
     * @param $color
     */
    public function __construct($idCalendario = null, $nombreCalendario, $color)
    {
        $this->idCalendario = $idCalendario;
        $this->nombreCalendario = $nombreCalendario;
        $this->color = $color;
    }
    
    /**
     * @param mixed $idCalendario
     */
    public function setIdCalendario($idCalendario)
    {
        $this->idCalendario = $idCalendario;
    }

    /**
     * @return mixed
     */
    public function getNombreCalendario()
    {
        return $this->nombreCalendario;
    }

    /**
     * @param mixed $nombreCalendario
     */
    public function setNombreCalendario($nombreCalendario)
    {
        $this->nombreCalendario = $nombreCalendario;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getIdCalendario()
    {
        return $this->idCalendario;
    }



}