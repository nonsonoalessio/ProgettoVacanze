<?php
namespace PHP\Config\Database;

require __DIR__ . '/../vendor/autoload.php';

$loadEnv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$loadEnv->load();


class Database{

    protected static $nameDb , $usernameDb, $passwordDb, $hostDb;

    protected static function storeDbInfo()
    {
        try{
            
            if( !isset( $_ENV['DB_NAME'] ) ||  !isset( $_ENV['DB_USER'] )  || !isset( $_ENV['DB_PASSWORD'] ) || !isset( $_ENV['DB_HOST'] )) throw new Exception('Controllare file .env , variabile di sistema inesistente');


            self::$nameDb = $_ENV['DB_NAME'];
            self::$usernameDb = $_ENV['DB_USER'];
            self::$passwordDb = $_ENV['DB_PASSWORD'];
            self::$hostDb = $_ENV['DB_HOST'];

        }catch(\Exception $e){

            echo $e->getMessage();
        
        }

    
    
    }

    public static function getNameDb(){
        self::storeDbInfo();

        return self::$nameDb;

    }

    public static function getUsernameDb(){
        self::storeDbInfo();

        return self::$usernameDb;

    }

    public static function getPasswordDb(){

        self::storeDbInfo();

        return self::$passwordDb;

    }

    public static function getHostDb(){

        self::storeDbInfo();

        return self::$hostDb;

    }

    

    
}



?>