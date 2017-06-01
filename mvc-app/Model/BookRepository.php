<?php

namespace Model;
//use Library\DbConnection;
use Library\PdoAwareTrait;
use Model\Entity\Book;

class BookRepository 
{
    use PdoAwareTrait;
    
//    public function findAll()
//    {
//        //$pdo = DbConnection::getInstance()->getPdo();
//        $sth = $this->pdo->query('SELECT * FROM book');
//        return $sth->fetchAll(\PDO::FETCH_ASSOC);
//    }
    
    public function findAllActive()
    {
        $collection = [];
        //$pdo = DbConnection::getInstance()->getPdo();
       
        $sth = $this->pdo->query("SELECT * FROM book WHERE status = 1 ");
        while ($res = $sth->fetch(\PDO::FETCH_ASSOC)) {
           
            $book = (new Book())
                ->setId($res['id'])
                ->setTitle($res['title'])
                ->setPrice($res['price'])
                ->setStatus((bool) $res['status'])
                ->setDescription($res['description'])
                ->setStyle($res['style_id'])
            ;
            $collection[] = $book;
        }
       
        return $collection;
    }
    
    
    public function count()
    {
        $sth = $this->pdo->query('SELECT COUNT(*) AS count FROM book WHERE status = 1');
        return $sth->fetchColumn();
    }
    
    public function findBookById($id){
        $authors_id=[];
        $id = (int) $id;
        $sth = $this->pdo->prepare("SELECT * FROM book JOIN book_author ON book.id = book_author.book_id WHERE book.id = :id");
        $sth->bindParam(':id', $id);
        $sth->execute();
        while ($res = $sth->fetch(\PDO::FETCH_ASSOC)) {
         $authors_id[]=$res['author_id'];
         $book = (new Book())
                ->setId($id)
                ->setTitle($res['title'])
                ->setPrice($res['price'])
                ->setStatus((bool) $res['status'])
                ->setDescription($res['description'])
                ->setStyle($res['style_id'])
                
            ;
        }
        $book->setAuthors($authors_id);        
        return $book;
    }
}
