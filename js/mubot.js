String.prototype.hashCode = function () {
    var hash = 0;
    if (this.length == 0)
        return hash;
    for (i = 0; i < this.length; i++) {
        char = this.charCodeAt(i);
        hash = ((hash << 5) - hash) + char;
        hash = hash & hash;
    }

    return hash;
}

//
function getDegreeByString(str) {
    var hash = str.hashCode();
    var degree = hash % 7 + 1;
    if (degree < 0) {
        degree *= -1;
    }
    return degree;
}

function getRhythmByString(str) {
    //mondatok vagy szavak alapján válasszunk?

}
//

//
function random(min, max) {
    return Math.round((Math.random() * (min)));
}

var testMode = "minor";
var testKey = "d";
//

//alert(random(1, 5));
//
var beat = 1;
var bar = 1;
//
var bpm = 30;
bpm = (60 / bpm);
bpm = Math.round(bpm * 1000);
console.log(bpm);
//
var variation = Math.round(Math.random() * 4);
var lastVariation = 0;
//

//
var mainMusicTimer = setInterval(function () {
    //whole note (semibreve); half note (minim); quarter note (crotchet); eighth note (quaver); sixteenth note (semiquaver)
    var isWhole = beat % 16 === 0;
    var isHalf = beat % 8 === 0;
    var isQuarter = beat % 4 === 0;
    var isEighth = beat % 2 === 0;
    var isSixteenth = true;
    var currentBeat = {
        "1": isWhole,
        "2": isHalf,
        "4": isQuarter,
        "8": isEighth,
        "16": isSixteenth
    };
    //
    if (demoSong) {
        switch (testMode) {
            case "major":
                if (currentBeat["1"]) {
                    switch (variation) {
                        case 1:
                            mubot.getNoteOnDegree("I", 1);
                            break;

                        case 2:
                            mubot.getNoteOnDegree("V", 1);
                            break;
                        case 3:
                            mubot.getNoteOnDegree("IV", 1);
                            break;
                    }
                }

                if (currentBeat["2"]) {
                    switch (variation) {
                        case 1:
                            mubot.getChordOnDegree("I");
                            break;

                        case 2:
                            mubot.getChordOnDegree("V");
                            break;
                        case 3:
                            mubot.getChordOnDegree("IV");
                            break;
                    }
                }
                break;

            case "minor":
                if (currentBeat["1"]) {
                    switch (variation) {
                        case 1:
                            mubot.getNoteOnDegree("i", 1);
                            break;

                        case 2:
                            mubot.getNoteOnDegree("v", 1);
                            break;
                        case 3:
                            mubot.getNoteOnDegree("iv", 1);
                            break;

                        case 4:
                            mubot.getNoteOnDegree("III", 1);
                            break;
                    }
                }

                if (currentBeat["2"]) {
                    switch (variation) {
                        case 1:
                            mubot.getChordOnDegree("i");
                            break;

                        case 2:
                            mubot.getChordOnDegree("v");
                            break;
                        case 3:
                            mubot.getChordOnDegree("iv");
                            break;

                        case 4:
                            mubot.getChordOnDegree("III");
                            break;
                    }
                }
                /*if (beat == 4) {
                 switch (variation) {
                 case 1:
                 mubot.getNoteOnDegree("i");
                 break;
                 
                 case 3:
                 mubot.getNoteOnDegree("VI");
                 break;
                 }
                 }
                 if (beat == 12) {
                 switch (variation) {
                 case 2:
                 mubot.getNoteOnDegree("III");
                 break;
                 
                 case 4:
                 mubot.getNoteOnDegree("VII");
                 break;
                 }
                 }*/

                switch (variation) {
                    case 1:
                        if (beat == 12) {
                            mubot.getNoteOnDegree("VI");
                        }
                        if (beat == 14) {
                            mubot.getNoteOnDegree("v");
                        }
                        break;
                    case 2:
                        if (beat == 10) {
                            mubot.getNoteOnDegree("VII");
                        }
                        if (beat == 12) {
                            mubot.getNoteOnDegree("VI");
                        }
                        if (beat == 14) {
                            mubot.getNoteOnDegree("v");
                        }
                        break;
                    case 3:
                        if (beat == 10) {
                            mubot.getNoteOnDegree("v");
                        }
                        if (beat == 14) {
                            mubot.getNoteOnDegree("i");
                        }
                        break;

                    case 4:
                        if (beat == 10) {
                            mubot.getNoteOnDegree("v");
                        }
                        if (beat == 12) {
                            mubot.getNoteOnDegree("VI");
                        }
                        if (beat == 14) {
                            mubot.getNoteOnDegree("VII");
                        }
                        break;
                }

                break;
        }
    }
    //


    //
    var beatText = bar + "." + beat;
    console.log(beatText, "whole", isWhole, "half", isHalf, "quarter", isQuarter, "eighth", isEighth, "sixteenth", isSixteenth);

    $("#bpm").html(beatText);
    beat++;
    if (beat % 17 === 0) {
        beat = 1;
        bar++;
        do {
            variation = Math.round(Math.random() * 4);
        } while (variation == lastVariation);
        lastVariation = variation;

    }

}, Math.round(bpm / 16));
//
function playNote(noteName, pitch) {


    if (typeof pitch === "undefined") {
        pitch = 4;
    }
    noteName = noteName;// + "_piano_120";
    playSound(noteName + pitch);

    /*
     var $soundObj = $("#" + noteName + "[data-pitch='" + pitch + "']");
     console.log("#" + noteName + "[data-pitch=4]", $soundObj.length);
     $soundObj.get(0).load();
     $soundObj.get(0).play();*/
}
//

var Mubot = Mubot || {
    testPlay: function () {

    },
    play: function (chord, pattern) {

    },
    calcNewBar: function () {
        var pattern = timing.patterns[Math.floor(Math.random() * timing.patterns.length)];
    },
    //
    currentBar: {
        "rhythm": [], //0-31
        "melody": []
    },
    futureBars: [//ha progressionben vagyunk, akkor az már előre kiszámolt itt, az új progression ezek utánra számolódik már
        []
    ],
    currentDegree: "I",
    currentProgression: "",
    //
    timing: {
        "signature": "4/4",
        "patterns": [
            "4-4-4-4",
            "2-x",
            "2-2",
            "1"
        ]
    },
    soundNames: ["c", "db", "d", "eb", "e", "f", "gb", "g", "ab", "a", "bb", "b"],
    scales: {
        "minor": [2, 1, 2, 2, 1, 2, 2], //(2 1 2 2 1 2 2)
        "major": [2, 2, 1, 2, 2, 2, 1]
    },
    triads: {
        "major": {
            "c": ["c", "e", "g"],
            "db": ["db", "f", "ab"],
            "d": ["d", "gb", "a"],
            "eb": ["eb", "g", "bb"],
            "e": ["e", "ab", "b"],
            "f": ["f", "a", "c"],
            "gb": ["gb", "bb", "db"],
            "g": ["g", "b", "d"],
            "ab": ["ab", "c", "eb"],
            "a": ["a", "db", "e"],
            "bb": ["bb", "d", "f"],
            "b": ["b", "eb", "gb"]
        },
        "minor": {
            "c": ["c", "eb", "g"],
            "db": ["db", "e", "ab"],
            "d": ["d", "f", "a"],
            "eb": ["eb", "gb", "bb"],
            "e": ["e", "g", "b"],
            "f": ["f", "ab", "c"],
            "gb": ["gb", "a", "db"],
            "g": ["g", "bb", "d"],
            "ab": ["ab", "b", "eb"],
            "a": ["a", "c", "e"],
            "bb": ["bb", "db", "f"],
            "b": ["b", "d", "gb"]
        },
        "diminished": {
            "c": ["c", "eb", "gb"],
            "db": ["db", "e", "g"],
            "d": ["d", "f", "ab"],
            "eb": ["eb", "gb", "a"],
            "e": ["e", "g", "bb"],
            "f": ["f", "ab", "cb"],
            "gb": ["gb", "a", "c"],
            "g": ["g", "bb", "db"],
            "ab": ["ab", "b", "d"],
            "a": ["a", "c", "eb"],
            "bb": ["bb", "db", "e"],
            "b": ["b", "d", "f"]
        }
    },
    progressions: [
        ["I", "V", "IV"],
        ["i", "iv", "V"],
                //[2, 6, 1, 5],
                //[1, 5, 3, 6, 5]
    ],
    //
    key: "c",
    scale: "major",
    bpm: 120,
    //
    myNotes: [],
    myChords: {},
    myProgressions: {},
    indexToRoman: {},
    myProgressionChords: [],
    //
    init: function (key, scale) {
        this.key = key;
        this.scale = scale;

        this.myNotes = this.calcScaleSounds();
        this.myChords = this.calcScaleChords();

        return this;
    },
    //
    calcScaleSounds: function () {
        var soundNamesTwice = this.soundNames.concat(this.soundNames);
        var sounds = [];
        var keyIndex = this.soundNames.indexOf(this.key.toLowerCase());
        var intervals = this.scales[this.scale];
        var tempInterval = (keyIndex);
        //
        for (var interval in intervals) {
            var intervalStep = intervals[interval];
            sounds.push(soundNamesTwice[tempInterval]);
            tempInterval = tempInterval + intervalStep;
        }
        //
        return sounds;
    },
    //
    calcScaleChords: function () {
        var notes = this.myNotes;
        var chords = {};
        //
        for (var noteIndex in notes) {
            var note = this.myNotes[noteIndex];
            var roman = this.arabToRomanNumeric(parseInt(noteIndex) + 1);
            var triad = [];
            var validNotes = 0;
            //console.log("Chord for " + note);

            for (var majorTriadIndex in this.triads.major[note]) {
                var triadNote = this.triads.major[note][majorTriadIndex];
                if (this.myNotes.indexOf(triadNote) !== -1) {
                    validNotes += 1;
                }
            }
            if (validNotes === 3) {
                triad = this.triads.major[note];
                //console.log("major");
            }
            //
            validNotes = 0;
            for (var minorTriadIndex in this.triads.minor[note]) {
                var triadNote = this.triads.minor[note][minorTriadIndex];
                if (this.myNotes.indexOf(triadNote) !== -1) {
                    validNotes += 1;
                }

            }
            if (validNotes === 3) {
                roman = roman.toLowerCase();
                triad = this.triads.minor[note];
                //console.log("minor");
            }
            //
            validNotes = 0;
            for (var diminishedTriadIndex in this.triads.diminished[note]) {
                var triadNote = this.triads.diminished[note][diminishedTriadIndex];
                if (this.myNotes.indexOf(triadNote) !== -1) {
                    validNotes += 1;
                }

            }
            if (validNotes === 3) {
                roman = roman.toLowerCase() + "dim";
                triad = this.triads.diminished[note];
                //console.log("diminished");
            }
            this.indexToRoman[noteIndex] = roman;
            chords[roman] = triad;
        }
        //
        return chords;
    },
    //
    getChordOnDegree: function (roman) {
        if (parseInt(roman) == roman) {
            roman = this.indexToRoman[roman];
            if (typeof roman === "undefined") {
                roman = this.indexToRoman[1];
            }
        }

        var chord = this.myChords[roman];
        //
        if (typeof chord === "undefined") {
            throw "NotAvailableDegree: " + roman;
        }

        for (var noteIndex in chord) {
            var note = chord[noteIndex];
            playNote(note);
        }

    },
    getNoteOnDegree: function (roman, pitch) {
        var noteIndex = this.romanToArabNumeric(roman);
        var note = this.myNotes[noteIndex - 1];
        //
        if (typeof note === "undefined") {
            throw "NotAvailableNote: " + roman;
        }

        playNote(note, pitch);

    },
    getPattern: function () {
        /*timing: {
         "signature": "4/4",
         "patterns": [
         "4-4-4-4",
         "2-x",
         "2-2",
         "1"
         ]
         },*/
    },
    //
    arabToRomanNumeric: function (num) {
        var conversions = {
            "1": "I",
            "2": "II",
            "3": "III",
            "4": "IV",
            "5": "V",
            "6": "VI",
            "7": "VII"
        };
        var converted = conversions[num.toString()];
        if (typeof converted === "undefined") {
            throw "OutOfRange: " + num.toString();
        }

        return converted;
    },
    romanToArabNumeric: function (roman) {
        var conversions = {
            "i": 1,
            "ii": 2,
            "iii": 3,
            "iv": 4,
            "v": 5,
            "vi": 6,
            "vii": 7
        };
        roman = roman.toLowerCase();
        var converted = conversions[roman];
        if (typeof converted === "undefined") {
            throw "OutOfRange: " + roman.toString();
        }

        return converted;
    }
};




$(function () {
    $(document).on("click", "#stopAll", function () {
        clearInterval(mainMusicTimer);
    });

});