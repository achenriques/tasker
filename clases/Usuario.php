<?php

/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 16:02
 */
class Usuario
{

    private $username;
    private $nombre;
    private $email;
    private $imagen;
    private $password;
    private $idioma;
    private $borrado;
    private $idUsuario;
    private $admin;

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }



    /**
     * @return mixed
     */
    public function getBorrado()
    {
        return $this->borrado;
    }

    /**
     * @param mixed $borrado
     */
    public function setBorrado($borrado)
    {
        $this->borrado = $borrado;
    }

    /**
     * usuario constructor.
     * @param $nombre
     * @param $apellidos
     * @param $email
     * @param $imagen
     * @param $password
     * @param $idioma
     */
    public function __construct($idUsuario, $username, $nombre, $email, $password, $imagen, $idioma, $borrado, $admin)
    {
        $this->idUsuario = $idUsuario;
        $this->username = $username;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->idioma = $idioma;
        $this->imagen = $imagen;
        $this->borrado = $borrado;
        $this->admin = $admin;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param mixed $apellidos
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $idioma
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

}