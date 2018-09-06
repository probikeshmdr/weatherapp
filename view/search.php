<?php
/**
 * Created by PhpStorm.
 * User: Ranjan Dahal
 * Date: 11/23/17
 * Time: 7:49 PM
 */
require_once('../model/accuweather.php');
require_once('../model/darksky.php');
require_once('../model/openweathermap.php');
require_once('../model/noaa.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'search';
    }
}

date_default_timezone_set('EST');
$search = filter_input(INPUT_GET, 'search');

$search = trim($search, ' ');
//print_r($search);
if(is_numeric($search) && strlen($search) == 5){
    $loc_key = get_zip_id($search);
}else{
    $loc_key = get_city_id($search);
}

//OpenWeather
$weather_data[] = get_weather_info($loc_key['postal'], 4);

//DarkSky
$weather_data[] = darksky_forecast_hourly($loc_key['geo'], 12);

//Accuweather data pull
$weather_data[] = get_12hour_forcast($loc_key['key']);

//NOOA
$weather_data[] = noaa_forecast($loc_key['postal'], 12);

print_r(json_encode($loc_key));
print_r(json_encode($weather_data));
?>