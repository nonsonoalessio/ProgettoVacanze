<?php
namespace PHP\App\Traits;

trait SubFunctionsDatabase{

    public static function tableIsAlreadyPresent($nameTable){

        $query = self::getPointer()->prepare("SHOW TABLES LIKE '$nameTable'");
        
        $query->execute();
      
        
        $result = $query->setFetchMode(\PDO::FETCH_ASSOC);

        return $result;

    }

      // 'nome_colonna' => 'attributi vari'
      public static function createTable($nameTable ,Array $nameColumnAndAttribute){


        //check if the table is already present
        if( self::tableIsAlreadyPresent($nameTable) ) return new \Exception('Table is already present');


        //starting to create the query
        $query = " CREATE TABLE $nameTable( ";

        
        foreach ( $nameColumnAndAttribute as $name => $attribute ){

            $query .= "$name " . " $attribute,";
            
        }
       
        //to override the last ' ; '
        $query[-1] = ');';
        

        

        
        return self::executeQuery($query);

    }



}



?>