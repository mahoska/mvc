<?php

namespace Model;

//use Library\DbConnection;
use Library\PdoAwareTrait;
use Model\Entity\Style;

class StyleRepository{
    
  use   PdoAwareTrait;
 
        
     public function findAll($offset, $count)
    {
        $sth = $this->pdo->query("SELECT * FROM style LIMIT {$offset}, {$count}");
        $collection = [];    
        while ($res = $sth->fetch(\PDO::FETCH_ASSOC)) {
           
            $style = (new Style())
                ->setId($res['id'])
                ->setTitle($res['title'])
            ;
            $collection[] = $style;
        }
       
        return $collection;

    }
    
    
    public function count()
    {
        $sth = $this->pdo->query('SELECT COUNT(*) AS count FROM style');
        return $sth->fetchColumn();
    }
}
