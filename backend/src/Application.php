<?php

declare(strict_types=1);

namespace App;

use App\Controllers\ProductController;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\Micro;

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

use Phalcon\DI\FactoryDefault;

final class Application
{
    public function run():void
    {
        $app = new Micro($this->initDI());
        
        $this->initRoutes($app);

        $app->handle($_SERVER["REQUEST_URI"]);
    }

    private function initDI():FactoryDefault
    {
        $di = new FactoryDefault;
        $di->setShared("db",fn()=>new Mysql(
            [
                'host'     => 'localhost',
                'username' => 'root',
                'password' => 'kirill',
                'dbname'   => 'FibPastaBar',
            ]
        ));

        return $di;
    }

    private function initRoutes(Micro $app):void
    {
        $product = new MicroCollection();
        $product->setHandler(ProductController::class,true);
        $product->setPrefix('/api/product');

        $product->get('/', 'index');
        $product->post('/', 'create');
        $product->delete('/{id}', 'destroy');

        $app->mount($product);
        $app->notFound(fn()=>$app->response->setStatusCode(404)->send());
    }
}
