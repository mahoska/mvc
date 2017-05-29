<?php
namespace Controller;

use Library\Controller;
use Model\BookModel;

class BookController extends Controller
{
    public static function getClassName()
    {
        return __CLASS__;
    }
    
    public function indexAction()
    {
        $model = new BookModel;
        $books = $model->findAll();
        
        $author = 'King';

        $data = [
            'author' => $author, 
            'books' => $books
        ];
       //return $this->render('index.phtml');
        return BookController::render('index.phtml', $data); 
    }
    
}

