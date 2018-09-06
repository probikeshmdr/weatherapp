<?php
/**
 * Created by PhpStorm.
 * User: WeatherMate Team
 * Date: 11/23/17
 * Time: 6:24 PM
 */
require_once('constants.php');
//$darksky_data_arr = darksky_forecast($lat_long);
/**
 * Returns the darksky weather forecast information in the form of an object.
 * @param $lat_long
 * @param $hours
 * @return array|bool
 */
function darksky_forecast_hourly($lat_long, $hours){
    $latitude = strlen($lat_long['lat'])==0 ? 42.314667 : $lat_long['lat'];
    $longitude = strlen($lat_long['lon'])==0 ? -71.036523 : $lat_long['lon'];
    ini_set("allow_url_fopen",1);
    $url = DARK_SKY_BASE_URL . DARK_SKY_KEY. '/' . $latitude . ',' . $longitude;
    $results = file_get_contents($url);
    $json = json_decode($results,true);
    $loop_count = 0;
    if(!is_null($json)){
        //Hourly Data
        foreach ($json['hourly']['data'] as $key => $result){
            $hour = date('H:i',$result['time']);
            $isday = (intval(substr($hour, 0, 2)) >= 6 && intval(substr($hour, 0, 2)) <= 17)?1:0;
            //strcmp(substr($result['icon'], strripos($result['icon'], '-')+1), 'night') == 0 ? 0:1;
            $icon = sanitize_icon_phrase($result['summary'], $isday);
            $icon_phrase = $result['summary'];
            $temp = round($result['temperature']);
            $real_feel_temp = round($result['apparentTemperature']);
            $wind_speed = round($result['windSpeed'],2);
            $humidity = round($result['humidity'],2);
            $rain_probability = round($result['precipIntensity'],2);
            if(isset($result['precipAccumulation'])){
                $snow_probability = round($result['precipAccumulation'],2);
            }else{
                $snow_probability = 0;
            }
            $cloud_cover = round($result['cloudCover'],2);
            $prep_probability = round($result['precipProbability'],2);
            $hour12_object[] = array(
                'hour' => $hour,
                'isdaytime' => $isday,
                'icon' => $icon,
                'icon_phrase' => $icon_phrase,
                'temp' => $temp,
                'real_feel_temp' => $real_feel_temp,
                'wind_speed' => $wind_speed,
                'humidity' => $humidity,
                'rain_probability' => $rain_probability,
                'snow_probability' => $snow_probability,
                'cloud_cover' => $cloud_cover,
                'prep' => $prep_probability
            );
            $loop_count++;
            if($loop_count == $hours){break;}
        }
        return $hour12_object;
    }
    return false;
}
?>