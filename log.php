<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 8/2/16
 * Time: 6:36 PM
 */
header("Refresh: 1;url='log.php'");
$file = file("log.log");
for ($i = max(0, count($file)-40); $i < count($file); $i++)
    echo $file[$i] . "<br>";
?>