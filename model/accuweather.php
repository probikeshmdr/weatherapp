<?php
/**
 * Created by PhpStorm.
 * User: Ranjan Dahal
 * Date: 11/23/17
 * Time: 6:24 PM
 */

require_once('constants.php');

function get_icon_url($icon_phrase){
    if(strcmp(strtolower($icon_phrase), 'broken clouds') == 0)
        return 'icons/intermittentClouds.png';
    else if(strcmp(strtolower($icon_phrase), 'overcast clouds') == 0)
        return 'icons/MostlyCloudy.png';
    else if(strcmp(strtolower($icon_phrase), 'broken clouds') == 0)
        return 'icons/intermittentClouds.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else if(strcmp(strtolower($icon_phrase), '') == 0)
        return 'icons/.png';
    else
        return 'icons/night.png';
}

/**
 * Returns current user ip address to determine location
 * @param $ip
 * @return array|bool
 */
function get_current_location_id($ip){
    $url = LOCATION_IP_URL . ACCU_WEATHER_KEY;
    $query = '&q=' . rawurlencode("{$ip}");

    $results = file_get_contents(html_entity_decode($url . $query));
    $results = json_decode($results, true);

    if(!is_null($results)) {
        $local_name = $results['LocalizedName'];
        $key = $results['Key'];
        $zip = $results['PrimaryPostalCode'];
        $state = $results['AdministrativeArea']['ID'];
        $geo = array('lat' => $results['GeoPosition']['Latitude'],
            'lon' => $results['GeoPosition']['Longitude']);

        $ip_object = array(
            'localname' => $local_name,
            'key' => $key,
            'postal' => $zip,
            'state' => $state,
            'geo' => $geo
        );
        return $ip_object;
    }
    return false;
}

/**
 * Returns AccuWeather specific city id based on city name for accurate weather data
 * @param $city
 * @return array|bool
 */
function get_city_id($city){
    $url = LOCATION_CITY_URL . ACCU_WEATHER_KEY;
    $query = '&q=' . rawurlencode("{$city}");

    $results = file_get_contents($url . $query);
    $results = json_decode($results, true);
    //echo $url.$query;
    if(!is_null($results)) {
        foreach ($results as $result) {
            if (strcmp($result['Country']['ID'], 'US') == 0) {
                $local_name = $result['LocalizedName'];
                $key = $result['Key'];
                $zip = $result['PrimaryPostalCode'];
                $state = $result['AdministrativeArea']['ID'];
                $geo = array('lat' => $result['GeoPosition']['Latitude'],
                    'lon' => $result['GeoPosition']['Longitude']);
                break;
            }
        }
        $city_object = array(
            'localname' => $local_name,
            'key' => $key,
            'postal' => $zip,
            'state' => $state,
            'geo' => $geo
        );
        return $city_object;
    }
    return false;
}

/**
 * Returns AccuWeather specific zip id based on zip code for accurate weather data
 * @param $zip
 * @return array|bool
 */
function get_zip_id($zip){
    $url = LOCATION_ZIP_URL . ACCU_WEATHER_KEY;
    $query = '&q=' . rawurlencode("{$zip}");

    $results = file_get_contents($url . $query);
    $results = json_decode($results, true);

    if(!is_null($results)) {
        $local_name = $results[0]['LocalizedName'];
        $key = $results[0]['Key'];
        $state = $results[0]['AdministrativeArea']['ID'];
        $geo = array('lat' => $results[0]['GeoPosition']['Latitude'],
            'lon' => $results[0]['GeoPosition']['Longitude']);

        $zip_object = array('localname' => $local_name,
            'key' => $key,
            'postal' => $zip,
            'state' => $state,
            'geo' => $geo
        );

        return $zip_object;
    }
    return false;
}

/**
 * Returns current hour weather data
 * @param $key
 * @return array|bool
 */
function get_current_forecast($key){
    $url = CURRENT_FORECAST_URL . $key . ACCU_WEATHER_KEY . '&details=true';

    //echo $url;
    $result = file_get_contents($url);
    $result = json_decode($result, true);

    //echo $result;
    if(!is_null($result)) {
        $hour = $result[0]['LocalObservationDateTime'];
        $hour = substr($hour, strpos($hour, 'T') + 1, 5);
        $isday = boolval($result[0]['IsDayTime']);
        $icon = sanitize_icon_phrase($result[0]['WeatherText'], $isday);
        $icon_phrase = $result[0]['WeatherText'];
        $temp = $result[0]['Temperature']['Imperial']['Value'];
        $real_feel_temp = $result[0]['RealFeelTemperature']['Imperial']['Value'];
        $wind_speed = $result[0]['Wind']['Speed']['Imperial']['Value'];
        $humidity = $result[0]['RelativeHumidity'];
        $rain_probability = $result[0]['PrecipitationSummary']['Precipitation']['Imperial']['Value'];
        $snow_probability = 'N/A'; //$result[0]['SnowProbability'];
        $cloud_cover = $result[0]['CloudCover'];
        $prep_probability = $result[0]['PrecipitationSummary']['Precipitation']['Imperial']['Value'];
        $current_hour_object = array(
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
        return $current_hour_object;
    }
    return false;
}

/**
 * Returns One hours weather forecast
 * @param $key
 * @return array|bool
 */
function get_1hour_forcast($key){
    $url = FORECASE_1HOUR_URL . $key . ACCU_WEATHER_KEY . '&details=true';

    //Get current weather forecast
    $hour_object[] = get_current_forecast($key);

    $results = file_get_contents($url);
    $results = json_decode($results, true);

    if(!is_null($results)) {
        foreach ($results as $result) {
            $hour = $result['DateTime'];
            $hour = substr($hour, strpos($hour, 'T') + 1, 5);
            $isday = boolval($result['IsDaylight']);
            $icon = sanitize_icon_phrase($result['IconPhrase'], $isday);
            $icon_phrase = $result['IconPhrase'];
            $temp = $result['Temperature']['Value'];
            $real_feel_temp = $result['RealFeelTemperature']['Value'];
            $wind_speed = $result['Wind']['Speed']['Value'];
            $humidity = $result['RelativeHumidity'];
            $rain_probability = $result['RainProbability'];
            $snow_probability = $result['SnowProbability'];
            $cloud_cover = $result['CloudCover'];
            $prep_probability = $result['PrecipitationProbability'];
        }
        $hour_object[] = array(
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
        return $hour_object;
    }
    return false;
}

/**
 * Returns 12 hours weather forecast
 * @param $key
 * @return array|bool
 */
function get_12hour_forcast($key){
    $url = FORECASE_12HOUR_URL . $key . ACCU_WEATHER_KEY . '&details=true';

    //Get current weather forecast
    $hour12_object[] = get_current_forecast($key);

    $results = file_get_contents($url);
    $results = json_decode($results, true);
    $counter = 1;
    if(!is_null($results)) {
        foreach ($results as $result) {
            $hour = $result['DateTime'];
            $hour = substr($hour, strpos($hour, 'T') + 1, 5);
            $isday = boolval($result['IsDaylight']);
            $icon = sanitize_icon_phrase($result['IconPhrase'], $isday);
            $icon_phrase = $result['IconPhrase'];
            $temp = $result['Temperature']['Value'];
            $real_feel_temp = $result['RealFeelTemperature']['Value'];
            $wind_speed = $result['Wind']['Speed']['Value'];
            $humidity = $result['RelativeHumidity'];
            $rain_probability = $result['RainProbability'];
            $snow_probability = $result['SnowProbability'];
            $cloud_cover = $result['CloudCover'];
            $prep_probability = $result['PrecipitationProbability'];
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
            $counter++;
            if($counter == 12) break;
        }
        return $hour12_object;
    }
    return false;
}

/**
 * Returns json data for daily forecast.
 * Note: This is not in use due to Professor requirement of weather data under 12 hours
 * @param $key
 * @return bool|mixed|string
 */
function get_daily_forcast($key){
    $url = FORECASE_DAILY_URL . $key . ACCU_WEATHER_KEY;

    $results = file_get_contents(html_entity_decode($url));
    $results = json_decode($results, true);

    return $results;
}