<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Users;

class UserController extends BaseController
{
    public function changeName(){
        $data = $this->request->getJsonRawBody(true);

        if (empty($data["userId"])) {
            return[
                'success' => false,
                'message' => "User is not authorized",
            ];
        }

        $user = Users::findFirst($data["userId"]);

        if (empty($data["name"])) {
            return[
                'success' => false,
                'message' => "name can not be null",
                'errors' => $user->getMessages()
            ];
        } else{
            $user->assign(["name" => $data["name"]]);
        }
        

        if ($user->update()) {
            return[
                'success' => true,
                'message' => 'User updated',
                'user' => $user
            ];
        } else {
            return[
                'success' => false,
                'message' => 'Failed to update user',
                'errors' => $user->getMessages()
            ];
        }
    }

    public function changeEmail(){
        $data = $this->request->getJsonRawBody(true);

        if (empty($data["userId"])) {
            return[
                'success' => false,
                'message' => "User is not authorized",
            ];
        }

        $user = Users::findFirst($data["userId"]);

        if (empty($data["email"])) {
            return[
                'success' => false,
                'message' => "email can not be null",
                'errors' => $user->getMessages()
            ];
        }

        if(!empty(Users::findFirst([
            "conditions"=> "email = :email:",
            "bind" => [
            'email'=> $data['email'],
        ],]))){
            return[
                'success' => false,
                'message' => "A user with this email already exists",
            ];
        } else{
            $user->assign(["email" => $data["email"]]);
        }

        
        if ($user->update()) {
            return[
                'success' => true,
                'message' => 'User updated',
                'user' => $user,
                "emailuser" => $user->email,
                "dataemail" => $data["email"]
            ];
        } else {
            return[
                'success' => false,
                'message' => 'Failed to update user',
                'errors' => $user->getMessages(),
            ];
        }
    }
}
