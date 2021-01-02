<?php
namespace PHP\App\MethodsDb;

use PDOException;
use PHP\App\Traits\SubFunctionsDatabase;
use PHP\App\MethodsDb\Connection;

class Handle extends Connection{

    use SubFunctionsDatabase;

    // 'nome_colonna' => 'attributi vari'
    public static function createTable($nameTable ,Array $nameColumnAndAttribute){


        //check if the table is already present
        if( !self::tableIsAlreadyPresent($nameTable) ) return 'Table is already present';

        //starting to create the query
        $query = " CREATE TABLE $nameTable( ";

        
        foreach ( $nameColumnAndAttribute as $name => $attribute ){

            $query .= "$name " . " $attribute,";

        }

        //to override the last ' ; '
        $query[-1] = ');';
        

        

        
        return self::executeQuery($query);

    }

    public static function executeQuery($query){

        try{

            parent::getPointer()->exec($query);

        }catch(PDOException $e){

            return [ 'error' => $e->getMessage() , 'status' => 0 ];

        }finally{

            parent::closeConnection();

        }


    }




}

?>