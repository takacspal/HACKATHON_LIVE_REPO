<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TheTwoPeas - Hackathon Web Application</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="jquery/jquery-ui.min.css" rel="stylesheet">
    <link href="jquery/jquery-ui.structure.min.css" rel="stylesheet">
    <link href="jquery/jquery-ui.theme.min.css" rel="stylesheet">
    <link href="css/evo.css" rel="stylesheet">

</head>
<body class="blackbg whitetext">
    <div class="container">
        <h1 class="textcenter">Save The Earth</h1>

        <div class="row">
            <div class="col-md-4">
                <h3>Population</h3>
                <p id="population"></p>
            </div>

            <div class="col-md-4">
                <h3>Date</h3>
                <p id="gametime"></p>
            </div>

            <div class="col-md-4">
                <h3>GWP (Gross world product) ($ billions)</h3>
                <p id="gwp"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <h3>Births/Deaths</h3>
                <p id="birthsdeaths"></p>
            </div>

            <div class="col-md-4">
                <h3>Average Global Temperature</h3>
                <p id="temp"></p>
            </div>

            <div class="col-md-4">
                <h3>Expected Economic growth rate for the next year (%)</h3>
                <p id="growthrate"></p>
            </div>
        </div>

        <div id="gamezone">

        </div>

        <button id="resetgame" class="btn btn-lg btn-primary btn-block" type="submit">RESET</button>

        <button id="startstopgame" class="btn btn-lg btn-primary btn-block" type="submit">STOP</button>

            <br />

            <div class="row">

                <div class="col-md-4 text-center">
                    <button id="coalpowerplant" class="btn btn-lg btn-primary btn-block addinput" type="submit">Coal powerplant</button>
                    <p id="coal" >1</p> <small>(Cost: 2000)</small>
                </div>

                <div class="col-md-4 text-center">
                    <button id="oilplant" class="btn btn-lg btn-primary btn-block addinput" type="submit">Oil plant</button>
                    <p id="oil">1</p> <small>(Cost: 6000)</small>
                </div>

                <div class="col-md-4 text-center">
                    <button id="nuclearpowerplant" class="btn btn-lg btn-primary btn-block addinput" type="submit">Nuclearpowerplant</button>
                    <p id="nuclear">1</p> <small>(Cost: 20000)</small>
                </div>

            </div>

            <br />

            <div class="row">

                <div class="col-md-4 text-center">
                    <button id="windfarm" class="btn btn-lg btn-primary btn-block addinput" type="submit">Wind farm</button>
                    <p id="wind">1</p> <small>(Cost: 1700)</small>
                </div>

                <div class="col-md-4 text-center">
                    <button id="solarpowerplant" class="btn btn-lg btn-primary btn-block addinput" type="submit">Solar power plant</button>
                    <p id="solar">1</p> <small>(Cost: 18000)</small>
                </div>

                <div class="col-md-4 text-center">
                    <button id="geothermalpowerplant" class="btn btn-lg btn-primary btn-block addinput" type="submit">Geothermal power plant</button>
                    <p id="geo">1</p> <small>(Cost: 3000)</small>
                </div>
                <!-- Egész világon arány: 78% fossils, nuclear 5%, renewables 17% - Global Energy Assesment REport 2012 -->
            </div>

            <br />

            <div class="row">

                <div class="col-md-4 text-center">
                    <button id="devefficiency" class="btn btn-lg btn-primary btn-block addinput" type="submit">Increasing energy efficiency</button>
                    <p id="eff">1</p> <small>(Cost: 20000)</small>
                </div>

                <div class="col-md-4 text-center">
                    <button id="devbattery" class="btn btn-lg btn-primary btn-block addinput" type="submit">Developing battery</button>
                    <p id="battery">1</p> <small>(Cost: 40000)</small>
                </div>

                <div class="col-md-4 text-center">
                    <button id="devfusion" class="btn btn-lg btn-primary btn-block addinput" type="submit">Developing fusion</button>
                    <p id="fusion">1</p> <small>(Cost: 100000)</small>
                </div>

            </div>

            <br />

            <div class="row">
                <button id="nextyear" class="btn btn-lg btn-primary btn-block" type="submit">Jump to the next year</button>
            </div>

    </div>


    <script src="jquery/jquery.min.js"></script>
    <script src="jquery/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/evo.js"></script>

</body>
</html>