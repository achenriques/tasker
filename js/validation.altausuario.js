validate_options.rules = {
    nick: {
        minlength: 3,
        maxlength: 15,
        required: true
    },
    nombre: {
        minlength: 3,
        maxlength: 30,
        required: true
    },
    email: {
        minlength: 4,
        maxlength: 45,
        required: true
    },
    passwordU: {

        minlength: 8,
        maxlength: 32,
        required: true
    },
    passwordConf: {
        minlength: 8,
        maxlength: 32,
        required: true
    }
};
$('form').validate(validate_options);