<?php
/**
 * Created by IntelliJ IDEA.
 * User: Anxo
 * Date: 23/12/2015
 * Time: 12:09
 */
class Documento{

    private $id;
    private $nombre;
    private $fichero;
    private $tareaId;
    private $usuarioId;
    private $tarea;
    private $usuario;

    public static $DOCS_ROOT = 'uploads/';
    public static $MAX_FILESIZE = 16777216;
    public static $MAX_FILESIZE_TEXT = "16MB";
    public static $FILE_TYPES = array('pdf','doc','docx');

    public function __construct($id, $nombre, $fichero, $tareaId, $usuarioId)
    {
        /*if (!file_exists(getcwd().'/'.self::$DOCS_ROOT)) {
            @mkdir(getcwd().'/'.self::$DOCS_ROOT, 0777);
        }*/

        $this->id       = $id;
        $this->nombre   = $nombre;
        $this->fichero  = $fichero;
        $this->tareaId    = $tareaId;
        $this->usuarioId  = $usuarioId;

        if(is_null($fichero))
            $this->fichero = $this->calculateFileName();
    }

    protected function calculateFileName()
    {
        return $this->tareaId . "." . $this->nombre;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getFichero()
    {
        return $this->fichero;
    }

    public function getFicheroPath()
    {
        return self::$DOCS_ROOT . $this->fichero;
    }

    public function getTareaId()
    {
        return $this->tareaId;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function getTarea()
    {
        return $this->tarea;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setFichero($fichero)
    {
        $this->fichero = $fichero;
    }

    public function setTarea($tarea)
    {
        $this->tarea = $tarea;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function setTareaId($tareaId)
    {
        $this->tareaId = $tareaId;
    }

    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;
    }

}