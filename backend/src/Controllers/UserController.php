<?php

declare(strict_types=1);

namespace App\Controllers;

class UserController extends BaseController
{
    public function changeName(){
        $cookies = $this->cookies->get("session");

        return json_decode($cookies->getValue()??"");
    }
}
