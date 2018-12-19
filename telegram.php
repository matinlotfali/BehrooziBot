<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 8/2/16
 * Time: 10:11 AM
 */

class Telegram
{
    public static function SendMessage($chatID,$text,$keyboard=null,$noParse=false)
    {
        $data = array(
            "chat_id" => $chatID,
            "text" => $text,
            "disable_web_page_preview" => true
        );
        if(!$noParse)
            $data["parse_mode"] = "HTML";
        if($keyboard != null)
        {
            $data["reply_markup"] = array(
                "resize_keyboard" => true,
                "one_time_keyboard" => true,
                "keyboard" => $keyboard
            );
        }
        else
            $data["reply_markup"] = array("hide_keyboard" => true);
        
        Post("sendMessage", $data);
    }
}

?>