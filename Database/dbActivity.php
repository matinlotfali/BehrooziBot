<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 8/2/16
 * Time: 11:40 AM
 */
function GetActivities()
{
    $db = CreateConnection();
    $result = $db->query("select * from Activity");
    CheckError($db);
    while ($row = $result->fetch_assoc())
	$r[] = $row;
    $db->close();
    return $r;
}
?>
