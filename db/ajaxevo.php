<?php
    session_start();

        require_once("earthmodel.class.php");

        $arr = array();
        $arr["onesec"] = 60*60*24; //60*60*24
        $arr["population"] = 7000000000;
        $arr["populationchange"] = 1000;
        $arr["gwp"] = 74909;
        $arr["gwpchange"] = 10;
        $arr["births"] = 123;
        $arr["deaths"] = 123;
        $arr["tempc"] = 14;
        $arr["tempchange"] = 0.001;

        $input = array();
        $input["coal"]    = 11;
        $input["oil"]     = 12;
        $input["nuclear"] = 55;
        $input["wind"]    = 3;
        $input["solar"]   = 4;
        $input["geo"]     = 5;
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