<?php
require '../vendor/autoload.php';

use App\Application;
try{
    $app = new Application();

    $app->run();
}
catch(\Throwable $th){
    echo json_encode([
        'success' => false,
        'message' => $th->getMessage(),
    ]);
}