<?php
namespace Controller;

use Library\Controller;
use Model\Form\FeedbackForm;
use \Model\FeedbackModel;
use Library\Request;
use Library\Session;



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
    
    public function feedbackAction(Request $request)
    {
        $form = new FeedbackForm($request);
 
        if($request->isPost()){
            $err_str="";//для ошибок;
            //if(!$form->isValid($err_str))throw new \Exception ("bad email:$err_str");
            if($form->isValid($err_str)){
                $model = new FeedbackModel();
                $model->save([
                    'author'=>$form->author,
                    'email'=>$form->email,
                    'message'=>$form->message,
                ]);
                
                Session::setFlash('Feedback sent','success'); 
                $this->get('router')->redirect('/index.php?route=default/feedback');//get определен в Container,заменяет вызов $this->container->get('router')..
            }
            //Session::setFlash('Fill the fields properly sent');
            Session::setFlash($err_str,'error');
        }
        
         //return $this->render('feedback.phtml');
        return DefaultController::render('feedback.phtml',['form'=>$form]);
    }
    
    public function errorAction()
    {
        return DefaultController::render('error.phtml');  
    }
}
