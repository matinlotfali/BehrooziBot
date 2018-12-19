<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 8/2/16
 * Time: 9:46 AM
 */

function SetInventory($chatID, $inventoryID, $value)
{
    $db = CreateConnection();
    $db->query("replace into TelegramInventory values ($chatID,$inventoryID,$value)");
    CheckError($db);
    $db->close();
}

function GetInventory($chatID,$inventoryID)
{
    $db = CreateConnection();
    $result=$db->query("select value from TelegramInventory where chatID=$chatID");
    CheckError($db);
    $db->close();
    if($row = $result->fetch_assoc())
	return $row["value"];
    return null;
}

function ClearInventory($chatID)
{
    $db = CreateConnection();
    $db->query("delete from TelegramInventory where chatID=$chatID");
    CheckError($db);
    $db->close();
}

?>
