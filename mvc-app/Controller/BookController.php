<?php

class BookController extends Controller
{
    public static function getClassName()
    {
        return __CLASS__;
    }
    
    public function indexAction()
    {
       //return $this->render('index.phtml');
        return BookController::render('index.phtml'); 
    }
    
}

