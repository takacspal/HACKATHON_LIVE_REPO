<?php

    class EarthModel {

            public $onesec; //default one sec one day
            public $population;
            public $populationchange;

            public $gwp;
            public $gwpchange;

            public $births;
            public $deaths;

            public $tempc;
            public $tempf;
            public $tempchange; //celsius

            public $gametimestart;
            public $gametimecurr;
            public $gametime;

            /*energy*/
            public $coal;
            public $oil;
            public $nuclear;
            public $wind;
            public $solar;
            public $geo;
            public $eff;
            public $battery;
            public $fusion; //%

            public $input = array();

        function __construct($arr, $input) {

            /*world variables*/
            $this->input = $input;
            $this->checkSession($arr);


        }

        function newinput($kind) {
            $this->$kind++;
        }

        function input() {
            $this->gametimecurr += $this->onesec;
            $this->population += $this->populationchange;
            $this->tempc += $this->tempchange;
            $this->gwp += $this->gwpchange;
        }

        function nextyear() {
            $curryear = date("Y", $this->gametimecurr);
            $nextyear = (int)($curryear)+1;
            $nextts   = mktime(0, 0, 0, 1, 1, $nextyear); // //timestamp
            $diff = $nextts - $this->gametimecurr; //get days from this sec
            $diffdays = round( ($diff / 3600) / 24 );

                //change values by diffdays @todo

            $this->gametimecurr = $nextts;
        }

        function buffer() {
            $_SESSION["population"] = $this->population;
            $_SESSION["populationchange"] = $this->populationchange;
            $_SESSION["gwp"] = $this->gwp;
            $_SESSION["gwpchange"] = $this->gwpchange;
            $_SESSION["births"] = $this->births;
            $_SESSION["deaths"] = $this->deaths;
            $_SESSION["tempc"] = $this->tempc;
            $_SESSION["tempf"] = $this->tempf;
            $_SESSION["tempchange"] = $this->tempchange;
            $_SESSION["gametimestart"] = $this->gametimestart;
            $_SESSION["gametimecurr"] = $this->gametimecurr;

            //inputs
            $_SESSION["coal"]    = $this->coal;
            $_SESSION["oil"]     = $this->oil;
            $_SESSION["nuclear"] = $this->nuclear;
            $_SESSION["wind"]    = $this->wind;
            $_SESSION["solar"]   = $this->solar;
            $_SESSION["geo"]     = $this->geo;
            $_SESSION["eff"]     = $this->eff;
            $_SESSION["battery"] = $this->battery;
            $_SESSION["fusion"]  = $this->fusion;
        }

        function reset() {
            session_destroy();
        }


        function getOutput() {
            $arr = array();
            $arr["population"]   = $this->population;

            $arr["gametime"]     = date( "Y-m-d", $this->gametimecurr )." - ".$this->gametimecurr;

            $arr["gwp"]          = $this->gwp;
            $arr["birthsdeaths"] = "+ ".$this->births." / + ".$this->deaths;
            $arr["temp"]         = round($this->tempf, 2)." °F ( ".round($this->tempc, 2)." °C )";
            $arr["growthrate"]   = "4%";

            $arr["coal"]    = $this->coal;
            $arr["oil"]     = $this->oil;
            $arr["nuclear"] = $this->nuclear;
            $arr["wind"]    = $this->wind;
            $arr["solar"]   = $this->solar;
            $arr["geo"]     = $this->geo;
            $arr["eff"]     = $this->eff;
            $arr["battery"] = $this->battery;
            $arr["fusion"]  = $this->fusion;

            echo json_encode($arr);
        }


        function checkSession($arr) {

            if(array_key_exists("onesec", $_SESSION)) {
                $this->onesec = $_SESSION["onesec"];
            } else {
                $this->onesec = $arr["onesec"];
            }

            if(array_key_exists("population", $_SESSION)) {
                $this->population = $_SESSION["population"];
            } else {
                $this->population = $arr["population"];
            }

            if(array_key_exists("populationchange", $_SESSION)) {
                $this->populationchange = $_SESSION["populationchange"];
            } else {
                $this->populationchange = $arr["populationchange"];
            }

            if(array_key_exists("gwp", $_SESSION)) {
                $this->gwp = $_SESSION["gwp"];
            } else {
                $this->gwp = $arr["gwp"];
            }

            if(array_key_exists("gwpchange", $_SESSION)) {
                $this->gwpchange = $_SESSION["gwpchange"];
            } else {
                $this->gwpchange = $arr["gwpchange"];
            }

            if(array_key_exists("births", $_SESSION)) {
                $this->births = $_SESSION["births"];
            } else {
                $this->births = $arr["births"];
            }

            if(array_key_exists("deaths", $_SESSION)) {
                $this->deaths = $_SESSION["deaths"];
            } else {
                $this->deaths = $arr["deaths"];
            }

            if(array_key_exists("tempc", $_SESSION)) {
                $this->tempc = $_SESSION["tempc"];
            } else {
                $this->tempc = $arr["tempc"];
            }

            if(array_key_exists("tempc", $_SESSION)) {
                $this->tempf = ($_SESSION["tempc"]*1.8000)+32;
            } else {
                $this->tempf = ($arr["tempc"]*1.8000)+32;
            }

            if(array_key_exists("tempchange", $_SESSION)) {
                $this->tempchange = $_SESSION["tempchange"];
            } else {
                $this->tempchange = $arr["tempchange"];
            }

            if( array_key_exists("gametimestart", $_SESSION) && array_key_exists("gametimecurr", $_SESSION) ) {
                $this->gametimestart = $_SESSION["gametimestart"];
                $this->gametimecurr  = $_SESSION["gametimecurr"];
            } else {

                $this->gametimestart = time();
                $this->gametimecurr  = time();
            }

            //inputs

            $inputkey = array("coal", "oil", "nuclear", "wind", "solar", "geo", "eff", "battery", "fusion");

            foreach($inputkey as $in) {
                if(array_key_exists($in, $_SESSION)) {
                    $this->$in = $_SESSION[$in];
                } else {
                    $this->$in = $this->input[$in];
                }
            }
        }
    }

?>