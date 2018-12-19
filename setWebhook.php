<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 7/31/16
 * Time: 12:38 PM
 */

include "common.php";

header('Content-type: application/json');
//$data = array("url"=>"https://matinlotfali.ddns.net/f/BehrooziBot/getUpdate.php");
$data = null;
$result = Post("setWebhook", $data);
echo var_dump($result);

?>