validate_options.rules = {
    nombre: {
        minlength: 3,
        maxlength: 30,
        required: true
    },
    email: {
        minlength: 4,
        maxlength: 45,
        required: true
    }
};
$('form').validate(validate_options);