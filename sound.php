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
?><html>
    <head>

        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

        <script>
            var loadSounds = <?php echo json_encode($sounds); ?>;
            var demoSong = false;

            console.log(loadSounds);
        </script>

        <script src="js/bufferloader.js"></script>
        <script src="js/soundloader.js"></script>
        <script src="js/mubot.js"></script>

        <script>
            var mubot = Mubot.init(testKey, testMode);
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


                playSound(checksum);
            });

            
        </script>

        <style type="text/css">
            .part {

            }
            .part.active {

            }
        </style>
    </head>
    <body>
        <b id="bpm"></b>
        <br />
        <canvas style="width: 500px; height: 300px;"></canvas>

        <button type="button" id="play">play</button>
        <button type="button" id="play_speech">play speech</button>
        <button type="button" id="stopAll">stop!</button>
        <br />

        <div id="eula">
            <?php
            echo file_get_contents("eula.html");
            ?>
        </div>
    </body>
</html>