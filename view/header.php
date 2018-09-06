<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<link>
    <title>WeatherMate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo $app_path?>css/weather-icons.min.css">
    <link rel="stylesheet" href="<?php echo $app_path?>css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/src/loadingoverlay.min.js"></script>
    <script rel="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/extras/loadingoverlay_progress/loadingoverlay_progress.min.js"></script>
</head>
<body>
    <br/>
    <div class="container header">
        <div class="col-md-4" style="text-align: center;">
            <a href="<?php echo $app_path?>index.php" >
                <img src="<?php echo $app_path?>images/WeatherLogo.png" alt="WeatherApp" class="img-fluid">
            </a>
        </div>
        <div class="col-md-8" style="margin-top: 45px;">
            <form name="searchform" id="searchform" action="view/search.php" method="GET">
                <div class="input-group">
                    <input id="search" type="text" class="form-control input-lg" name="search" placeholder="Search Locations" />
                    <span class="input-group-addon"><i id="searchsubmit" class="glyphicon glyphicon glyphicon-search"></i></span>
                </div>
            </form>
        </div>
    </div>
