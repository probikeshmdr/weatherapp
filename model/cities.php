<?php
/**
 * Created by PhpStorm.
 * User: Ranjan Dahal
 * Date: 12/7/17
 * Time: 2:24 PM
 */
require_once ('../util/main.php');

//$file_url = $app_path . 'asset/Cities.txt';
//$file = fopen($file_url,"r");
$file = fopen(__DIR__ . "/../asset/Cities.txt","r");
while(! feof($file)) {
    echo fgets($file );
    echo ';';
}
fclose($file);
?>