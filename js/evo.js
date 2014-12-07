var running = 1;

    function gameLoop() {

        if(running) {

            console.log('-|-');

            $.ajax({
                type: "POST",
                url: "db/ajaxevo.php",
                data: { task: "game" }
            })
                .done(function( msg ) {

                    var json = JSON.parse(msg);

                    for(i in json) {

                        //$('#gamezone').append(json[i]);
                        $('#' + i ).html(json[i]);
                    }

                    //$('#gamezone').append();

                    setTimeout(function() { gameLoop(); }, 250);
                });


            //$('#gamezone').append('More');



        } else {
            //stop
        }
    }

    $(function() {
        //$('#gamezone').append('Texter');

        $('#startstopgame').on('click', function() {

            if(running) {
                running = 0;
                $('#startstopgame').html('Start');
            } else {
                running = 1;
                $('#startstopgame').html('Stop');
                gameLoop();
            }

        });

        $('#resetgame').on('click', function() {
            $.ajax({
                type: "POST",
                url: "db/ajaxevo.php",
                data: { task: "reset" }
            }).done(function( msg ) {  });
        });

        $('#nextyear').on('click', function() {
            $.ajax({
                type: "POST",
                url: "db/ajaxevo.php",
                data: { task: "nextyear" }
            }).done(function( msg ) {  });
        });

        $('.addinput').on('click', function() {
            //console.log('click');

            var $in;
            //var $id;
                //if ($(this).attr('id') == 'coalpowerplant') { $in = 'coal'; $id = $(this).attr('id'); $(this).attr('disabled', 'disabled'); }
            if ($(this).attr('id') == 'coalpowerplant') { $in = 'coal'; }
            if ($(this).attr('id') == 'oilplant') { $in = 'oil'; }
            if ($(this).attr('id') == 'nuclearpowerplant') { $in = 'nuclear'; }
            if ($(this).attr('id') == 'windfarm') { $in = 'wind'; }
            if ($(this).attr('id') == 'solarpowerplant') { $in = 'solar'; }
            if ($(this).attr('id') == 'geothermalpowerplant') { $in = 'geo'; }
            if ($(this).attr('id') == 'devefficiency') { $in = 'eff'; }
            if ($(this).attr('id') == 'devbattery') { $in = 'battery'; }
            if ($(this).attr('id') == 'devfusion') { $in = 'fusion'; }

            $.ajax({
                type: "POST",
                url: "db/ajaxevo.php",
                data: { task: "newinput", newinput: $in }
            }).done(function( msg ) { }); //console.log('kapcs vissza' + $id + $('#' + $id).prop('disabled') ); $('#' + $id).prop('disabled', false);
        });



        gameLoop();
    });