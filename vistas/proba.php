<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="../css/datepicker.css"/>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-datepicker.min.js"></script>
<script src="../js/bootstrap-datepicker.es.js" charset="UTF-8"></script>
<script src="../js/moment-with-locales.min.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<script src="../js/messages_es.js"></script>
<script src="../js/validate-rules.js"></script>

<style>
body {
    padding: 20px;
}
</style>
</head>

<body>
<form>


<div class="row">
    <div class="form-group col-xs-4">
        <label class="control-label" for="firstname">Codigo:</label>
        <div class="input-group">
            <span class="input-group-addon"></span>
            <input class="form-control" placeholder="Insira o seu nome proprio" name="firstname" type="text" />
        </div>
    </div>
        
    <div class="form-group col-xs-4">
        <label class="control-label" for="lastname">Nombre:</label>
        <div class="input-group">
            <span class="input-group-addon"></span>
            <input class="form-control" placeholder="Insira o seu apelido" name="lastname" type="text" />
        </div>
    </div>
</div>  
<div class="row">
    <div class="form-group col-xs-8">
        <label class="control-label" for="lastname">Descripcion:</label>
        <div class="input-group">
            <span class="input-group-addon"></span>
            <textarea class="form-control col-xs-8" ></textarea>
        </div>
    </div>
</div>  
<div class="row">
    <div class="form-group col-xs-4">
        <label class="control-label" for="fechaEstIni">Fecha Est. Inicio:</label>
        <div class="input-group">
            <span class="input-group-addon"></span>
            <input class="form-control" placeholder="dd/mm/aaaa" id="fechaEstIni" name="fechaEstIni" type="text" />
        </div>
    </div>
    <div class="form-group col-xs-4">
        <label class="control-label" for="fechaEstFin">Fecha Est. Fin:</label>
        <div class="input-group">
            <span class="input-group-addon"></span>
            <input class="form-control" placeholder="dd/mm/aaaa" id="fechaEstFin" name="fechaEstFin" type="text" />
        </div>
    </div>
</div>  
<div class="row">
    <div class="form-group col-xs-4">
        <label class="control-label" for="fechaRealIni">Fecha Real Inicio:</label>
        <div class="input-group">
            <span class="input-group-addon"></span>
            <input class="form-control" placeholder="dd/mm/aaaa" id="fechaRealIni" name="fechaRealIni" type="text" />
        </div>
    </div>
    <div class="form-group col-xs-4">
        <label class="control-label" for="fechaRealFin">Fecha Real Fin:</label>
        <div class="input-group">
            <span class="input-group-addon"></span>
            <input class="form-control" placeholder="dd/mm/aaaa" id="fechaRealFin" name="fechaRealFin" type="text" disabled />
        </div>
    </div>
</div>  
    <button type="submit" class="btn btn-primary">Guardar cambios</button>
   
</form>

<script>
$.fn.datepicker.defaults.language= 'es';

$('#fechaEstIni').datepicker();
$('#fechaEstFin').datepicker();
$('#fechaRealIni').datepicker();

jQuery.validator.addMethod("dateES", function(value, element) {
        return this.optional(element) || moment(value,"DD/MM/YYYY").isValid();
    }, "Please enter a valid date in the format DD/MM/YYYY");
    
$.validator.addMethod("fechaEstFin_gt_fechaEstIni", function(value, element) {
	var varIni = $("#fechaEstIni").val();
	var varFin = $("#fechaEstFin").val();
	//var varFin = value;

    return parseInt(varIni)<=parseInt(varFin)
}, "La fecha de Fin debe ser mayor que la de Inicio");

validate_options.rules = {
	firstname: {
        	minlength: 3,
                maxlength: 15,
                required: true
        },
        lastname: {
                minlength: 3,
                maxlength: 15,
                required: true
        },
        fechaEstIni: {
            	dateES: true,
            	fechaEstFin_gt_fechaEstIni: true,
            	required: true
    	},
    	fechaEstFin: {
            	dateES: true,
            	fechaEstFin_gt_fechaEstIni: true,
            	required: true
    	},
        fechaRealIni: {
            	dateES: true
    	},
    	
};
        
validate_options.messages = {
	firstname: input_text_messages,
	lastname: input_text_messages,
        fechaEstIni: {
                dateES: date_message,
                required: required_message
        },
        fechaEstFin: {
                dateES: date_message,
                required: required_message
        },
        fechaRealIni: {
                dateES: date_message,
                required: required_message
        }
};

$('form').validate(validate_options);
</script>
</body>


</html>