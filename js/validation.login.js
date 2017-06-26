validate_options.rules = {
    nick: {
        minlength: 3,
        maxlength: 15,
        required: true
    },
    password: {

        required: true
    }
};
$('form').validate(validate_options);