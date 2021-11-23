<?php
class Database{
    private static $_instance = null;
    private $_pdo, 
            $_query,
            $_error = false, 
            $_results, 
            $_count = 0;

    private function __construct(){
        try{
           $this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';port='.Config::get('mysql/port').';dbname='.Config::get('mysql/database'),Config::get('mysql/username'),Config::get('mysql/password'));
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    public static function getMessage()
    {

    }
}