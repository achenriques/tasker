<?php
/**
 * Created by IntelliJ IDEA.
 * User: rober
 * Date: 14/12/15
 * Time: 19:32
 */


include("v-panelheader.php");

?>
<h1>Pruebas de Formulario</h1>


<form id="formTest" name="llamar_test" action="v-tcn.php" method="get">
    <!--<strong>Url JSON pruebas:</strong>-->
    <input id="dataUrl" required placeholder="Url del JSON de los datos de las pruebas" type="hidden" name="dataUrl" value="">

    <ul>
        <!--<li><a href="#" onclick="usarJSONPruebas('../tcn/ejemplos/pruebas.json')">Usar ejemplo</a></li>-->
        <li><a href="#" onclick="usarJSONPruebas('../tcn/test/tarea.json')">Tarea (add + update)</a></li>
        <li><a href="#" onclick="usarJSONPruebas('../tcn/test/usuario.json')">Usuario (add + update + updatePass + login)</a></li>
        <li><a href="#" onclick="usarJSONPruebas('../tcn/test/grupo.json')">Grupo (add + update)</a></li>
        <li><a href="#" onclick="usarJSONPruebas('../tcn/test/calendario.json')">Calendario (add + update)</a></li>
        <li><a href="#" onclick="usarJSONPruebas('../tcn/test/reunion.json')">Reunion (add + update)</a></li>
        <li><a href="#" onclick="usarJSONPruebas('../tcn/test/notificacion.json')">Notificacion (add)</a></li>
    </ul>
    <br>
    <!--<strong>Url de envío de resultados (opcional):</strong>
    <input placeholder="Url de envío de pruebas (opcional)" type="text" name="dataUrl" value="">
    Si se introduce una URL en este campo se enviarán los resultados de las pruebas a esa url via POST, en formato JSON.
    <br>-->
    <!--<button type="submit">Enviar</button>-->
</form>


<?php

//if(isset($_GET['dataURL']))
    include("inc-tcn-results.php");

?>


</div> <!-- Da warning porque se abre en el header pero esta bien -->


<script type="text/javascript">
    function usarJSONPruebas(url){
        document.getElementById("dataUrl").value = url;
        document.getElementById("formTest").submit();

    }
</script>

<script text="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../tcn/js/tcn.js"></script>
<script type="text/javascript" src="../tcn/js/test.js"></script>

<?php

include("v-panelfooter.php");

?>
