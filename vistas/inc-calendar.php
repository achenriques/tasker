<div class="responsive-calendar">
    <div class="controls">
        <a class="pull-left" data-go="prev"><div class="btn btn-outline btn-primary"><i class="fa fa-backward"></i></div></a>
        <h4><span data-head-year></span> <span data-head-month></span></h4>
        <a class="pull-right" data-go="next"><div class="btn btn-outline btn-primary"><i class="fa fa-forward"></i></div></a>
    </div><hr/>
    <div class="day-headers" style="padding:3px">
        <div class="day header2"><?=$idioma['Lun']?></div>
        <div class="day header2"><?=$idioma['Mar']?></div>
        <div class="day header2"><?=$idioma['Mie']?></div>
        <div class="day header2"><?=$idioma['Jue']?></div>
        <div class="day header2"><?=$idioma['Vie']?></div>
        <div class="day header2"><?=$idioma['Sab']?></div>
        <div class="day header2"><?=$idioma['Dom']?></div>
    </div>
    <div class="days" data-group="days">

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {

        $(".responsive-calendar").responsiveCalendar({

            events: {


                "2013-04-30": {"number": 5, "url": "http://w3widgets.com/responsive-slider"},
                "2013-04-26": {"number": 1, "url": "http://w3widgets.com"},
                "2013-05-03":{"number": 1},
                "2013-06-12": {}}
        });
    });
</script>