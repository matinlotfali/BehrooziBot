<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 8/2/16
 * Time: 9:46 AM
 */

function InsertReport($phone, $activityID, $date)
{
    $db = CreateConnection();
    $db->query("insert into Report (phone,activityID,date) values ($phone,$activityID,'$date')");
    CheckError($db);
    $db->close();
}

function DailyReport($phone, $date)
{
    $db = CreateConnection();
    $result = $db->query("call DailyReport($phone,'$date')");
    CheckError($db);
    while($row = $result->fetch_assoc())
	$r[] = $row;
    $db->close();
    return $r;
}

?>
