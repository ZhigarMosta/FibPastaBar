<?php

declare(strict_types=1);

namespace App;

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\HeaderController;
use App\Controllers\OrederController;
use App\Controllers\ProductController;
use App\Middlewares\AuthMiddleware;
use App\Middlewares\ResponseMiddleware;
use App\Controllers\PromotionalCodesController;
use App\Controllers\UserController;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\Micro;

use \Phalcon\Mvc\Micro\Collection as MicroCollection;

use Phalcon\DI\FactoryDefault;
use Phalcon\Http\Response\Cookies;

final class Application
{
    public function run():void
    {
        $app = new Micro($this->initDI());
        $this->initRoutes($app);
        $app->after(new ResponseMiddleware);
        $app->before(new AuthMiddleware);
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

        $di->set(
            'cookies',
            fn() => 
                new Cookies(true, "#1dj8$=dp?.ak//j1V$~%*0XaK\xb1\x8d\xa9\x98\x054t7w!z%C*F-Jk\x98\x05\\\x5c")
        );
        
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
        $product->get('/{id}', 'getProductById');

        $header = new MicroCollection();
        $header->setHandler(HeaderController::class,true);
        $header->setPrefix('/api/header');
        $header->get('/', 'index');

        $registration = new MicroCollection();
        $registration->setHandler(AuthController::class,true);
        $registration->setPrefix('/api/auth');
        $registration->post('/registration', 'registration');
        $registration->get('/logout', 'logout');
        $registration->post('/login', 'login');

        $promotionalCode = new MicroCollection();
        $promotionalCode->setHandler(PromotionalCodesController::class,true);
        $promotionalCode->setPrefix('/api/promotional_code');
        $promotionalCode->post('/', 'create');
        $promotionalCode->put('/{id}', 'update');
        $promotionalCode->delete('/{id}', 'delete');
        $promotionalCode->post('/activate', 'activate');

        $user = new MicroCollection();
        $user->setHandler(UserController::class,true);
        $user->setPrefix('/api/user');
        $user->post('/name/change', 'changeName');
        $user->post('/email/change', 'changeEmail');

        $order = new MicroCollection();
        $order->setHandler(OrederController::class,true);
        $order->setPrefix('/api/order');
        $order->post('/', 'create');
        $order->post('/list_by_user_id', 'getOrderListByUserId');
        $order->get('/{id}', 'getOrder');

        $app->mount($category);
        $app->mount($product);
        $app->mount($header);
        $app->mount($registration);
        $app->mount($promotionalCode);
        $app->mount($user);
        $app->mount($order);
        $app->notFound(fn()=>$app->response->setStatusCode(404)->send());
    }
}
