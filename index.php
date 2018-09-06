<?php
include 'util/main.php';
require('model/ip.php');
require('model/accuweather.php');
require('model/darksky.php');
require('model/openweathermap.php');
require('model/noaa.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'search';
    }
}
date_default_timezone_set('EST');
$ip = get_client_ip();
$ip = '24.63.179.35';
$loc_key = get_current_location_id($ip);

//Weather Channel
$weather_data[] = get_weather_info($loc_key['postal'], 12);

//Dark Sky
$weather_data[] = darksky_forecast_hourly($loc_key['geo'], 12);

//AccuWeather
$weather_data[] = get_12hour_forcast($loc_key['key']);

//NOOA
$weather_data[] = noaa_forecast($loc_key['postal'], 12);

$weather_data = json_encode($weather_data);
include('default.php');
?>
