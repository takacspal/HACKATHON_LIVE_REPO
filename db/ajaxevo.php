<?php
    session_start();

        require_once("earthmodel.class.php");

        $arr = array();
        $arr["onesec"] = 60*60*24; //60*60*24
        $arr["population"] = 7000000000;
        $arr["populationchange"] = 164383; //164383 - year 2050 ~ 10 billion
        $arr["populationenergy"] = 2127;
        $arr["gwp"] = 74909;
        $arr["gwpchange"] = 74909;
        $arr["births"] = 10;
        $arr["deaths"] = 14;
        $arr["tempc"] = 14;
        $arr["tempchange"] = 0.001;

        $arr["growthrate"] = 4; //random growth

        $input = array();
        $input["coal"]    = 25;
        $input["oil"]     = 55;
        $input["nuclear"] = 10;
        $input["wind"]    = 5;
        $input["solar"]   = 3;
        $input["geo"]     = 2;
        $input["eff"]     = 10; //%
        $input["battery"] = 10; //% //new generation battery
        $input["fusion"]  = 2;  //%

        $earth = new EarthModel($arr, $input);

    switch($_POST["task"]) {

        case "reset":
            $earth->reset();

        break;

        case "nextyear":
            $earth->nextyear();
            $earth->buffer();
        break;

        case "newinput":
            $earth->newinput($_POST["newinput"]);
            $earth->buffer();
            echo "ok";
        break;

        case "game":

            $earth->getOutput();

            $earth->input();

            $earth->buffer();

        break;
    }

?>