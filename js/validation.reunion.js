validate_options.rules = {

    fechaReunion: {
        dateES: true,
        //fechaEstFin_gt_fechaEstIni: true,
        required: true
    }
};

$('form').validate(validate_options);