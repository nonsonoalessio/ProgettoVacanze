<?php 
namespace PHP\App\Traits;

trait DatabaseInfo{

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