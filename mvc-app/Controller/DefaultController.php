<?php

class DefaultController extends Controller
{
    public static function getClassName()
    {
        return __CLASS__;
    }
    
    public function indexAction()
    {
        //return $this->render('index.phtml');
        return DefaultController::render('index.phtml');
    }
    
    public function feedbackAction()
    {
         //return $this->render('feedback.phtml');
        return DefaultController::render('feedback.phtml');
    }
}
