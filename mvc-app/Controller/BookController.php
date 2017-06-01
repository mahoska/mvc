<?php
namespace Controller;

use Library\Controller;
use Library\Request;
use Model\BookRepository;
use Model\AuthorRepository;


class BookController extends Controller
{
    public static function getClassName()
    {
        return __CLASS__;
    }
    
    public function indexAction()
    {
        $repository = $this->get('repository')->getRepository('Book');
        $books = $repository->findAllActive();
       
        $data = [ 
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

