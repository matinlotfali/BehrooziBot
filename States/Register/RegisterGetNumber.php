<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 8/2/16
 * Time: 11:03 AM
 */
class RegisterGetNumber implements iState
{
    public function NextState($message)
    {
        if (array_key_exists("text",$message))
            if ($message["text"] == Language::Back)
                return States::MainMenu;
            else
                $phone = $message["text"];
        else if($message["contact"]["phone_number"] != null)
            $phone = $message["contact"]["phone_number"];
        else
            return States::RegisterGetNumber;

        InsertPhoneNumber($message["from"]["id"],$phone);
        Telegram::SendMessage($message["from"]["id"],"ثبت نام با موفقیت انجام شد.");
        return States::MainMenu;
    }

    public function GetResult($chatID)
    {
        ClearInventory($chatID);
        $reply = new Reply("شماره تلفن همراه خود را وارد کنید.\nمثال: ۹۸۹۱۲۳۴۵۶۷۸");
        $reply->AddMenu(Language::UseTelegramNumber,true);
        $reply->NextRow();
        $reply->AddMenu(Language::Back);
        return $reply;
    }
}
?>
