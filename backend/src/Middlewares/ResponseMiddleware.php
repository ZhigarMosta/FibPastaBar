<?php

declare(strict_types=1);

namespace App\Middlewares;
use Phalcon\Mvc\Micro\MiddlewareInterface;

class ResponseMiddleware implements MiddlewareInterface
{
    public function call(\Phalcon\Mvc\Micro $app):void
    {
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
            'X-Unicorn-Version',
            // "Set-Cookie",
            // "Cookie",
            // "X-Cookie"
        ];
    
        $app->response->setHeader("Access-Control-Allow-Origin", 'http://localhost:5173')
            ->setHeader("Access-Control-Allow-Methods", 'GET,POST,PUT,PATCH,DELETE,OPTIONS')
            ->setHeader("Access-Control-Allow-Headers", implode(",", $responseHeaders))
            ->setHeader("Access-Control-Allow-Credentials", "true")
            ->setHeader("Access-Control-Max-Age", 3600);

        $app->response->setContent(json_encode($app->getReturnedValue()))->send();       
    }
}
