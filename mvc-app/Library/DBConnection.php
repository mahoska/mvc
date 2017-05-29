<?php
namespace Library;

class DbConnection{
    private $pdo;
    private static $instance;
    
    private function __construct()
    {
        $this->pdo = new \PDO('mysql: host=localhost; dbname=mvc_17_03', 'root', '');
        //при любых ошибках будет выдавать exception
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec("SET NAMES utf8");
    }
    
    private function __clone(){}
    
    public function getPdo(){
        return $this->pdo;
    }
    
    public function __wakeUp(){
        throw new \Exception();
    }

    public static  function getInstance(){
        if(self::$instance == null){
            self::$instance = new DbConnection();
        }

        return self::$instance;
    }
}
