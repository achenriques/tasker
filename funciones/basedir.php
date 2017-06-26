<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 7/12/15
 * Time: 4:51
 */

function basedir()

{

    require_once __DIR__.'/../tools.php';
    $var = Tools::$var;

    return basename(dirname($var));
    //$base_dir= basename(dirname($var));

    $base_dir= dirname($var); 
    $ini = strpos($base_dir,$_SERVER['DOCUMENT_ROOT'])+strlen($_SERVER['DOCUMENT_ROOT'])+1;
  
    $base_dir= substr($base_dir,$ini);  
    
    return $base_dir;
}