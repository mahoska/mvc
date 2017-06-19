<?php

namespace Library\Pagination;

class Button
{
    public $page;
    public $text;
    public $isActive;
    public $isCurrent;

    public function __construct($page, $isActive = true, $isCurrent = false, $text = null)
    {
        $this->page = $page;
        $this->text = is_null($text) ? $page : $text;
        $this->isActive = $isActive;
        $this->isCurrent = $isCurrent;
    }

    public function activate()
    {
        $this->isActive = true;
    }

    public function deactivate()
    {
        $this->isActive = false;
    }
}