<?php
header("Content-type: text/html; charset=utf-8");

$sounds = array();
//@TEST
$sounds[] = array("name" => "sample", "url" => "speech/sample.mp3");
$sounds[] = array("name" => "c4", "url" => "sound/c4_piano_120.mp3");
//
foreach (glob("sound/*.mp3") as $sound) {
    $soundProps = NULL;
    //bb1_piano_120
    preg_match("/\/(.+?)(\d+)\_(.+?)\_(\d+)\.mp3$/", $sound, $soundProps);

    $soundName = $soundProps[1];
    $soundPitch = $soundProps[2];
    $instrument = $soundProps[3];
    $sampleBpm = $soundProps[4];
    //
    $sounds[] = array("name" => $soundName . $soundPitch, "pitch" => $soundPitch, "instrument" => $instrument, "sampleBpm" => $sampleBpm, "url" => $sound);
    //echo $soundName . $soundPitch; & nbsp; < audio class = "single-sound" id = "<?php echo $soundName; " src = " echo $sound; " controls preload = "auto" autobuffer data - pitch = "<?php echo $soundPitch; " data - instrument = "<?php echo $instrument; " data - bpm = "<?php echo $sampleBpm; " > < /audio>
}

foreach (glob("speech/*.mp3") as $sound) {
    $soundProps = NULL;
    preg_match("/\/(.+?)\.mp3$/", $sound, $soundProps);

    $soundName = $soundProps[1];
    //
    $sounds[] = array("name" => $soundName, "url" => $sound, "speech" => "1");
}

//
$modes = array("major"); //"minor", 
$keys = array("c", "db", "d", "eb", "e", "f", "gb", "g", "ab", "a", "bb", "b");
//
$randomMode = $modes[mt_rand(0, count($modes) - 1)];
$randomKey = $keys[mt_rand(0, count($keys) - 1)];
//
$introTexts = array(
    "TheTwoPeas presents",
    "EULA",
    "in " . ucfirst($randomKey) . " " . $randomMode
);
?><html>
    <head>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

        <script>
            var loadSounds = <?php echo json_encode($sounds); ?>;
            var demoSong = false;

        </script>

        <script src="js/bufferloader.js"></script>
        <script src="js/soundloader.js"></script>
        <script src="js/mubot.js"></script>

        <script>
            var mubot = Mubot.init(<?php echo json_encode($randomKey); ?>, <?php echo json_encode($randomMode); ?>);
            console.log(mubot.myNotes);
            console.log(mubot.myChords);
//
            var currentlyPlayer = 0;
            var currentPartIndex = 0;
            //<span data-checksum="e8f0856031bac72d55ac217259a9d810" data-length="72" class="part">is a legal agreement between you (either an individual or a single entity)</span>

            $(document).on("click", ".part", function () {
                var $this = $(this);
                var checksum = $this.data("checksum");
                var length = $this.data("length");

                console.log($this.index());

                var degree = getDegreeByString(checksum);
                //degree = mubot.arabToRomanNumeric(degree);

                console.log(degree, checksum);
                mubot.getChordOnDegree(degree);
                mubot.getNoteOnDegree(degree, 1);

                //mubot.signUpForBeat(4, mubot.getNoteOnDegree, [degree, 1], 1);
                //mubot.signUpForBeat(8, mubot.getNoteOnDegree, [degree + 1, 1], 1);
                //mubot.signUpForBeat(12, mubot.getNoteOnDegree, [degree + 1, 1], 1);

                playSound(checksum);
            });

            $(function () {
                //$("#intro").fadeOut(500);
                //mubot.signUpForBeat(1, startReading, [], -1);

                $("#intro_wait").fadeIn(100);

                mubot.signUpForBeat(8, introFirst, [], 1);

                //mubot.signUpForBeat(4, mubot.getChordOnDegree, [3], 4);
            });



            //intro
            function introFirst() {
                $("#intro_wait").fadeOut(100, function() {
                    $("#intro_first").fadeIn(100);
                    mubot.getChordOnDegree(1);
                    mubot.getNoteOnDegree("ii", 1);
                    mubot.signUpForBeat(8, introSecond, [], 1);
                });

                //melodyVariation(random(1, 8));
            }
            function introSecond() {
                $("#intro_second").fadeIn(100);
                mubot.getChordOnDegree(4);
                mubot.getNoteOnDegree("v", 1);
                mubot.signUpForBeat(8, introThird, [], 1);
            }
            function introThird() {
                $("#intro_third").fadeIn(100);
                mubot.getChordOnDegree(5);
                mubot.getNoteOnDegree("vi", 1);
                mubot.signUpForBeat(8, introFourth, [], 1);
            }
            function introFourth() {

                $("#intro").fadeOut(500);
                mubot.signUpForBeat(1, startReading, [], -1);
            }


            var tooMuchTalk = 0;
            function startReading() {
                var rand = 0;
                do {
                    rand = random(1, 16);
                } while (lastVariation === rand);
                lastVariation = rand;
                //
                melodyVariation(rand);

                if (tooMuchTalk > 2) {
                    isPlayingSpeech = false;
                    tooMuchTalk = 0;
                }
                if (isPlayingSpeech) {
                    tooMuchTalk++;
                    console.log("still talking...");
                    return;
                }

                $(".part:not(.read)").first().click().addClass("read").addClass("active");


                console.log("reading...");
            }
        </script>

        <style type="text/css">
            #canvas {
                width: 50px; height: 10px; 
            }
            #eula {
                padding: 20px; padding-bottom: 60px;
            }

            .part {
                background-color: #FFF;
            }
            .part.active {
                background-color: #CFC;
                -webkit-transition: background-color 1000ms linear;
                -moz-transition: background-color 1000ms linear;
                -o-transition: background-color 1000ms linear;
                -ms-transition: background-color 1000ms linear;
                transition: background-color 1000ms linear;
            }

            .part.active h1, .part.active h2 {
                background-color: #AFA;

                -webkit-transition: background-color 1000ms linear;
                -moz-transition: background-color 1000ms linear;
                -o-transition: background-color 1000ms linear;
                -ms-transition: background-color 1000ms linear;
                transition: background-color 1000ms linear;
            }

            #intro {
                height:100%;
                width:100%;
                position:fixed;
                left:0;
                top:0;
                z-index:1 !important;
                background-color:black;
            }
            #intro #intro_first {

            }
            #intro #intro_second {

            }
            #intro #intro_third {

            }

            #intro #intro_wait {
                font-size: 48px;
            }

            .intro {
                display: none;
                color: white;
                font-size: 50pt;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div id="intro">
            <div id="intro_wait" class="intro">Please wait...</div>

            <div id="intro_first" class="intro"><?php echo $introTexts[0]; ?></div>
            <div id="intro_second" class="intro"><?php echo $introTexts[1]; ?></div>
            <div id="intro_third" class="intro"><?php echo $introTexts[2]; ?></div>
        </div>

        <b id="bpm"></b>
        <br />
        <canvas style="" id="canvas"></canvas>

        <?php if (!empty($_GET["debug"])): ?>
            <button type="button" id="play">Demo note</button>
            <button type="button" id="play_speech">Demo speech</button>

            <button type="button" id="getBeatQueue">Debug my beats</button>
        <?php endif; ?>
        <!--<button type="button" id="stopAll">Okay, I got it!</button>-->

        <input type="button" type="button" id="stopAll" value="Okay, I got it!" onclick="location.href='indexevo.php'" />



        <br />

        <div id="eula">
            <?php
            echo file_get_contents("eula.html");
            ?>
        </div>
    </body>
</html>