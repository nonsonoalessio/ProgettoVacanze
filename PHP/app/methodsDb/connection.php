<?php 
namespace PHP\App\MethodsDb;


use PDO;
use PDOException;

use PHP\Config\Database\Database;

class Connection{

    protected static $database;

    public static function connectionToDb()
    {
        try{

            //connessione al db
            self::$database = new PDO("mysql:host=" . Database::getHostDb().';dbname=' . Database::getNameDb() , Database::getUsernameDb() , Database::getPasswordDb());
            self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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