<?php

/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 12/12/15
 * Time: 9:05
 */
class Grupo
{
    private $idGrupo;
    private $nombreGrupo;
    private $descripcionGrupo;
    private $visibilidad;
    private $calendario;

    public static $PRIVADA = 1;
    public static $PUBLICA = 2;

    public static $VISIBILIDADES = array(
        1 =>    "Privada",
        2 =>    "Pública" );

    /**
     * Grupo constructor.
     * @param $nombreGrupo
     * @param $descripcionGrupo
     * @param $visibilidad
     */
    public function __construct($idGrupo, $nombreGrupo, $descripcionGrupo, $visibilidad, $calendario)
    {
        $this->idGrupo = $idGrupo;
        $this->nombreGrupo = $nombreGrupo;
        $this->descripcionGrupo = $descripcionGrupo;
        $this->visibilidad = $visibilidad;
        $this->calendario = $calendario;
    }

    /**
     * @return mixed
     */
    public function getCalendario()
    {
        return $this->calendario;
    }

    /**
     * @param mixed $calendario
     */
    public function setCalendario($calendario)
    {
        $this->calendario = $calendario;
    }

    /**
     * @return mixed
     */
    public function getIdGrupo()
    {
        return $this->idGrupo;
    }

    public function getNombreGrupo()
    {
        return $this->nombreGrupo;
    }

    /**
     * @param mixed $nombreGrupo
     */

    public function setIdGrupo()
    {
        return $this->idGrupo;
    }

    public function setNombreGrupo($nombreGrupo)
    {
        $this->nombreGrupo = $nombreGrupo;
    }

    /**
     * @return mixed
     */
    public function getDescripcionGrupo()
    {
        return $this->descripcionGrupo;
    }

    /**
     * @param mixed $descripcionGrupo
     */
    public function setDescripcionGrupo($descripcionGrupo)
    {
        $this->descripcionGrupo = $descripcionGrupo;
    }

    /**
     * @return mixed
     */
    public function getVisibilidad()
    {
        return $this->visibilidad;
    }

    /**
     * @param mixed $visibilidad
     */
    public function setVisibilidad($visibilidad)
    {
        $this->visibilidad = $visibilidad;
    }

    public function getVisibilidadTexto()
    {
        return self::$VISIBILIDADES[$this->visibilidad];
    }

}