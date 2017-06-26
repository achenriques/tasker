/*
jQuery.validator.addMethod("dateES", function(value, element) {
        return this.optional(element) || moment(value,"DD/MM/YYYY").isValid();
    }, "La fecha debe estar en formato dd/mm/aaaa");
    
$.validator.addMethod("fechaEstFin_gt_fechaEstIni", function(value, element) {
	var varIni = $("#fechaEstIni").val();
	//var varFin = $("#fechaEstFin").val();
	var varFin = value;

    return parseInt(varIni)<=parseInt(varFin)
}, "La fecha de Fin debe ser mayor que la de Inicio");
*/
validate_options.rules = {
	codTarea: {
        	minlength: 3,
                maxlength: 12,
                required: true
        },
        nombreTarea: {
                minlength: 3,
                maxlength: 45,
                required: true
        },
        descripcionTarea: {
                minlength: 3,
                maxlength: 140,
                required: true
        },
        fechaEstIni: {
            	dateES: true,
            	//fechaEstFin_gt_fechaEstIni: true,
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
/*        
validate_options.messages = {
	codTarea: input_text_messages,
	nombreTarea: input_text_messages,
        descripcionTarea: input_text_messages,
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
*/
$('form').validate(validate_options);