<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 8/2/16
 * Time: 11:43 AM
 */
class InsertReportGetActivity implements iState
{
    public function NextState($message)
    {
        if ($message["text"] == Language::Back)
            return States::MainMenu;

        foreach (GetActivities() as $activity)
		if($activity["name"] == $message["text"]) {
			SetInventory($message["from"]["id"],0,$activity["id"]);
			return States::InsertReportGetDate;
		}

        return States::InsertReportGetActivity;
    }

    public function GetResult($chatID)
    {
        ClearInventory($chatID);
        $reply = new Reply("لطفا نوع فعالیت خود را وارد کنید.");
        foreach (GetActivities() as $activity) {
            $reply->AddMenu($activity["name"]);
            $reply->NextRow();
        }
        $reply->AddMenu(Language::Back);
        return $reply;
    }
}
?>
