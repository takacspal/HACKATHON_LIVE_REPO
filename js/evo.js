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

                        //console.log(json.year);

                        if(json.year == '2037' ) { //2050
                            running = 0; //terminate script

                            if(json.celsius < 20) {
                                var end = 'Congratulation! You save the earth!!!'; //good end
                                $('.container').hide('fast', function() {
                                    $('#maximage').html('<img src="css/gameover/paradise.jpg" alt="" width="1920" /><img src="css/gameover/tospace.jpg" alt="" width="1920" />').show().maximage();
                                });
                            } else {
                                var end = 'It\'s all over! Everybody dead!'; //bad end
                                $('.container').hide('fast', function() {
                                    $('#maximage').html('<img src="css/gameover/war.jpg" alt="" width="1400"  height="1007" /><img src="css/gameover/apocalypse2.jpg" alt="" width="1400" height="1007" /><img src="css/gameover/desert.jpg" alt="" width="1400" height="1007" />').show().maximage();
                                });
                            }

                            $( "#dialog-message").html(end).dialog({
                                modal: true,
                                title: 'Game Over',
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    },
                                    'Restart': function() {
                                        $( this ).dialog( 'close');
                                        $('#maximage').hide('fast', function() {
                                            $('.container').show();
                                            $('#startstopgame').show();
                                            running = 1;
                                            gameLoop();
                                        });
                                    }
                                }
                            });

                        }

                    //$('#gamezone').append();

                    //if end of the game
                    /*
                    if(false) {
                        $( "#dialog-message" ).dialog({
                            modal: true,
                            buttons: {
                                Ok: function() {
                                    $( this ).dialog( "close" );
                                }
                            }
                        });
                    }
                    */

                    setTimeout(function() { gameLoop(); }, 250);
                });


            //$('#gamezone').append('More');



        } else {
            //stop
        }
    }

    $(function() {
        //$('#gamezone').append('Texter');


            // Trigger maximage

        $('#maximage').on('click', function() {
            $('#maximage').hide(function() {
                $('.container').show();
            });
        });

        $('#startstopgame').on('click', function() {

            if(running) {
                running = 0;

                $('.container').hide('fast', function() {

                    $('#maximage').html('<img src="css/gameover/war.jpg" alt="" width="1400"  height="1007" /><img src="css/gameover/apocalypse2.jpg" alt="" width="1400" height="1007" /><img src="css/gameover/desert.jpg" alt="" width="1400" height="1007" />').show().maximage();
                    //$('#maximage').html('<img src="css/gameover/paradise.jpg" alt="" width="1920" /><img src="css/gameover/tospace.jpg" alt="" width="1920" />').show().maximage();

                });


                //$('#maximage').maximage();

                $.ajax({
                    type: "POST",
                    url: "db/ajaxevo.php",
                    data: { task: "reset" }
                }).done(function( msg ) {

                    //$('#startstopgame').html('Restart');
                    $('#startstopgame').hide();

                    $( '#dialog-message').html('<p>The earth is falling down.</p><p>The average temprature went too hight.</p> <p>Nuclear wars everywehere. No food. No hope.</p>').dialog({
                        height: 600,
                        width: 600,
                        title: 'Game Over',
                        modal: true,
                        buttons: {
                            Ok: function() {
                                $( this ).dialog( 'close' );
                            },
                            'Restart': function() {
                                $( this ).dialog( 'close');
                                $('#maximage').hide('fast', function() {
                                    $('.container').show();
                                    $('#startstopgame').show();
                                    running = 1;
                                    gameLoop();
                                });
                            }
                        }
                    });

                });

            }

            /*else {
                running = 1;
                $('#startstopgame').html('End');
                gameLoop();
            }
            */

        });

        $('#resetgame').on('click', function() {

            $('#startstopgame').show();
            running = 1;

            $.ajax({
                type: "POST",
                url: "db/ajaxevo.php",
                data: { task: "reset" }
            }).done(function( msg ) { gameLoop(); });
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


        var $welcome = '<p>This web application was made by TheTwoPeas team (Kalmar Gabor, Takacs Pal) for the KODING.COM Hackathon competition. Our team would like to call attention to the global warming, so we’ve developed a not too realistic simulation game that tries to „model” the effects of the global warming to 2050.Besides the global warming, we wanted to improve the understanding and readability of the EULA, but you should be already aware of that by now.</p>' +
            '<p><b>Story:</b></p>' +
            '<p>In early 2015, the climate researchers realized that they used inaccurate models and that the rate of the global warming is dreadfully higher. According to the new model, humanity will die out pretty much as species to 2050, if there will be no significant change in the consumption of the currently used energy resources. Of course the leading politicians don’t believe this new data. To avoid this disaster, we’ll have to race against time and use more of the renewable resources and develop new technologies.</p>' +
            '<p><b>Gameplay:</b></p>' +
            '<p>The game will start on 01/01/15. On the top of the page you can see the number of humans currently alive on the planet. Their numbers will grow with time. Unfortunately, more people will need more resources. You can see the global energy resources need at the Energy Production/Energy consumption. Pay attention: the energy production has to be higher than the consumption all the time. If this demand isn’t met, then there will be NEGATIVE CONSEQUENCES: there’ll be a negative effect on the GWP growth and maybe on the global temperature. Without enough GWP the global warming will be unstoppable. You can increase the energy production by buying power plants. Buying a particular power plant costs GWP. Be aware that some types of power plants have an exothermic effect on the environment. Coal, gas, oil and nuclear energy production and consumption make the global temperature increase more intense. Using renewable resources and technologies will reduce the temperature increase rate. You have to spend the GWP by the end of the year, or else it will be spent on useless things and luxuries by useless people. The expected GWP for the next year will change randomly as it mostly depends on how it was invested by the banks and other professionals. Unfortunately the world is at their mercy. If you haven’t got any plans for the year, you don’t have to wait, you can jump to the next year. Clicking reset, you can restart the game. At the bottom of the page, you have three long range investment options. Spending on the first one will immediately has a positive effect on your current power plants. The other two won’t have any effect on things until they’re completely (100%) developed. By developing a new generation of batteries the power plants’ efficiency will grow and the temperature growth rate will be less intense. By developing fusion, you can get an unlimited resource of energy, but for that you need luck because of the randomly generated yearly GWP. The Earth and humanity are in danger and the decisions are in your hands!</p>' +
            '<p><b>Good gaming!</b></p>';

        $( '#dialog-message').html($welcome).dialog({
            height: 600,
            width: 600,
            title: 'Welcome!',
            modal: true,
            buttons: {
                Ok: function() {
                    running = 1;
                    $.ajax({
                        type: "POST",
                        url: "db/ajaxevo.php",
                        data: { task: "reset" }
                    }).done(function( msg ) { gameLoop(); });
                    $( this ).dialog( 'close' );
                }
            }
        });

    });