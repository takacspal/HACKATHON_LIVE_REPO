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

                    setTimeout(function() { gameLoop(); }, 1000);
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

        gameLoop();
    });