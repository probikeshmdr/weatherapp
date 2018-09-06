<?php
/**
 * Created by PhpStorm.
 * User: Nirajan
 * Date: 11/28/2017
 * Time: 11:55 PM
 */

require_once('constants.php');

function get_weather_info($zip, $hour){
    if($hour <= 0)
        $hour = 1;
    else if($hour > 12)
        $hour = 12;

    $url_current = OPEN_WEATHER_MAP_BASE_URL_CURRENT . $zip . OPEN_WEATHER_MAP_KEY;
    $url_hourly =  OPEN_WEATHER_MAP_BASE_URL_WEEKLY .  $zip . OPEN_WEATHER_MAP_KEY;

    $results = file_get_contents("{$url_current}");

    if(!is_null($results)) {
        $json = json_decode($results, true);
        $hour = date('H:i');
        $temperature = $json['main']['temp'];
        $temperature=round((KELVIN_TO_FAHRENHEIT_FACTOR*$temperature - KELVIN_TO_FAHRENHEIT_SUBTRACT));
        $windSpeed = $json['wind']['speed'];
        $icon = $json['weather']['0']['main'];
        $isday = (intval(substr($hour, 0, 2)) >= 6 && intval(substr($hour, 0, 2)) <= 17)?1:0;//
        //strcmp(substr($icon, -1), 'd') == 0 ? 1:0;
        $icon = sanitize_icon_phrase($icon, boolval($isday));
        $icon_phrase = $json['weather']['0']['description'];
        $humidity = $json['main']['humidity'];
        $cloud_cover = $json['clouds']['all'];

        $hour_object[] = array(
            'hour' => $hour,
            'isdaytime' => $isday,
            'icon' => $icon,
            'icon_phrase' => $icon_phrase,
            'temp' => $temperature,
            'real_feel_temp' => $temperature,
            'wind_speed' => $windSpeed,
            'humidity' => $humidity,
            'rain_probability' => "N/A",
            'snow_probability' => "N/A",
            'cloud_cover' => $cloud_cover,
            'prep' => "N/A"
        );
    }

    $results = file_get_contents("{$url_hourly}");
    $json = json_decode($results,true);

    for ($i=0;$i<$hour;$i++)
    {
        $hour = $json['list']["{$i}"]['dt_txt'];
        $hour = trim(substr($hour, strpos($hour, ' '),6));
        $temperature=$json['list']["{$i}"]['main']['temp'];
        $temperature=round((KELVIN_TO_FAHRENHEIT_FACTOR*$temperature - KELVIN_TO_FAHRENHEIT_SUBTRACT));
        $wind_speed = $json['list']["{$i}"]['wind']['speed'];
        $icon = sanitize_icon_phrase($json['list']["{$i}"]['weather']['0']['main'], boolval($isday));
        $isday = (intval(substr($hour, 0, 2)) >= 6 && intval(substr($hour, 0, 2)) <= 17)?1:0;
        //strcmp(substr($icon, -1), 'd') == 0 ? 1:0;
        $icon_phrase = $json['list']["{$i}"]['weather']['0']['description'];
        $humidity = $json['list']["{$i}"]['main']['humidity'];
        $cloud_cover = $json['list']["{$i}"]['clouds']['all'];
        $hour_object[] = array(
            'hour' => $hour,
            'isdaytime' => $isday,
            'icon' => $icon,
            'icon_phrase' => $icon_phrase,
            'temp' => $temperature,
            'real_feel_temp' => $temperature,
            'wind_speed' => $wind_speed,
            'humidity' => $humidity,
            'rain_probability' => "N/A",
            'snow_probability' => "N/A",
            'cloud_cover' => $cloud_cover,
            'prep' => "N/A"
        );
    }
    return $hour_object;
}

?>