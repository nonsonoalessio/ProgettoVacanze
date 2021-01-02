<?php
namespace PHP\App;

require __DIR__. '/traits/handle.php';
require __DIR__ . '/../config/database.php';
require __DIR__. '/methodsDb/connection.php';
require __DIR__. '/methodsDb/handle.php';


use PHP\App\MethodsDb\Handle;
$test = [

    'Name' => 'VARCHAR(100) NOT NULL ',
    'Surname' => 'VARCHAR(100)',

];
echo Handle::createTable('tessssdbksjt', $test);

?>