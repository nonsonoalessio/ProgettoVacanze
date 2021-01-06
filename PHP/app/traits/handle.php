<?php
namespace PHP\App\Traits;


trait SubFunctionsDatabase{

   

      // 'nome_colonna' => 'attributi vari'
      public static function createTable($nameTable ,Array $nameColumnAndAttribute){


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