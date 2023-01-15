<?php

class Database{

    public static $connection;

    public static function setUpconnection(){
        if(!isset(Database::$connection)){
            Database::$connection = new mysqli("localhost","root","Abdullah2004*","webprogrammingexam","3306");
        }
    }

    public static function iud($q){
        Database::setUpconnection();
        Database::$connection->query($q);
    }

    public static function search($q){
        Database::setUpconnection();
        $resultset = Database::$connection->query($q);
        return $resultset;
    }

}

?>