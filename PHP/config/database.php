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

    public static function Integer($precision=11){

        return "INTEGER($precision) ";

    }

    public static function Float($precisionTotal,$afterComma){

        return "FLOAT($precisionTotal,$afterComma) ";

    }
    
    public static function Datetime(){

        return 'DATETIME ';

    }

    public static function PrimaryKey($autoIncrement=null){

        if( $autoIncrement ) return "AUTO_INCREMENT PRIMARY KEY";

        return "PRIMARY KEY";

    }

    public static function ForeignKey($tableTo, $attributeTo){


        return "REFERENCES $tableTo($attributeTo)";


    }


    public static function CheckDateDiff($date1,$date2){

        if( is_int($date2) ){

            //in questo caso abbiamo il numero di anni e basta convertirlo
            $date2 *= 365;
            return "CHECK ( DATEDIFF('". date('Y-m-d') . "' ,$date1) >= $date2 ) ";

        }

        return "CHECK($date1>$date2) ";

    }

    public static function CheckIfIn($stringToFind,$stringWhereFind){

        return "CHECK ( LOCATE('$stringToFind',$stringWhereFind) != 0 )";

    }
    public static function CheckNumberPositive($number){

        return "CHECK($number>0) ";

    }

    

    

    
}



?>