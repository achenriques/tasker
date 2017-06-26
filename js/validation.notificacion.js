/*
$.validator.addMethod("destinatario", function(value, element) {
    return $("#destinatario").val().length > 0;
}, "Debe escoger un destinatario");
*/
validate_options.rules = {
	textoNotif: {
            required: true
        }
};

$('form').validate(validate_options);
