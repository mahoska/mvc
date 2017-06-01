<?php

namespace Model;
use Library\PdoAwareTrait;
use Model\Entity\Feedback;

class FeedbackRepository 
{
    use PdoAwareTrait;
    
//    public function save(Feedback $feedback)
//    {
//        
//        $sth = $this->pdo->prepare('INSERT INTO feedback (author, email, message) VALUES ( :author,:email,:message)');
//        return $sth->execute($feedback);
//    }
    
    public function save(Feedback $feedback)
    {
        $sth = $this->pdo->prepare('INSERT INTO feedback (author, email, message) VALUES ( :author,:email,:message)');
        $sth->execute([
            'author' => $feedback->getAuthor(),
            'email' => $feedback->getEmail(),
            'message' => $feedback->getMessage(),
        ]);
    }
}
