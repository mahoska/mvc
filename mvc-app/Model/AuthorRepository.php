<?php

namespace Model;

//use Library\DbConnection;
use Library\PdoAwareTrait;
use Model\Entity\Author;

class AuthorRepository{
    
  use   PdoAwareTrait;
 
    
    public function findAuthorById($id){
        $id = (int) $id;
        $sth = $this->pdo->prepare("SELECT * FROM author JOIN book_author ON author.id = book_author.author_id WHERE author.id = :id");
        $sth->bindParam(':id', $id);
        $sth->execute();
        $res = $sth->fetch(\PDO::FETCH_ASSOC);
         $author = (new Author())
                ->setId($id)
                ->setFirstName($res['firstName'])
                ->setLastName($res['lastName'])             
            ;       
        return $author;
    }
}
