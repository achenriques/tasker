<!DOCTYPE html>
<html lang="en">

<head>

  

    <title>Tasker - Panel de Usuario</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Datetimepicker JavaScript -->

    <link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<!-- jQuery -->
<script src="../js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Bootstrap Datetimepicker JavaScript -->
<script src="../js/moment-with-locales.min.js"></script>
<script src="../js/bootstrap-datetimepicker.min.js"></script>


</head>

<body>


<div id="page-wrapper">
    
        
    <!-- Manejo de mensajes -->

    <div class="row row-centered">

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-centered">


        
    </div>

    </div>
   
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Modificar Tarea</h1>
        </div>
            </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

    <form role="form" action='../index.php?controller=Tarea&amp;action=update' method='POST' data-toggle="validator">

        <div class="panel panel-default">

            <div class="panel-body">
                        
                       
            <div class="form-group">
                <label for="fechaEstIni">Inicio Estimado</label>
                <input type="text" id="fechaEstIni" name="fechaEstIni" class="form-control" value="2015-12-01"
                       placeholder="dd/mm/aaaa" data-error="La fecha introducida es errónea" required>
            </div>
            <div class="help-block with-errors"></div>
            <div class="form-group">
                <label for="fechaEstFin">Fin Estimado</label>
                <input type="date" id="fechaEstFin" name="fechaEstFin" class="form-control" value="2015-12-27"
                       placeholder="dd/mm/aaaa" data-error="La fecha introducida es errónea" required
                       
                       >
            </div>
            <div class="help-block with-errors"></div>
            <div class="form-group">
                <label for="fechaRealIni">Inicio Real</label>
                <input type="date" id="fechaRealIni" name="fechaRealIni" class="form-control" value="0000-00-00"
                       placeholder="dd/mm/aaaa" data-error="La fecha introducida es errónea" >
            </div>
            <div class="help-block with-errors"></div>
            <div class="form-group">
                <label for="fechaRealFin">Fin Real</label>
                <input type="date" id="fechaRealFin" name="fechaRealFin" class="form-control" value=""
                       placeholder="dd/mm/aaaa" disabled>
            </div>   
                       
            </div> <!-- panel body -->
            <div class="panel-footer">
                <button type="submit" class="btn btn-outline btn-primary" name="actualizarTarea">Guardar Cambios</button>
            </div>

        </div> <!-- Panel -->

        <input type="hidden" id="idTarea" name="idTarea" value="7">

        </form> <!-- Form -->

    </div><!-- col -->
    
    

    
    
    
    
    
    
</div><!-- wrapper -->

<script type="text/javascript">
    $(function () {
        $('#fechaEstIni').datetimepicker();             
    });
    
    //$(document).ready(function() {
    //    $('#fechaEstIni').datetimepicker();                 
    //});
</script>



<!-- /#wrapper -->




</body>

</html>
