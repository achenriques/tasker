<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 6/12/15
 * Time: 18:38
 */

include("v-panelheader.php");

require ("../lib/unit/SiteCheck.php");
require ("../lib/unit/URLSourceArray.php");
require ("../lib/unit/ReportWriterHTML.php");



?>


        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?=$idioma['Pruebas']?> <?=$idioma['Globales']?></h1>
            </div>

            <?php
            $urlSource = new URLSourceArray(
                array (
                    //front page
                    "index.php",
                    // links section
                    //"vistas/",
                    "vistas/v-login.php"
                )
            );
            $siteCheck = new SiteCheck($urlSource, new ReportWriterHTML(), 80, "localhost", "tasker");
            //$siteCheck = new SiteCheck($urlSource, new ReportWriterHTML(), 80, "http://192.168.56.101/tasker", "");
            $siteCheck->runCheck();
            ?>
            <!-- /.col-lg-12 -->
        </div>
    </div>

<?php

include("v-panelfooter.php");

?>