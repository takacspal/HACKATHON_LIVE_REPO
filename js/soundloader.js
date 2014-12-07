window.onload = init;
var context;
var bufferLoader;

function drawBars() {
    var canvas, context, width, height, barWidth, barHeight, barSpacing, frequencyData, barCount, loopStep, i, hue;

    canvas = $('canvas')[0];

    context = canvas.getContext('2d');
    width = canvas.width;
    height = canvas.height;
    barWidth = 10;
    barSpacing = 2;

    context.clearRect(0, 0, width, height);
    frequencyData = new Uint8Array(analyser.frequencyBinCount);
    analyser.getByteFrequencyData(frequencyData);
    //console.log(analyser);
    barCount = Math.round(width / (barWidth + barSpacing));
    loopStep = Math.floor(frequencyData.length / barCount);

    for (i = 0; i < barCount; i++) {
        barHeight = frequencyData[i * loopStep];
        hue = parseInt(120 * (1 - (barHeight / 255)), 10);
        context.fillStyle = 'hsl(' + hue + ',75%,50%)';
        context.fillRect(((barWidth + barSpacing) * i) + (barSpacing / 2), height, barWidth - barSpacing, -barHeight);
    }
}

$(function () {
    setInterval(drawBars, 50);
});

function init() {
    window.AudioContext = window.AudioContext || window.webkitAudioContext;
    context = new AudioContext();

    bufferLoader = new BufferLoader(
            context,
            soundsToLoad,
            finishedLoading
            );

    bufferLoader.load();
}

var biquadFilter;
var analyser;

//

var soundsToLoad = [];
for (var i in loadSounds) {
    soundsToLoad.push(loadSounds[i]["url"]);
}
var sounds = {
};

$(document).on("click", "#play", function () {
    playSound("c4");
});

$(document).on("click", "#play_speech", function () {
    playSound("sample");
});

var distortion;
var gainNode;
var convolver;
//

function finishedLoading(bufferList) {
    analyser = context.createAnalyser();
    distortion = context.createWaveShaper();
    gainNode = context.createGain();
    biquadFilter = context.createBiquadFilter();
    convolver = context.createConvolver();
    console.log(distortion);
    console.log(convolver);

    biquadFilter.type = "allpass";


    var soundsTemp = [];
    for (var i in bufferList) {
        var sound = loadSounds[i];
        soundBuffered = context.createBufferSource();
        soundBuffered.buffer = bufferList[i];
        sound["source"] = (soundBuffered);
        sound["buffer"] = bufferList[i];
        sound["isPlaying"] = false;

        sound["source"]["soundName"] = sound["name"];

        sound["source"].connect(analyser);
        analyser.connect(biquadFilter);
        //distortion.connect(biquadFilter);
        biquadFilter.connect(gainNode);
        //convolver.connect(gainNode);
        gainNode.connect(context.destination);

        sound["source"].onended = function (ev) {
            var soundName = ev.target.soundName;

            sounds[soundName]["isPlaying"] = false;
        };

        sounds[sound["name"]] = sound;
    }

    //biquadFilter.type = "lowshelf";
    //biquadFilter.frequency.value = 1000;
    //biquadFilter.gain.value = 25;
}



function playSound(name) {
    var source = context.createBufferSource();
    source.buffer = sounds[name]["buffer"];
    source.connect(analyser);

    analyser.connect(biquadFilter);
    biquadFilter.connect(gainNode);
    gainNode.connect(context.destination);

    source.start(0);
}