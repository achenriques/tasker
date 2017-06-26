<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 11:52
 */

class Tools {

    public static $var = __FILE__;

    public static function date2php($date){
        
        if(is_null($date))
            return null;
        
        //$dtime = new DateTime($date);$date = $dtime->format("d/m/Y");
        $date = date("d/m/Y",strtotime($date));

        return $date;
    }

    public static function php2date($date){
        
        if(is_null($date) || $date == '')
            return null;
        
        if(strpos($date, "/") !== false){
            list($dia, $mes, $ano) = explode("/",$date); 
            $date = "$ano-$mes-$dia";
        }
        return $date;
    }
    
}