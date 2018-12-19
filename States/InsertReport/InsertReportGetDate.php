<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 8/2/16
 * Time: 11:43 AM
 */
class InsertReportGetDate implements iState
{
    public function SendReport($chatID, $phone)
    {
    	$report = DailyReport($phone, date('Y-m-d'));
	$text = "فعالیت های امروز:". "\n"; 
	foreach($report as $r)
	    $text .= $r["name"] . " : " . $r["count"] . "\n";
        Telegram::SendMessage($chatID,$text);	
    }

    public function NextState($message)
    {
        if ($message["text"] == Language::Back)
            return States::MainMenu;
	$activityID = GetInventory($message["from"]["id"],0);
	$phone = GetPhoneNumber($message["from"]["id"]);
	$date = new DateTime();
        if ($message["text"] == Language::Today) {
	    InsertReport($phone,$activityID, $date->format('Y-m-d'));		
	    Telegram::SendMessage($message["from"]["id"],"گزارش با موفقیت ثبت شد.");
	    $this->SendReport($message["from"]["id"],$phone);
            return States::MainMenu;
	}
        if ($message["text"] == Language::Yesterday){
            $date->sub(new DateInterval('P1D'));
	    InsertReport($phone,$activityID, $date->format('Y-m-d'));
	    Telegram::SendMessage($message["from"]["id"],"گزارش با موفقیت ثبت شد.");
	    $this->SendReport($message["from"]["id"],$phone);
            return States::MainMenu;
	}
        if ($message["text"] == Language::Ereyesterday){
            $date->sub(new DateInterval('P2D'));
	    InsertReport($phone,$activityID, $date->format('Y-m-d'));
	    Telegram::SendMessage($message["from"]["id"],"گزارش با موفقیت ثبت شد.");
	    $this->SendReport($message["from"]["id"],$phone);
            return States::MainMenu;
	}

        return States::InsertReportGetDate;
    }

    public function GetResult($chatID)
    {
        $reply = new Reply("لطفا روز فعالیت را وارد کنید.");
        $reply->AddMenu(Language::Today);
        $reply->NextRow();
        $reply->AddMenu(Language::Yesterday);
        $reply->NextRow();
        $reply->AddMenu(Language::Ereyesterday);
        $reply->NextRow();
        $reply->AddMenu(Language::Back);
        return $reply;
    }
}
?>
