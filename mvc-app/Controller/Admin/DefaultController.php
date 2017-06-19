<?php
namespace Controller\Admin;

use Library\Controller;
use Model\Form\FeedbackForm;
use \Model\FeedbackRepository;
use Library\Request;
use Library\Session;
use Model\Entity\Feedback;



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
    
 
}
