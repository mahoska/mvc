<?php

namespace Library;

class Router
{
    
    public static function redirect($to)
    {
        header("Location: {$to}");
        die;
    }
}

