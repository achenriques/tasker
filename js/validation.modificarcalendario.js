validate_options.rules = {
	nombreCalendario: {
        	minlength: 3,
            maxlength: 45,
            required: true
        }
};
$('form').validate(validate_options);