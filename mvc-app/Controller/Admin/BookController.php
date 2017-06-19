<?php
namespace Controller\Admin;

use Library\Controller;
use Library\Request;
use Model\BookRepository;
use Model\AuthorRepository;
use Library\Pagination\Pagination;

class BookController extends Controller
{
    const BOOKS_PER_PAGE = 10;
    
    public static function getClassName()
    {
        return __CLASS__;
    }
    
    public function indexAction(Request $request)
    {
        $currentPage = $request->get('page', 1);
        
        $repository = $this->get('repository')->getRepository('Book');
        $count = $repository->count();
        $books = $repository->findAll(($currentPage-1) * self::BOOKS_PER_PAGE , self::BOOKS_PER_PAGE );
       
        $pagination = new Pagination([
            'itemsCount' => $count,
            'itemsPerPage' => self::BOOKS_PER_PAGE,
            'currentPage' => $currentPage
        ]);
        
//        echo"<pre>";
//        var_dump($pagination);
//         echo"</pre>";
        
        $data = [ 
            'pagination'=>$pagination,
            'books' => $books
        ];
       //return $this->render('index.phtml');
        return BookController::render('index.phtml', $data); 
    }
    
        public function showAction(Request $request){
        $book_id = $request->get('id');  
        $repository_book = $this->get('repository')->getRepository('Book');
        $book = $repository_book->findBookById($book_id);
       
        $authors_id = $book->getAuthors();    
        $repository_author = $this->get('repository')->getRepository('Author');
        $authors = [];
        foreach($authors_id as $author_id){
            $authors[] = $repository_author->findAuthorById($author_id);
        }
        $authors_str = "";
         foreach($authors as $author){
            $authors_str .= $author->getFirstName()." ".$author->getLastName().", ";
         }
         $authors_str = trim($authors_str,', ');
         
         $data = [
            'book' => $book,
            'authors'=>$authors_str
        ];
         
         
        return BookController::render('book_item.phtml',$data); 
    }
    
}

