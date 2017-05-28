<?php

abstract class Controller 
{
    //todo_2: make as public static function (позднее стат связывание)
     public static function getClassName()
    {
        return __CLASS__;
    }
    
      
    public static function render($view)
    { 
        $dir = str_replace('Controller','',  static::getClassName());
        $file = VIEW_DIR . $dir . DS . $view;

        if(!file_exists($file)){
           throw new \Exception("{$file} not found!");
        }
        
        ob_start();
        require $file;
        return  ob_get_clean(); 
    }
        
        
//    public function render($view)
//    {
//        $dir = str_replace('Controller', '', get_class($this));
//        $file = VIEW_DIR . $dir. DS . $view;
//        if(!file_exists($file)){
//            throw new Exception("{$file} not found");
//        }
//        
//        ob_start();
//        require $file;
//        return ob_get_clean();
//    }
}

