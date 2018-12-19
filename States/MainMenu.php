<?php

/**
 * Created by PhpStorm.
 * User: matin
 * Date: 8/1/16
 * Time: 10:28 PM
 */
class MainMenu implements iState
{
    public function NextState($message)
    {
        if ($message["text"] == Language::Register) {
            if (!IsPhoneNumberSet($message["from"]["id"]))
                return States::RegisterGetNumber;
        } else if ($message["text"] == Language::InsertActivity) {
            if (IsPhoneNumberSet($message["from"]["id"]))
                return States::InsertReportGetActivity;
        }
        return States::MainMenu;
    }

    public function GetResult($chatID)
    {
        ClearInventory($chatID);
        $reply = new Reply("لطفا گزینه مورد نظر را انتخاب کنید.");
        if (IsPhoneNumberSet($chatID))
            $reply->AddMenu(Language::InsertActivity);
        else
            $reply->AddMenu(Language::Register);
        return $reply;
    }
}

?>
