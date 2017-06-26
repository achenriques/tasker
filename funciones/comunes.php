<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 14:28
 */

function CargaIdioma($idioma)
{

    //incluimos el array de idioma correspondiente con el indicado en la session

    switch ($idioma)
    {
        case 'es':
            include '../lang/es.php';
            break;
        case 'en':
            include '../lang/en.php';
            break;
        DEFAULT:
            include '../lang/es.php';
            break;
    }
    return $idioma;
}

//Recibe un mensaje y un tipo: success,warning,danger,info y lo muestra en forma de popup dismissable.

function Mensaje($mensaje,$tipo) {


        echo '<div class="alert alert-'.$tipo.' alert-dismissible" style="margin-top:10px;">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo $mensaje.'</div>';


}