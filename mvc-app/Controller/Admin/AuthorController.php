<?php
namespace Controller\Admin;

use Library\Controller;
use Library\Request;
use Model\AuthorRepository;
use Library\Pagination\Pagination;

class AuthorController extends Controller
{
    const AUTHOR_PER_PAGE = 10;
    
    public static function getClassName()
    {
        return __CLASS__;
    }
    
    public function indexAction(Request $request)
    {
        $currentPage = $request->get('page', 1);
        
        $repository = $this->get('repository')->getRepository('Author');
        $count = $repository->count();
        $authors = $repository->findAll(($currentPage-1) * self::AUTHOR_PER_PAGE , self::AUTHOR_PER_PAGE );
       
        $pagination = new Pagination([
            'itemsCount' => $count,
            'itemsPerPage' => self::AUTHOR_PER_PAGE,
            'currentPage' => $currentPage
        ]);
        
//        echo"<pre>";
//        var_dump($pagination);
//         echo"</pre>";
        
        $data = [ 
            'pagination'=>$pagination,
            'authors' => $authors
        ];
       //return $this->render('index.phtml');
        return AuthorController::render('index.phtml', $data); 
    }
   
}

