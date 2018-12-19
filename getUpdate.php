<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 7/31/16
 * Time: 12:38 PM
 */

include "common.php";
include "Database/dbPerson.php";
include "Database/dbInventory.php";
include "Database/dbActivity.php";
include "Database/dbReport.php";
include "language.php";
include "state.php";
include "reply.php";
include "telegram.php";
//include "thread.php";

//if ($_SERVER['REQUEST_METHOD'] != "POST") {
//    LogF("Received " . $_SERVER['REQUEST_METHOD']);
//    die();
//}

$offset = 0;
$processStartTime = microtime(true);
while (microtime(true) - $processStartTime < 60) {
    $loopStartTime = microtime(true);

    $updates = Post("getUpdates", array("offset" => $offset));
    //LogF(json_encode($updates));

    if (array_key_exists("result", $updates))
        foreach ($updates["result"] as $update) {
            $offset = $update["update_id"] + 1;
            if (array_key_exists("message", $update)) {
                $message = $update["message"];
                //$thread = new ProcessMessage($message);
                //$thread->start();
                $from = $message["from"];
                LogF($message["message_id"] . " " . $from["first_name"] . " " . $from["last_name"] . " (" . $from["username"] . ")   " . $message["text"]);
                
                SetPerson($from);

                $state = GetMenuState($from["id"]);
                $state = $stateList[$state]->NextState($message);
                $reply = $stateList[$state]->GetResult($from["id"]);
                SetMenuState($from["id"], $state);

                LogF($message["message_id"] . " Replying...");
                Telegram::SendMessage($from["id"], $reply->text, $reply->menu);
                LogF($message["message_id"] . " Replied.");
            }
        }

    $loopEndTime = microtime(true);
    $sleepTime = 1000000 - ($loopEndTime - $loopStartTime) * 1000000;
    if ($sleepTime > 0)
        usleep($sleepTime);
}
?>
