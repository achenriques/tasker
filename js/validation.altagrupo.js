validate_options.rules = {
    nombreGrupo: {
        minlength: 3,
        maxlength: 45,
        required: true
    },
    descripcionGrupo: {
        minlength: 3,
        maxlength: 140,
        required: true
    }
};

$('form').validate(validate_options);