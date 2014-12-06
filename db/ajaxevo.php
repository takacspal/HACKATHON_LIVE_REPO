<?php
    session_start();

        $onesec = 60*60*24;

        $population = 7000000000;
        $populationchange = 1000;

        $gwp = 74909;
        $gwpchange = 10;

        $births = 123; //ebbe nincs minusz
        $deaths = 123; //ebbe nincs minusz

        $temp_c = 14; //
        $temp_f = ($temp_c*1.8000)+32; //
        $tempchange = 0.1;


    switch($_POST["task"]) {

        case "reset":
            session_destroy();

            $arr = array();

            $arr["population"]   = "";
            $arr["gametime"]     = "";
            $arr["gwp"]          = "";
            $arr["birthsdeaths"] = "";
            $arr["temp"]         = "";
            $arr["growthrate"]   = "";

            echo json_encode($arr);

        break;

        case "game":

            if( !array_key_exists("gametimestart", $_SESSION) ) {
                $_SESSION["gametimestart"] = time();
                $_SESSION["gametimecurr"]  = time();
            } else {
                $_SESSION["gametimecurr"] += $onesec;
            }

            if( !array_key_exists("population", $_SESSION) ) {
                $_SESSION["population"] = $population;
                $_SESSION["populationchange"] = $populationchange;
            } else {
                $_SESSION["population"] += $populationchange;
            }

            if( !array_key_exists("tempc", $_SESSION) ) {
                $_SESSION["tempc"] = $temp_c;
                $_SESSION["tempf"] = ($_SESSION["tempc"]*1.8000)+32;
                $_SESSION["tempchange"] = $tempchange;
            } else {
                $_SESSION["tempc"] += $_SESSION["tempchange"];
                $_SESSION["tempf"] = ($_SESSION["tempc"]*1.8000)+32;
            }


            if( !array_key_exists("gwp", $_SESSION) ) {
                $_SESSION["gwp"] = $gwp;
                $_SESSION["gwpchange"] = $gwpchange;
            } else {
                $_SESSION["gwp"] += $_SESSION["gwpchange"];
            }

            /*
            if( !array_key_exists("", $_SESSION) ) {
                $_SESSION["tempc"] = ;
            } else {
                $_SESSION["tempc"] += $tempchange;
                $_SESSION["tempf"] = ;
            }
            */

                //$curry = date( "Y", $time );
                //$currm = date( "m", $time );
                //$currd = date( "d", $time );

            $arr = array();

            $arr["population"]   = $_SESSION["population"];
            $arr["gametime"]     = date( "Y-m-d", $_SESSION["gametimecurr"] );
            $arr["gwp"]          = $_SESSION["gwp"];
            $arr["birthsdeaths"] = "+123 / -124";
            $arr["temp"]         = $_SESSION["tempf"]." °F ( ".$_SESSION["tempc"]." °C )";
            $arr["growthrate"]   = "+4%";

            $json = json_encode($arr);

            echo $json;

        break;

    }

?>