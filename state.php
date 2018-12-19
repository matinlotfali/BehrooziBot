<?php
/**
 * Created by PhpStorm.
 * User: matin
 * Date: 8/1/16
 * Time: 9:32 PM
 */
include "States/MainMenu.php";
include "States/Register/RegisterGetNumber.php";
include "States/InsertReport/InsertReportGetActivity.php";
include "States/InsertReport/InsertReportGetDate.php";

interface iState
{
    public function NextState($message);

    public function GetResult($chatID);
}

interface States
{
    const MainMenu = 0;
    const RegisterGetNumber = 1;
    const InsertReportGetActivity = 2;
    const InsertReportGetDate = 3;
}

$stateList = array(
    States::MainMenu => new MainMenu(),
    States::RegisterGetNumber => new RegisterGetNumber(),
    States::InsertReportGetActivity => new InsertReportGetActivity(),
    States::InsertReportGetDate => new InsertReportGetDate()
);
?>
