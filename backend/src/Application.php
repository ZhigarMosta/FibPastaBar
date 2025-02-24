<?php

declare(strict_types=1);

namespace App;

use App\Controllers\CategoryController;
use App\Controllers\HeaderController;
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
        $app->response->setContentType("application/json");
        $responseHeaders = [
            'Origin',
            'Accept',
            'X-Requested-With',
            'Content-Range',
            'Content-Disposition',
            'Content-Type',
            'Access-Token',
            'Authorization',
            'X-Authorization',
            'X-Unicorn-Version'
        ];
    
        $app->response->setHeader("Access-Control-Allow-Origin", '*')
            ->setHeader("Access-Control-Allow-Methods", 'GET,POST,PUT,PATCH,DELETE,OPTIONS')
            ->setHeader("Access-Control-Allow-Headers", implode(",", $responseHeaders))
            ->setHeader("Access-Control-Allow-Credentials", true)
            ->setHeader("Access-Control-Max-Age", 3600)->send();
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
        $category = new MicroCollection();
        $category->setHandler(CategoryController::class,true);
        $category->setPrefix('/api/category');
        $category->post('/', 'create');
        $category->get('/', 'getCategoriesWithProducts');
        $category->delete('/{id}', 'destroy');
        $category->put('/{id}', 'update');

        $product = new MicroCollection();
        $product->setHandler(ProductController::class,true);
        $product->setPrefix('/api/product');
        $product->get('/', 'index');
        $product->post('/', 'create');
        $product->delete('/{id}', 'destroy');
        $product->put('/{id}', 'update');

        $productById = new MicroCollection();
        $productById->setHandler(ProductController::class,true);
        $productById->setPrefix('/api/productById');
        $productById->post('/', 'getProductById');

        $header = new MicroCollection();
        $header->setHandler(HeaderController::class,true);
        $header->setPrefix('/api/header');
        $header->get('/', 'index');

        $app->mount($category);
        $app->mount($product);
        $app->mount($header);
        $app->mount($productById);
        $app->notFound(fn()=>$app->response->setStatusCode(404)->send());
    }
}
