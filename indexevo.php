<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TheTwoPeas - Hackathon Web Application</title>
    <meta name="description" content="TheTwoPeas Hackathon Web Application">
    <meta name="author" content="Kalmar Gabor, Takacs Pal">
    <link rel="icon" href="css/favicon.ico">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="jquery/jquery-ui.min.css" rel="stylesheet">
    <link href="jquery/jquery-ui.structure.min.css" rel="stylesheet">
    <link href="jquery/jquery-ui.theme.min.css" rel="stylesheet">
    <link href="css/evo.css" rel="stylesheet">

</head>
<body class="blackbg whitetext evobody">

            <div id="maximage" style="display: none;"></div>

        <div id="dialog-message" title="Download complete" style="display: none;">
            <p>
                <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
                Your files have downloaded successfully into the My Downloads folder.
            </p>
            <p>
                Currently using <b>36% of your storage space</b>.
            </p>
        </div>

    <div class="container">
        <h1 class="textcenter mainslogen">Save the Earth If you can</h1>

        <div class="row">
            <div class="col-md-4">
                <h2>Population</h2>
                <p id="population"></p>
            </div>

            <div class="col-md-4">
                <h2>Date</h2>
                <p id="gametime"></p>
            </div>

            <div class="col-md-4">
                <h2>GWP (Gross World Product) ($ billions)</h2>
                <p id="gwp"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <h2>Energy production/consuption (TW)</h2>
                <p id="birthsdeaths"></p>
            </div>

            <div class="col-md-4">
                <h2>Average Global Temperature</h2>
                <p id="temp"></p>
            </div>

            <div class="col-md-4">
                <h2>Expected GWP for next year ($ billions) (%)</h2>
                <p id="growthrate"></p>
            </div>
        </div>

        <!--<div id="gamezone">

        </div>-->
            <br />

            <div class="row">
                <button id="nextyear" class="btn btn-lg btn-primary btn-block" type="submit">Jump to the next year</button>
            </div>

             <br />

            <div class="row">

                <div class="col-md-4 text-center">
                    <div class="coalpic smallpowerpic"></div>
                    <button id="coalpowerplant" class="btn btn-lg btn-primary btn-block addinput" type="submit">Coal power <i id="coal" >25</i> <small>(Cost: 2000)</small></button>
                </div>

                <div class="col-md-4 text-center">
                    <div class="oilpic smallpowerpic"></div>
                    <button id="oilplant" class="btn btn-lg btn-primary btn-block addinput" type="submit">Gas/Oil power <i id="oil">55</i> <small>(Cost: 6000)</small></button>
                </div>

                <div class="col-md-4 text-center">
                    <div class="nuclearpic smallpowerpic"></div>
                    <button id="nuclearpowerplant" class="btn btn-lg btn-primary btn-block addinput" type="submit">Nuclear power <i id="nuclear">10</i> <small>(Cost: 20000)</small></button>
                </div>

            </div>

            <br />

            <div class="row">

                <div class="col-md-4 text-center">
                    <div class="windpic smallpowerpic"></div>
                    <button id="windfarm" class="btn btn-lg btn-primary btn-block addinput" type="submit">Wind power <i id="wind">5</i> <small>(Cost: 1700)</small></button>
                </div>

                <div class="col-md-4 text-center">
                    <div class="solarpic smallpowerpic"></div>
                    <button id="solarpowerplant" class="btn btn-lg btn-primary btn-block addinput" type="submit">Solar power <i id="solar">3</i> <small>(Cost: 18000)</small></button>
                </div>

                <div class="col-md-4 text-center">
                    <div class="geopic smallpowerpic"></div>
                    <button id="geothermalpowerplant" class="btn btn-lg btn-primary btn-block addinput" type="submit">Geothermal power <i id="geo">2</i> <small>(Cost: 3000)</small></button>
                </div>
                <!-- Egész világon arány: 78% fossils, nuclear 5%, renewables 17% - Global Energy Assesment REport 2012 -->
            </div>

            <br />

            <div class="row">

                <div class="col-md-4 text-center">
                    <div class="effpic smallpowerpic"></div>
                    <button id="devefficiency" class="btn btn-lg btn-primary btn-block addinput" type="submit">Increasing efficiency <i id="eff">1</i> <small>(Cost: 10000)</small></button>
                </div>

                <div class="col-md-4 text-center">
                    <div class="batterypic smallpowerpic"></div>
                    <button id="devbattery" class="btn btn-lg btn-primary btn-block addinput" type="submit">Developing battery <i id="battery">1</i> <small>(Cost: 15000)</small></button>
                </div>

                <div class="col-md-4 text-center">
                    <div class="fusionpic smallpowerpic"></div>
                    <button id="devfusion" class="btn btn-lg btn-primary btn-block addinput" type="submit">Developing fusion <i id="fusion">1</i> <small>(Cost: 20000)</small></button>
                </div>

            </div>

            <br />
            <br />

        <div class="row">
            <div class="col-md-6 text-left">
                <button id="resetgame" class="btn btn-lg btn-primary btn-block" type="submit">RESTART</button>
            </div>

            <div class="col-md-6 text-right">
                <button id="startstopgame" class="btn btn-lg btn-primary btn-block" type="submit">END</button>
            </div>
        </div>

    </div>


    <script src="jquery/jquery.min.js"></script>
    <script src="jquery/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

        <script src="js/jquery.cycle.all.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>
        <script src="js/jquery.maximage.min.js"></script>

    <script src="js/evo.js"></script>

</body>
</html>