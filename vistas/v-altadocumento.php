<?php
/**
 * Created by IntelliJ IDEA.
 * User: Anxo
 * Date: 21/12/2015
 * Time: 18:42
 */

include("v-panelheader.php");
include("../clases/Documento.php");


?>


<style>
    form {
        width: 25em;
        padding: 1em;
        border: 1px solid #ccc;
        border-radius: .5em;
        margin: 1em;
        box-shadow: .25em .25em 0 #ccc;
    }

</style>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=$idioma['Nuevo Documento']?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

<?php
    include("inc-altadocumento.php");
?>

</div><!-- col -->
