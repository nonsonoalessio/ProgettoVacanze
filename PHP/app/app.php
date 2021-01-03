<?php
namespace PHP\App;
require __DIR__. '/traits/databaseinfo.php';
require __DIR__. '/traits/handle.php';
require __DIR__. '/../config/database.php';

require __DIR__. '/methodsDb/connection.php';
require __DIR__. '/methodsDb/handle.php';



use PHP\App\MethodsDb\Handle;

$tables=require( __DIR__. '/../config/tables.php' );
$test = [

    'Name' => 'VARCHAR(100) NOT NULL ',
    'Surname' => 'VARCHAR(100)',

];


foreach ( $tables as $name => $table){

    $result=Handle::createTable($name, $table);

    if( $result ) echo $result;

}

?>