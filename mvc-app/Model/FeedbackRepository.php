<?php

namespace Model;
use Library\PdoAwareTrait;

class FeedbackRepository 
{
    use PdoAwareTrait;
    
    public function save(array $feedback)
    {
        $sth = $this->pdo->prepare('INSERT INTO feedback (author, email, message) VALUES ( :author,:email,:message)');
        return $sth->execute($feedback);
    }
}
