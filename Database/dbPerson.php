<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 7/31/16
 * Time: 11:56 PM
 */
function SetPerson($from)
{
    $db = CreateConnection();
    if ($statement = $db->prepare("insert into Person (chatID,firstName,lastName,userName) VALUES (?,?,?,?)
                    ON duplicate key update firstName=?, lastName=?, userName=?")
    )
        if ($statement->bind_param("issssss", $from["id"],
            $from["first_name"], $from["last_name"], $from["username"],
            $from["first_name"], $from["last_name"], $from["username"])
        )
            $statement->execute();
    CheckError($db);
    $db->close();
}

function IsPhoneNumberSet($id)
{
    $db = CreateConnection();
    $result = $db->query("select phone from Person where chatID=$id and phone is not NULL");
    CheckError($db);
    $db->close();
    if ($result->fetch_assoc())
        return true;
    else
        return false;
}

function GetPhoneNumber($id)
{
    $db = CreateConnection();
    $result = $db->query("select phone from Person where chatID=$id and phone is not NULL");
    CheckError($db);
    $db->close();
    if ($row = $result->fetch_assoc())
        return $row["phone"];
    else
        return null;
}

function InsertPhoneNumber($id, $phone)
{
    if ($phone[0] != "+")
        $phone = "+" . $phone;
    $db = CreateConnection();
    $db->query("update Person set phone=$phone where chatID=$id");
    CheckError($db);
    $db->close();
}

function GetMenuState($id)
{
    $db = CreateConnection();
    $result = $db->query("select menuState from Person where chatID=$id");
    CheckError($db);
    if (!($row = $result->fetch_assoc()))
        LogF("Error: chatID not found");
    $db->close();
    return $row["menuState"];
}

function SetMenuState($id, $state)
{
    $db = CreateConnection();
    $db->query("update Person set menuState=$state where chatID=$id");
    CheckError($db);
    $db->close();
}


?>
