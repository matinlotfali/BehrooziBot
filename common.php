<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 7/31/16
 * Time: 2:31 PM
 */

ini_set("log_errors", 1);
ini_set("error_log", "log.log");
error_reporting(E_ALL);
ini_set('display_errors', 1);
function LogF($str)
{
    $t = microtime(true);
    $micro = sprintf("%03d", ($t - floor($t)) * 1000);
    error_log(date("Y-m-d H:i:s.") . $micro . "   " . $str . "\n", 3, "log.log");
}

function CheckError($link)
{
    if ($link->errno) {
        LogF("Error No: " . $link->errno . "\n" . $link->error);
        die();
    }
}

function CreateConnection()
{
    $link = new mysqli("graphicboxlab.com", "graphicb_db", "gboxpass88272268", "graphicb_BehrooziBot");
    if ($link->connect_errno) {
        LogF("Error No: " . $link->connect_errno . "\n" . $link->connect_error);
        die();
    }
    $link->set_charset("utf8");
    CheckError($link);
    return $link;
}

function Post($method, $data)
{
    $authenticationToken = "193578742:AAFHJuybfv9iCmgR3rz7JzGmEsIEsBqtW-I";
    $url = "https://api.telegram.org/bot".$authenticationToken."/".$method;
    //$url = "http://149.154.167.200/bot".$authenticationToken."/".$method;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_ENCODING,  '');
    $resultJSON = curl_exec($curl);
    
    $result = json_decode($resultJSON,true);
    if(!$result["ok"])
        LogF($resultJSON);
    curl_close($curl);
    return $result;
}
?>
