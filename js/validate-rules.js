$.validator.addMethod("dateES", function(value, element) {
        return this.optional(element) || moment(value,"DD/MM/YYYY").isValid();
    }, "La fecha debe estar en formato dd/mm/aaaa");
    
$.validator.addMethod("fechaEstFin_gt_fechaEstIni", function(value, element) {
	var varIni = $("#fechaEstIni").val();
	//var varFin = $("#fechaEstFin").val();
	var varFin = value;

    return parseInt(varIni)<=parseInt(varFin)
}, "La fecha de Fin debe ser mayor que la de Inicio");

$.validator.addMethod("destinatario", function(value, element) {
    return $("#destinatario").val().length > 0;
}, "Debe escoger un destinatario");

/*
var required_message = "Debe introducir un dato.";
var date_message = "No es un formato de fecha válido.";
var minlength_message = jQuery.validator.format("La longitud mínima es de {0} caracteres!");
var maxlength_message = jQuery.validator.format("La longitud máxima es de {0} caracteres!");


var input_text_messages = {
    minlength: minlength_message,
    maxlength: maxlength_message,
    required: required_message 
};
*/
var validate_options = {
    rules: {},
    messages: {},
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
};