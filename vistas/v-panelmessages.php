    
<!-- Manejo de mensajes -->
<div class="row row-centered">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-centered">
    <?php

    /*
        $this->msg->info('This is an info message');
        $this->msg->success('This is a success message');
        $this->msg->warning('This is a warning message');
        $this->msg->error('This is an error message');
*/    
    
        $msg = new \Plasticbrain\FlashMessages\FlashMessages();
        $msg->display();

        if (isset($_GET['msg']) && isset($_GET['tipo'])) {

            $mensaje = $_GET['msg'];
            Mensaje($idioma[$mensaje],$_GET['tipo']);

        }

    ?>
    </div>

</div>
