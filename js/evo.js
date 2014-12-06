var running = 1;

    function gameLoop() {

        if(running) {

            $.ajax({
                type: "POST",
                url: "db/ajaxevo.php",
                data: { name: "John" }
            })
                .done(function( msg ) {
                    $('#gamezone').append(msg);
                });


            //$('#gamezone').append('More');

            setTimeout(function() { gameLoop(); }, 1000);



        } else {
            //stop
        }
    }

    $(function() {
        $('#gamezone').append('Texter');

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

        gameLoop();
    });