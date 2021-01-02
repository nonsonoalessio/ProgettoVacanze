<?php
namespace PHP\App\Traits;

trait SubFunctionsDatabase{

    public static function tableIsAlreadyPresent($nameTable){

        $query = "DESCRIBE $nameTable;";

       
        return self::executeQuery($query);

    }


}



?>