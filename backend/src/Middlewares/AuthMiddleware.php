<?php

declare(strict_types=1);

namespace App\Middlewares;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class AuthMiddleware implements MiddlewareInterface
{
    public function call(\Phalcon\Mvc\Micro $app):bool
    {
        $url = $app->request->getURI(true);
        if(preg_match('test1'|'test2',$url)){
            //проверять на куку
            // если кука есть и с ней всё гуд то return true
            // иначе 
            //$app->response->setJsonContent(['success' => false, 'error' => 'сообщение'])->send(); return false

        }
        return true;
    }
}
