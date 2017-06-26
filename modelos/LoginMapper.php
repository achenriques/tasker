<?php

/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 18:58
 */
require_once(__DIR__ . "/../modelos/PDOConnection.php");
require_once(__DIR__ . "/../clases/Usuario.php");

class LoginMapper
{

    private $db;

    public function __construct()
    {
        $this->db = PDOConnection::getInstance();
    }


    public function checkLogin($username, $password)
    {
        $stmt = $this->db->prepare("SELECT *
								  FROM USUARIO
								  WHERE username=? AND password=?");
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();

        $stmt->bind_result($qIdUsuario,$qUsername, $qNombre, $qEmail, $qPassword, $qImagen, $qIdioma, $qBorrado, $qAdmin);
        $stmt->fetch();
        $stmt->close();

        if ($qUsername == $username AND $qPassword == $password) {

            return new Usuario($qIdUsuario,$qUsername, $qNombre, $qEmail, $qPassword, $qImagen,$qIdioma,$qBorrado,$qAdmin);

        } else

            return null;
    }




}