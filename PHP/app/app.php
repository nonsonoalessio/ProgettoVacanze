<?php
namespace PHP\App;
use PHP\App\MethodsDb\Handle;

//loading files
require __DIR__. '/traits/databaseinfo.php';
require __DIR__. '/traits/handle.php';
require __DIR__. '/../config/database.php';

require __DIR__. '/methodsDb/connection.php';
require __DIR__. '/methodsDb/handle.php';


   echo Handle::createTables();


?>