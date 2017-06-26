<?php
/**
 * Created by IntelliJ IDEA.
 * User: Anxo
 * Date: 23/12/2015
 * Time: 11:56
 */

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../modelos/DocumentoMapper.php");
require_once(__DIR__ . "/../clases/Documento.php");

class DocumentoController extends Controller
{
    private $documentoMapper;

    public function __construct()
    {
        parent::__construct();
        $this->mapper = new DocumentoMapper();
    }

    public function getAllDocumentos()
    {

        $datos = $this->mapper->getAll();
        return $datos;
    }

    public function getDatosDocumento($id)
    {

        $datos = $this->mapper->getDatosDocumento($id);
        return $datos;
    }

    //Función borrar documento
    public function delete()
    {

        $doc = $this->mapper->getDatosDocumento($this->id);

        if(!unlink ($doc->getFicheroPath()))
            $this->msg->error('Se ha producido un error al intentar eliminar el fichero asociado al documento.');

        $res= $this->mapper->delete($this->id);

        if ($res) {
            //Fue bien
            $this->msg->success($this->idioma['okDeleteDoc']);
        } else {
            //Hubo un error
            $this->msg->error($this->idioma['errorDeleteDoc']);
        }

        $this->redir();
        //header("location: /$this->base_dir/vistas/$this->return");

    }

    public function upload()
    {

        if (!file_exists($this->files_root.'/'.Documento::$DOCS_ROOT)) {
            @mkdir($this->files_root.'/'.Documento::$DOCS_ROOT, 0777);

            if (!file_exists($this->files_root.'/'.Documento::$DOCS_ROOT)) {
                $this->msg->error(sprintf("Imposible crear el directorio de documentos. Cree un directorio '%s' y asigne permisos de escritura",Documento::$DOCS_ROOT));
                $this->redir();
                return;
            }else{
                $this->msg->info('El directorio de documentos ha sido creado.');
            }
        }

        if($_FILES["documento"]["name"] == ""){
            $this->msg->error('Falta el documento.');
            $this->redir();
            //header("location: /$this->base_dir/vistas/$this->return");
            return;
        }

        $nombre     = basename($_FILES["documento"]["name"]);
        //$fichero    = basename($_FILES["documento"]["name"]);
        $tareaId    = $_POST['tareaId'];
        $usuarioId  = $_POST['usuarioId'];

        $doc = new Documento(null, $nombre, null, $tareaId, $usuarioId);

        //$target_dir = Documento::$DOCS_ROOT;
        $target_file = $doc->getFicheroPath();
        $uploadOk = 1;
        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        /*if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["documento"]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                //$uploadOk = 1;
            } else {
                $this->msg->error('Falta el documento.');
                //echo "File is not an image.";
                $uploadOk = 0;
            }
        }*/

        // Check if file already exists
        if (file_exists($target_file)) {
            $this->msg->error('El documento ya existe.');
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["documento"]["size"] > Documento::$MAX_FILESIZE) {
            //$this->msg->error($this->idioma['']);
            $this->msg->error('El documento excede el tamaño permitido.');
            $uploadOk = 0;
        }

        // Allow certain file formats
        /*if (!in_array($fileType, Documento::$FILE_TYPES)) {
            $this->msg->error('El formato del documento no está permitido.');
            $uploadOk = 0;
        }*/

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $this->msg->error('El documento no se ha subido.');
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["documento"]["tmp_name"], $target_file)) {
                $this->msg->success(sprintf("El documento %s se ha subido al servidor", $_FILES["documento"]["name"]));
            } else {
                $uploadOk = 0;
                $this->msg->error('Ha habido un error al subir el documento.');
            }
        }

        if ($uploadOk == 1) {
            $res = $this->mapper->add($doc);

            if ($res) {
                //Fue bien
                $this->msg->success($this->idioma['okAltaDoc']);
            } else {
                //Hubo un error
                $this->msg->error($this->idioma['errorAltaDoc']);
            }
        }

        $this->redir();
        //header("location: /$this->base_dir/vistas/$this->return");

    }

    public function getNumDocs(){

        return $this->mapper->getNumDocs();

    }

}
