<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 14:11
 */


include("../controlador/UsuarioController.php");
$controlador = new UsuarioController();

/* Esta funcion convierte una imagen con proporciones alto x ancho en una imagen cuadrada manteniendo proporciones*/

function cropeaImg($imagen) {


    $str = getimagesizefromstring($imagen);

    $ancho = $str[0];
    $alto = $str[1];

    if ($alto > $ancho) {

        //Foto estilo Portrait, usamos ancho para hacer el cuadrado.
        $cuadrado = $ancho;
        $offsetAlto = ($alto - $ancho) / 2;
        $offsetAncho = 0;

    }

    elseif  ($ancho > $alto)

    {
        //Foto en modo Landscape, usamos alto para hacer el cuadrado.
        $cuadrado = $alto;
        $offsetAlto = 0;
        $offsetAncho = ($ancho - $alto) / 2;


    }
    else {

        //La Foto ya es cuadrada, usamos cualquiera.
        $cuadrado = $ancho;
        $offsetAlto = $offsetAncho = 0;

    }

    $final_x = 600;
    $final_y = 600;

    $res = imagecreatetruecolor($final_x,$final_y);
    $img = imagecreatefromstring($imagen);

    imagecopyresampled($res, $img, 0, 0, $offsetAncho, $offsetAlto, $final_x,$final_y, $cuadrado, $cuadrado);

    $mime = $str['mime'];
    header("Content-type: " . $mime);

    switch ($mime) {
        case 'image/png':
            imagepng($res);
            break;
        case 'image/jpeg':
            imagejpeg($res);
            break;
    }

}

$username = $_GET['id'];
$imagen = $controlador->recuperaFoto($username);

if ($imagen == null) {

    //Si no tiene imagen metida, visualizamos imagen por defecto.

    $default = '../img/user_default.png';
    $pf = fopen($default,'rb');
    $imagen = fread($pf,filesize($default));
    fclose($pf);

}

/* esto es para sacar el mime, deberia almacenarse con la imagen pero habria que tocar bd, por lo que se hace en dinamico
$str = getimagesizefromstring($imagen);
header("Content-type: " . $str['mime']);
echo $imagen;*/

cropeaImg($imagen);
