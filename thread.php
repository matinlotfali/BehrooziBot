<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 8/2/16
 * Time: 5:44 PM
 */

class ProcessMessage extends Thread
{
    public function __construct($message)
    {
        $this->message = $message;
    }


    public function run()
    {
        global $stateList;
        $from = $this->message["from"];
        LogF($this->message["message_id"] . " " . $from["first_name"] . " " . $from["last_name"] . " (" . $from["username"] . ")   " . $this->message["text"]);

        $db = CreateConnection();
        SetPerson($db, $from);

        $state = GetMenuState($db, $from["id"]);
        $state = $stateList[$state]->NextState($this->message);
        $reply = $stateList[$state]->GetResult($from["id"]);
        SetMenuState($db, $from["id"], $state);

        $db->close();

        LogF($this->message["message_id"] . " Replying...");
        Telegram::SendMessage($from["id"], $reply->text, $reply->menu);
        LogF($this->message["message_id"] . " Replied.");
    }
}

?>