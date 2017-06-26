<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 11:47
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Default controller if any controller is passed in the URL
 */
define("DEFAULT_CONTROLLER", "Login");

/**
 * Default action if any action is passed in the URL
 */
define("DEFAULT_ACTION", "index");

function run() {

    try {


        if (!isset($_GET["controller"])) {

            $_GET["controller"] = DEFAULT_CONTROLLER;
        }

        if (!isset($_GET["action"])) {

            $_GET["action"] = DEFAULT_ACTION;
        }
         /*
         * Instantiate the corresponding controller
         */

        $controller = loadController($_GET["controller"]);

        $actionName = $_GET["action"];
        $controller->$actionName();

    } catch (Exception $ex) {

        die("An exception occured!!!!!" . $ex->getMessage());
    }
}

/**
 * Load the required controller file and create the controller instance
 *
 * @param string $controllerName The controller name found in the URL
 * @return Object A Controller instance
 */
function loadController($controllerName) {

    $controllerClassName = getControllerClassName($controllerName);
    require_once(__DIR__ . "/controlador/" . $controllerClassName . ".php");
    return new $controllerClassName();
}

/**
 * Obtain the class name for a controller name in the URL
 *
 * For example $controllerName = "users" will return "UsersController"
 *
 * @param $controllerName string name of the controller found in the URL
 * @return string The controller class name
 */
function getControllerClassName($controllerName) {

    return strToUpper(substr($controllerName, 0, 1)) . substr($controllerName, 1) . "Controller";
}

run();