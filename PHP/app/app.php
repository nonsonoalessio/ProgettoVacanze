<?php
namespace PHP\App;
use PHP\App\MethodsDb\Handle;

//loading files
require __DIR__. '/traits/databaseinfo.php';
require __DIR__. '/traits/handle.php';
require __DIR__. '/../config/database.php';

require __DIR__. '/methodsDb/connection.php';
require __DIR__. '/methodsDb/handle.php';



//file in which there are tables
$tables=require( __DIR__. '/../config/tables.php' );


//create tables
foreach ( $tables as $name => $table){

    $result=Handle::createTable($name, $table);

    if( $result ) echo $result;

}

?>