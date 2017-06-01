<?php
namespace Library;

abstract class Controller 
{
    
    protected $container;
    
    public function setContainer(Container $container)
    {
       $this->container  = $container;
       
       return $this;
    }
    
    public function get($key)
    {
        return $this->container->get($key);
    }
    
    //todo_2: make as public static function (позднее стат связывание)
     public static function getClassName()
    {
        return __CLASS__;
    }
    
      
    public static function render($view, array $args = [])
    { 
        extract($args);
        $dir = str_replace(['\\','Controller'],'',  static::getClassName());
        $file = VIEW_DIR . $dir . DS . $view;

        if(!file_exists($file)){
           throw new \Exception("{$file} not found!".PHP_EOL.__FILE__.PHP_EOL."- in ".__LINE__.PHP_EOL);
        }
        
        ob_start();
        require $file;
        $content = ob_get_clean(); 
        
        ob_start();
        require_once VIEW_DIR.'layout.phtml';
        return ob_get_clean(); 
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

