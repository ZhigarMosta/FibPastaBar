<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Users;
use Phalcon\Http\Response\Cookies;
use Phalcon\Http\Cookie;

class AuthController extends BaseController
{
    public function registration()
    {
        $data = $this->request->getPost();
        $user = new Users();

        $cookies = $this->cookies;
        
        foreach (['email', 'password', 'name'] as $key) {
            if (empty($data[$key])) {
                return[
                    'success' => false,
                    'message' => "{$key} can not be null",
                ];
            }
        }
        
        $hash = password_hash($data["password"], PASSWORD_BCRYPT); 
        
        $user->assign(["password" => $hash]);
        $user->assign(["email" => $data["email"]]);
        $user->assign(["name" => $data["name"]]);

        if ($user->create()) {
            $cookies->set(
                'session',
                json_encode(
                    [
                        'user_id' => $user->id,
                    ]
                ),
            )->send();
            return[
                'success' => true,
                'message' => 'User created',
                'user' => $user
            ];
        } else {
            return[
                'success' => false,
                'message' => 'Failed to create user',
                'user' => $user->getMessages()
            ];
        }
    }

    public function login()
    {
        $data = $this->request->getPost();

        foreach (['email', 'password'] as $key) {
            if (empty($data[$key])) {
                return[
                    'success' => false,
                    'message' => "{$key} can not be null",
                ];
            }
        }

        $user = Users::findFirst([
            "conditions"=> "email = :email:",
            "bind" => [
            'email'=> $data['email'],
        ],]);

        if(empty($user)){
            return[
                'success' => false,
                'message' => "Not found user with email: {$data['email']}"
            ];
        }
        if (!password_verify($data["password"], $user->password)) {
            return[
                'success' => false,
                'message' => "Invalid password"
            ];
        }

        $cookies = $this->cookies;

        if(!empty($cookies->get("session")->getValue('user_id'))){
            return[
                'success' => false,
                'message' => "User is logined"
            ];
        }

        $cookies->set(
            'session',
            json_encode(
                [
                    'user_id' => $user->id,
                ]
            ),
        )->send();

      return[
            'success' => true,
            'message' => "user is login"
        ];
    }

    public function logout()
    {
        $cookies = $this->cookies->get("session");
        $cookies->delete("session");
        
        return[
            'success' => true,
            'message' => "user is logout"
        ];
    } 
}
