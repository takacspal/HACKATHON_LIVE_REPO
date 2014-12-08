<?php

    class EarthModel {

            public $onesec; //default one sec one day
            public $population;
            public $populationchange;

                public $populationenergy; //2000x7milliard ~ 15 TW
                public $populationenergychange = 0.4;

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

            public $growthrate;

            /*energy*/ /*one year world consuptopn TW*/ /*15 terawatts*/
            public $coal;
            public $coalenergy = 100; //1000 MW // 40 ~ 4 TW
            public $coalcost = 2000; //2000
            public $coalheat = 0.00001;

            public $oil;
            public $oilenergy = 100; //1000 MW // 30 ~ 3 TW
            public $oilcost = 6000; //6000
            public $oilheat = 0.00001;

            public $nuclear;
            public $nuclearenergy = 200; //one plant 2000 MW //15 ~ 3TW
            public $nuclearcost = 20000; //20000
            public $nuclearheat = 0.00001;

            public $wind;
            public $windenergy = 50; //500 MW // 10 ~ 0,5 TW
            public $windcost = 1700; //1700
            public $windheat = 0.00001;

            public $solar;
            public $solarenergy = 30; //300 MW // 4 ~ 0,12 TW
            public $solarcost = 18000; //18000
            public $solarheat = 0.00001;

            public $geo;
            public $geoenergy = 1; //10 MW // 1 ~ 0,001 TW
            public $geocost = 3000; //3000
            public $geoheat = 0.00001;

            public $eff;        //developments
            public $effcost = 10000; //all energy * x % plus - world heat
            public $effenergy = 0;
            public $effheat = 0; //-heat x eff%

            public $battery;    //developments
            public $batterycost = 15000;
            public $batteryenergy = 0; //all renewable resource energy * x % plus - world heat
            public $batteryheat = 0; //-heat if 100%

            public $fusion; //% //developments
            public $fusioncost = 20000;
            public $fusionenergy = 0; //infinit
            public $fusionheat = 0; //-heat if 100%

            public $input = array();

        function __construct($arr, $input) {

            /*world variables*/
            $this->input = $input;
            $this->checkSession($arr);


        }

        function newinput($kind) {
            if( ($this->gwpchange - $this->{$kind."cost"}) >= 0 ) {

                if( ($kind == "eff" || $kind == "battery" || $kind == "fusion") && $this->$kind < 100 ) { // && || $kind == "battery" || $kind == "fusion"
                    $this->$kind++;
                    $this->gwpchange -= $this->{$kind."cost"};
                } else {
                    $this->$kind++;
                    $this->gwpchange -= $this->{$kind."cost"};
                }

            }

        }

        function input() {
            $this->gametimecurr += $this->onesec;
            $this->population += $this->populationchange;
            $this->tempc += $this->tempchange + ($this->coal*$this->coalheat) + ($this->oil*$this->oilheat) + ($this->nuclear*$this->nuclearheat) - ($this->wind*$this->windheat) - ($this->solar*$this->solarheat) - ($this->geo*$this->geoheat); //
            //$this->gwp = $this->gwpchange;

            $this->births = ( ($this->coal*$this->coalenergy) + ($this->oil*$this->oilenergy) + ($this->nuclear*$this->nuclearenergy) + ($this->wind*$this->windenergy) + ($this->solar*$this->solarenergy) + ($this->geo*$this->geoenergy) ) / 1000; //production
            $this->deaths = round($this->population*$this->populationenergy / 1000000000000, 2); //consuption
                $this->populationenergy += $this->populationenergychange;

            $this->growthrate = round( $this->growthrate + (rand(-5, 5) * 0.01), 2 );

            if( date("Y", $this->gametimecurr) > 2014 && date("m", $this->gametimecurr) == 1 && date("d", $this->gametimecurr) == 1 ) {
                $this->gwp = round( $this->gwp * ($this->growthrate/100 + 1) );
                    $this->growthrate = rand(0, 4);
                $this->gwpchange = $this->gwp;
            }
        }

        function nextyear() {
            $curryear = date("Y", $this->gametimecurr);
            $nextyear = (int)($curryear)+1;
            $nextts   = mktime(0, 0, 0, 1, 1, $nextyear); // //timestamp
            $diff = $nextts - $this->gametimecurr; //get days from this sec
            $diffdays = round( ($diff / 3600) / 24 );

                //change values by diffdays @todo
                    $this->population       += ($this->populationchange*$diffdays);
                    $this->populationenergy += ($this->populationenergychange*$diffdays);
                    $this->tempc            += ( ($this->tempchange + ($this->coal*$this->coalheat) + ($this->oil*$this->oilheat) + ($this->nuclear*$this->nuclearheat) - ($this->wind*$this->windheat) - ($this->solar*$this->solarheat) - ($this->geo*$this->geoheat) ) *$diffdays);
                    //$this->gwp            += ($this->gwpchange*$diffdays);
                    $this->growthrate        = $this->growthrate + rand(-7, 7);
                    $this->gwp               = round( $this->gwp * ($this->growthrate/100 + 1) );
                        $this->growthrate = rand(0, 4);

                    $this->gwpchange = $this->gwp; //

            $this->gametimecurr = $nextts;
        }

        function buffer() {
            $_SESSION["population"] = $this->population;
            $_SESSION["populationchange"] = $this->populationchange;
            $_SESSION["populationenergy"] = $this->populationenergy;
            $_SESSION["gwp"] = $this->gwp;
            $_SESSION["gwpchange"] = $this->gwpchange;
            $_SESSION["births"] = $this->births;
            $_SESSION["deaths"] = $this->deaths;
            $_SESSION["tempc"] = $this->tempc;
            $_SESSION["tempf"] = $this->tempf;
            $_SESSION["tempchange"] = $this->tempchange;
            $_SESSION["gametimestart"] = $this->gametimestart;
            $_SESSION["gametimecurr"] = $this->gametimecurr;

            $_SESSION["growthrate"] = $this->growthrate;

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

            $arr["gametime"]     = date( "Y-m-d", $this->gametimecurr );

            $arr["gwp"]          = $this->gwpchange; //$this->gwp is the const
            $arr["birthsdeaths"] = "+ ".$this->births." / + ".$this->deaths;
            $arr["temp"]         = round($this->tempf, 2)." °F ( ".round($this->tempc, 2)." °C )". " | DEBUG: ". ($this->tempchange + ($this->coal*$this->coalheat) + ($this->oil*$this->oilheat) + ($this->nuclear*$this->nuclearheat) - ($this->wind*$this->windheat) - ($this->solar*$this->solarheat) - ($this->geo*$this->geoheat) ); // . " | DEBUG: ". ($this->tempchange + ($this->coal*$this->coalheat) + ($this->oil*$this->oilheat) + ($this->nuclear*$this->nuclearheat) - ($this->wind*$this->windheat) - ($this->solar*$this->solarheat) - ($this->geo*$this->geoheat) )
            $arr["growthrate"]   = $this->gwp . " (" . $this->growthrate . ")";

            $arr["coal"]    = "(".$this->coal." part)";
            $arr["oil"]     = "(".$this->oil." part)";
            $arr["nuclear"] = "(".$this->nuclear." part)";
            $arr["wind"]    = "(".$this->wind." part)";
            $arr["solar"]   = "(".$this->solar." part)";
            $arr["geo"]     = "(".$this->geo." part)";
            $arr["eff"]     = $this->eff . "%";
            $arr["battery"] = $this->battery . "%";
            $arr["fusion"]  = $this->fusion . "%";

            //TRIGGERS
            $arr["year"]    = date( "Y", $this->gametimecurr );
            $arr["celsius"] = $this->tempc;
            //$arr[""]     = ;

            //we need random events
                //war, explosion, extraterrestial events, etc...

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

            if(array_key_exists("populationenergy", $_SESSION)) {
                $this->populationenergy = $_SESSION["populationenergy"];
            } else {
                $this->populationenergy = $arr["populationenergy"];
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

            if(array_key_exists("growthrate", $_SESSION)) {
                $this->growthrate = $_SESSION["growthrate"];
            } else {
                $this->growthrate = $arr["growthrate"];
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