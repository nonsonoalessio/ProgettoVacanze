<?php
namespace PHP\App\MethodsDb;

use Exception;
use PDOException;
use PHP\App\Traits\SubFunctionsDatabase;
use PHP\App\MethodsDb\Connection;

class Handle extends Connection{

    use SubFunctionsDatabase;

    
    public static function createTables(){

          //file in which there are tables
            $tables=require( __DIR__. '/../../config/tables.php' );


            //create tables
            foreach ( $tables as $name => $table){

                 $result=Handle::createTable($name, $table);

                if( $result ) echo $result;

            }

    }
    

    public static function executeQuery($query){

        try{

            return parent::getPointer()->exec($query);

        }catch(PDOException $e){

            return  $e->getMessage();

        }finally{

            parent::closeConnection();

        }


    }




}

?>