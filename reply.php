<?php

/**
 * Created by PhpStorm.
 * User: matin
 * Date: 8/1/16
 * Time: 9:54 PM
 */
class Reply
{
    public $text;
    public $menu = array(array());
    private $rowIndex = 0;
    private $colIndex = 0;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function AddMenu($menu, $request_contact = false)
    {
        $this->menu[$this->rowIndex][$this->colIndex] = array(
            "text" => $menu,
            "request_contact" => $request_contact
        );
        $this->colIndex++;
    }

    public function NextRow()
    {
        $this->rowIndex++;
        $this->colIndex = 0;
    }
}