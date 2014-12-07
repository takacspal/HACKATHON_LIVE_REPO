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
?><html>
    <head>

        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

        <script>


            var loadSounds = <?php echo json_encode($sounds); ?>;
        </script>
        <script src="js/bufferloader.js"></script>
        <script src="js/soundloader.js"></script>
        <script src="js/mubot.js"></script>
    </head>
    <body>
        <b id="bpm"></b>
        <br />
        <canvas style="width: 800px;"></canvas>

        <button type="button" id="play">play</button><button type="button" id="play_speech">play speech</button>
        <br />



        <button type="button" id="cmajor">C</button>
        <button type="button" id="gmajor">G</button>

        <button type="button" id="dminor">Dm</button>
        <button type="button" id="aminor">Am</button>

        <hr />
        <button type="button" id="stopAll">stop!</button>

        <div id="eula">
            <?php
            echo file_get_contents("eula.html");
            ?>
        </div>
        arpeggiator, chorder, singlenote,progressions
    </body>
</html>