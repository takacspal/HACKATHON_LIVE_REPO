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
        <h1 class="textcenter">Earth Simulation</h1>

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

        <button id="startstopgame" class="btn btn-lg btn-primary btn-block" type="submit">STOP</button>
    </div>

    <script src="jquery/jquery.min.js"></script>
    <script src="jquery/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/npm.js"></script>

    <script src="js/evo.js"></script>

</body>
</html>