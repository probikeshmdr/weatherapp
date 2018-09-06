<?php

define('KELVIN_TO_FAHRENHEIT_SUBTRACT', 459.4);
define('KELVIN_TO_FAHRENHEIT_FACTOR', 1.8);
//9/5 (K - 273) + 32

define('ACCU_WEATHER_BASE_URL', 'http://dataservice.accuweather.com/');
define('ACCU_WEATHER_KEY', '?apikey=Z5znXVA5FRPY7UHrVTJMeIoP46b0Zrkw');
//Nirajan key: JAVF2lEdSJllL7h1ZbeOoVQqj5hABP5p
//Ranjan Key: 0W8rK2H9d8E4fhNPxnbSXZF49SCdLTOl
//Kashyap's key : 5LzrLAPdklkAc38IfiAbFLzCMGYA5j4D
//apikey=Z5znXVA5FRPY7UHrVTJMeIoP46b0Zrkw
//Ranjan: B2mmsmKNzGJepY5va28vNCv5g4ZqInx7
//Key: aLoTp6U1NGNOABkxGGoLWL21DLEimElU
define('CURRENT_FORECAST_URL', ACCU_WEATHER_BASE_URL .'currentconditions/v1/');
define('LOCATION_CITY_URL', ACCU_WEATHER_BASE_URL . 'locations/v1/cities/US/search');
define('LOCATION_IP_URL', ACCU_WEATHER_BASE_URL . 'locations/v1/cities/ipaddress');
define('LOCATION_ZIP_URL', ACCU_WEATHER_BASE_URL . 'locations/v1/postalcodes/US/search');
define('FORECASE_1HOUR_URL', ACCU_WEATHER_BASE_URL . 'forecasts/v1/hourly/1hour/');
define('FORECASE_12HOUR_URL', ACCU_WEATHER_BASE_URL . 'forecasts/v1/hourly/12hour/');
define('FORECASE_DAILY_URL', ACCU_WEATHER_BASE_URL . 'forecasts/v1/daily/1day/');

define('OPEN_WEATHER_MAP_BASE_URL_CURRENT', 'https://api.openweathermap.org/data/2.5/weather?zip=');
define('OPEN_WEATHER_MAP_BASE_URL_WEEKLY','https://api.openweathermap.org/data/2.5/forecast?zip=');
define('OPEN_WEATHER_MAP_KEY','&appid=49d81087680614c83a1c4ee91a328384');
//define('IP_TO_ZIP_BASE_url','http://dataservice.accuweather.com/locations/v1/cities/ipaddress');
//define('IP_TO_ZIP_BASE','?apikey=JAVF2lEdSJllL7h1ZbeOoVQqj5hABP5p&q=');

define('NOAA_BASE_URL','https://api.weather.gov/points');
define('NOAA_KEY','WGtnTKqqyspurDVazfGftfialHmUHaeS');
define('NOAA_FORCAST_HOURLY', '/forecast/hourly');

define('DARK_SKY_BASE_URL','https://api.darksky.net/forecast/');
define('DARK_SKY_KEY','8e5f4349749ce069d55a6f33315dec92');

define('API_XU_URL' , 'http://api.apixu.com/v1/');
define('API_XU_KEY' , '?key=b3211885550e46298b1234025172811');
define('LOC_CITY_URL' , API_XU_URL . 'current.json');
define('LOC_ZIP_URL' , API_XU_URL . 'forecast.json');
define('LOC_IP_URL' , API_XU_URL . 'current.json');
define('LOC_CURRENT' , API_XU_KEY . 'current.json');
define('FORECAST_URL' , API_XU_URL . 'forecast.json');


function sanitize_icon_phrase($icon_phrase, $day){
    $icon_phrase = str_replace(' ', '-', $icon_phrase); // Replaces all spaces with hyphens.
    $icon_phrase = str_replace('-', '', $icon_phrase); // Replaces all hyphens with empty character.
    $icon_phrase = preg_replace('/[^A-Za-z0-9\-]/', '', $icon_phrase);
    $icon_phrase = strtolower($icon_phrase);

    if(strcmp($icon_phrase, 'overcast') == 0 || strcmp($icon_phrase, 'overcastclouds') == 0)
        $icon_phrase = 'drearyovercast';
    else if(strcmp($icon_phrase, 'brokenclouds') == 0)
        $icon_phrase = 'intermittentclouds';
    else if(strcmp($icon_phrase, 'fewclouds') == 0)
        $icon_phrase = 'partlycloudy';
    else if(strcmp($icon_phrase, 'lightrain') == 0)
        $icon_phrase = 'rainandsnow';
    if($day == 1){
        return 'icons/' . $icon_phrase . '.png';
    }else{
        return 'icons/' . $icon_phrase . 'night.png';
    }
}


$icon_map = array();
//OpenWeather mapping
$icon_map['clear sky'] = 'icons/sunny.png';
$icon_map['few clouds'] = 'icons/intermittentclouds.png';
$icon_map['scattered clouds'] = 'icons/mostlycloudy.png';
$icon_map['broken clouds'] = 'icons/mostlycloudy.png';
$icon_map['shower rain'] = 'icons/rain.png';
$icon_map['rain'] = 'icons/rain.png';
$icon_map['thunderstorm'] = 'icons/tstorms.png';
$icon_map['snow'] = 'icons/snow.png';
$icon_map['mist'] = 'icons/flurries.png';
$icon_map['windy'] = 'icons/windy.png';

//Dark Sky mapping
$icon_map['clear-day'] = 'icons/sunny.png';
$icon_map['partly-cloudy-day'] = 'icons/cloudy.png';
$icon_map['cloudy'] = 'icons/cloudy.png';
$icon_map['fog'] = 'icons/fog.png';
$icon_map['rain'] = 'icons/rain.png';
$icon_map['snow'] = 'icons/snow.png';
$icon_map['sleet'] = 'icons/sleet.png';
$icon_map['wind'] = 'icons/wind.png';
$icon_map['partly-cloudy-night'] = 'icons/partlycloudy.png';

//NOAA
//$icon_map[''] = 'icons/.png';
?>

