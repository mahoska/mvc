<?php
namespace Controller\Admin;

use Library\Controller;
use Library\Request;
use Library\Pagination\Pagination;

class StyleController extends Controller
{
    const STYLE_PER_PAGE = 10;
    
    public static function getClassName()
    {
        return __CLASS__;
    }
    
    public function indexAction(Request $request)
    {
        $currentPage = $request->get('page', 1);
        
        $repository = $this->get('repository')->getRepository('Style');
        $count = $repository->count();
        $styles = $repository->findAll(($currentPage-1) * self::STYLE_PER_PAGE , self::STYLE_PER_PAGE );
      
        $pagination = new Pagination([
            'itemsCount' => $count,
            'itemsPerPage' => self::STYLE_PER_PAGE,
            'currentPage' => $currentPage
        ]);
        
//        echo"<pre>";
//        var_dump($pagination);
//         echo"</pre>";
        
        $data = [ 
            'pagination'=>$pagination,
            'styles' => $styles
        ];
       //return $this->render('index.phtml');
        return StyleController::render('index.phtml', $data); 
    }
    
    
}

