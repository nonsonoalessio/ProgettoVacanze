<?php
namespace PHP\App\Config;

use PHP\App\Traits\DatabaseInfo;

require __DIR__ . '/../vendor/autoload.php';

$loadEnv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$loadEnv->load();


class Database{

    use DatabaseInfo;

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


    public static function Varchar($number=100){

        if( $number < 0 ) throw  new \Exception('Inserire un numero maggiore di 0 per VARCHAR');
        
        return "VARCHAR($number) ";

    }

    public static function Date(){

        
        return "Date ";

    }

    public static function Enum(Array $values){

        if( count($values) == 0 ) throw  new \Exception('Inserire dei valori per ENUM');

        $stringToReturn='ENUM(';

        foreach($values as $value){

            $stringToReturn .= " '$value',";

        }
        $stringToReturn[-1] =')';
     

        return $stringToReturn;
    }

    public static function NotNull(){

         return 'NOT NULL ';

    }

    public static function Integer(){

        return 'INTEGER ';

    }

    public static function Float(){

        return 'FLOAT ';

    }
    
    public static function Timestamp(){

        return 'TIMESTAMP ';

    }

    public static function PrimaryKey($autoIncrement=null){

        if( $autoIncrement ) return "AUTO_INCREMENT PRIMARY KEY";

        return "PRIMARY KEY";

    }

    public static function ForeignKey($tableTo, $attributeTo){


        return "REFERENCES $tableTo($attributeTo)";


    }

    

    

    
}



?>