<?php

namespace Library;

Trait PdoAwareTrait
{
    protected $pdo;
    
    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;
        return $this;
    }
}
