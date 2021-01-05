<?php 
namespace PHP\App\MethodsDb;


use PDO;
use PDOException;

use PHP\App\Config\Database;

class Connection{

    protected static $database;

    public static function connectionToDb()
    {
        try{

            //connessione al db
            self::$database = new PDO("mysql:host=" . Database::getHostDb(), Database::getUsernameDb() , Database::getPasswordDb());
            
            //get databases on server
            $stmt = self::$database->prepare("show databases");
            $result = $stmt->execute(array("i"=>456));
            foreach ( $stmt->fetchAll() as $dbName ){

               
                if($dbName['Database'] == Database::getNameDb() ){

                    self::$database->query('use ' . Database::getNameDb());
                    return self::$database;
                }

            }

            self::$database->query('CREATE DATABASE ' . Database::getNameDb());
            self::$database->query('use '. Database::getNameDb());

            return self::$database;

        }catch(PDOException $e){

            return  $e->getMessage();
        
        }
    }

    public static function getPointer(){
    
        return self::connectionToDb();
    
    }

    public static function closeConnection(){

        return ( self::$database = null );

    }

    


}

?>