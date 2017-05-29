<?php

namespace Model;
use Library\DbConnection;

class FeedbackModel
{
    public function save(array $feedback)
    {
        $pdo = DbConnection::getInstance()->getPdo();
        $sth = $pdo->prepare('INSERT INTO feedback (author, email, message) VALUES ( :author,:email,:message)');
        return $sth->execute($feedback);
    }
}
