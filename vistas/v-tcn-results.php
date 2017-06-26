<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 14/12/15
 * Time: 19:32
 */


include("v-panelheader.php");

?>



    <div class="row">

    <div class="col-lg-12">
        <h1>Tests</h1>
        <hr>
        </div>
        </div>

    <div class="row">
        <div class="col-lg-12" id="estadisticas">
            <h2>Estadísticas:</h2>
            <ul>
                <li><string>Total tests incorrectos:</string><span id="total-tests-incorrectos"></span></li>
                <li><string>Total tests:</string><span id="total-tests"></span></li>
                <li><string>Total campos erróneos:</string><span id="total-campos-erroneos"></span></li>
                <li><string>Total campos:</string><span id="total-campos"></span></li>
                <li><string>Total formularios erróneos:</string><span id="total-formularios-erroneos"></span></li>
                <li><string>Total formularios:</string><span id="total-formularios"></span></li>
                <li><string>Total páginas erróneas:</string><span id="total-paginas-erroneas"></span></li>
                <li><string>Total páginas:</string><span id="total-paginas"></span></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2>Resultados totales:</h2>
            <div class="row">
                <div class="col-lg-12">
                    <pre class="" id="resultados-totales"></pre>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" id="div-tabla-resultados">
                    <h3>Tabla resultados:</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2>Errores:</h2>
            <pre id="errores"></pre>
        </div>
    </div>




</div> <!-- Da warning porque se abre en el header pero esta bien -->

<script text="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../tcn/js/tcn.js"></script>
<script type="text/javascript" src="../tcn/js/test.js"></script>

<?php

include("v-panelfooter.php");

?>