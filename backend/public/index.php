<?php
require '../vendor/autoload.php';

use App\Application;
try{
    $app = new Application();

    $app->run();
}
catch(\Throwable $th){
    var_dump($th);
}