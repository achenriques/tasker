<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 16:06
 */

class PDOConnection {

    private static $conexion = null;

    /**
     *
     * mysql -u root -p g43 < script.sql
     *
     * @return mysqli|null
     */
    public static function getInstance() {

        if (self::$conexion == null) {

            // BBDD Localhost
            self::$conexion = mysqli_connect("localhost", "tasker", "tasker", "taskerbd");
            // BBDD Remote
            //self::$conexion = mysqli_connect("88.2.224.44", "tasker", "tasker", "taskerbd");
            // BBDD Remote
            //self::$conexion = mysqli_connect("162.243.75.153", "g43_user", "g43_user", "g43");
            
            $acentos = self::$conexion->query("SET NAMES 'utf8'");
            
            if (self::$conexion->connect_errno) {

                printf("Falló la conexión a la Base de datos: %s\n", mysqli_connect_error());
                exit();
            }
        }

        return self::$conexion;
    }
}
