<?php 
namespace PDO;

class DatabaseConnection{
    
    private $server;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct($server, $username, $password, $database){

        $this -> server = $server;
        $this -> username = $username;
        $this -> password = $password;
        $this -> database = $database;
   
    }

    public function connect(){
        $this-> connection = new \PDO("mysql:host=$this->server; dbname=$this->database", $this->username, $this-> password);

        $set_names= $this-> connection ->prepare("SET NAMES 'utf8'");
        $set_names-> execute();
    
    }


    public function executeQuery($query, $parameters=[]){
        $statement= $this-> connection-> prepare($query);
        $results= $statement-> execute($parameters);

        return $results;
    }
   
}









?>