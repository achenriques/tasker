<?php

/**
 * Created by NetBeans.
 * User: aouteiral
 * Date: 19/12/15
 * Time: 15:33
 */

class Notificacion
{
    private $id;
    private $texto;
    private $estado;
    private $tipo;
    private $destinatario;
    private $remitente;
    private $remitenteNombre;
    private $timestamp;

    public static $EST_ENVIADA = 1;
    public static $EST_NOTIFICADA = 2;
    public static $EST_DESCARTADA = 3;
    
    public static $TIPO_ENVELOPE = 1;
    public static $TIPO_COMMENT = 2;
    public static $TIPO_TASKS = 3;
    public static $TIPO_UPLOAD = 4;
    public static $TIPO_TWITTER = 5;
    
    public static $TIPOS_CSS = array(
        1 =>    "envelope",
        2 =>    "comment",
        3 =>    "tasks",
        4 =>    "upload",
        5 =>    "twitter" );
    
    public static $TIPOS_HUMAN = array(
        1 =>    "Notificación",
        2 =>    "Comentario",
        3 =>    "Tarea",
        4 =>    "Upload",
        5 =>    "Twitter" );
    
    /**
     * Notificacion constructor.
     * @param $id
     * @param $texto
     * @param $estado
     * @param $tipo
     * @param $destinatario
     * @param $remitente
     */
    public function __construct($id,$texto,$estado,$tipo,$destinatario,$remitente,$timestamp=null)
    {
        $this->id          = $id;
        $this->texto       = $texto;
        $this->estado      = $estado;
        $this->tipo        = $tipo;
        $this->destinatario= $destinatario;
        $this->remitente   = $remitente;
        $this->timestamp   = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    /*public function setId($id)
    {
        $this->id = $id;
    }*/
    
    /**
     * @return mixed
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * @param mixed $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }    
    
    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }     

    /**
     * @return mixed
     */
    public function getDestinatario()
    {
        return $this->destinatario;
    }

    /**
     * @param mixed $destinatario
     */
    public function setDestinatario($destinatario)
    {
        $this->destinatario = $destinatario;
    } 

    /**
     * @return mixed
     */
    public function getRemitente()
    {
        return $this->remitente;
    }

    /**
     * @param mixed $remitente
     */
    public function setRemitente($remitente)
    {
        $this->remitente = $remitente;
    }    
    
    /**
     * @return mixed
     */
    public function getRemitenteNombre()
    {
        return $this->remitenteNombre;
    }

    /**
     * @param mixed $remitente
     */
    public function setRemitenteNombre($remitente)
    {
        $this->remitenteNombre = $remitente;
    }     
    
    public function getCss()
    {
        return Notificacion::$TIPOS_CSS[$this->tipo];
    }
    
    public function getTimeAgo()
    {
        //return $this->timestamp;
        return $this->dateDiff($this->timestamp,date("Y-m-d H:m:i"));
    }
    
    public function getTextoAbreviado($max = 15)
    {

        return strlen($this->texto)>$max ? substr($this->texto, 0, $max) . "..." : $this->texto;
    }
    
    ///////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////
        
    // Time format is UNIX timestamp or
    // PHP strtotime compatible strings
    function dateDiff($time1, $time2, $precision = 6) {

    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
        $time2 = strtotime($time2);
    }
        $timestamp = $time1;

    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }

    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();

    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }

      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }

    //print_r($diffs);

    //More than a day ago
    if(($diffs['year']+$diffs['month']+$diffs['day'])>0) {
        return strftime('%d/%m %H:%M', $timestamp);
        //return strftime('%d/%m %I:%M %p', $time1);
        //return strftime('%d/%m/%Y %I:%M %p', $time1);
        //More than 1 hour ago
    }elseif(($diffs['year']+$diffs['month']+$diffs['day']+$diffs['hour'])>0) {
        return strftime('%H:%M', $timestamp);
        //return strftime('%I:%M %p', $time1);
    }else {
        return "Hace " . $diffs['minute'] . " min.";
    }
        
        
    //A PArtir de aqui non se usa    

    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
        break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
        // Add s if value is not 1
        if ($value != 1) {
          $interval .= "s";
        }
        // Add value and interval to times array
        $times[] = $value . " " . $interval;
        $count++;
      }
    }

    // Return string with times
    return implode(", ", $times);
    }    
}
