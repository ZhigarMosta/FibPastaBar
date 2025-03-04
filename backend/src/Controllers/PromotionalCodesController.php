<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PromotionalCodes;

function checkToNull($arrKey,$data,$table){
    foreach ($arrKey as $key) {
        if ($data[$key]===null) {
            return[
                'success' => false,
                'message' => "{$key} can not be null",
                'errors' => $table->getMessages()
            ];
        }
        else{
            $table->assign(["{$key}" => $data[$key]]);
        }
    }
}

function generateCode($length) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $code = '';
    $characterCount = strlen($characters);
    
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $characterCount - 1);
        $code .= $characters[$index];
    }
    
    return $code;
}

class PromotionalCodesController extends BaseController
{
    public function create(){
        $data = $this->request->getPost();
        $promotionalCode = new PromotionalCodes();
        
        $arrDataKeys =['valid_until','discount_percentage']; 
        checkToNull($arrDataKeys ,$data,$promotionalCode);

        if(($data["is_active"]!==null)){
            $promotionalCode->assign(['is_active' => $data['is_active']]);
        }

        if(empty($data["code"])){
            $code = generateCode(10);
            $promotionalCode->assign(['code' => $code]);
        }
        else{
            $promotionalCode->assign(['code' => $data['code']]);
        }

        try{
            if ($promotionalCode->create()) {
                return[
                    'success' => true,
                    'message' => 'Promotional code created',
                    'user' => $promotionalCode
                ];
            } else {
                return[
                    'success' => false,
                    'message' => 'Failed to create promotional code',
                    'user' => $promotionalCode->getMessages()
                ];
            }
        }
        catch(\Throwable $th){
            return[
                'success' => false,
                'message' => $th->getMessage(),
            ];
        }
    }

    public function update(int $id){
        $data = $this->request->getPut();
        $promotionalCodes = PromotionalCodes::findFirst($id);

        if(empty($promotionalCodes)){
            return[
                'success' => false,
                'message' => "Promotional codes not found with id {$id}",
            ];
        }

        foreach (['code', 'valid_until', 'discount_percentage', 'is_active'] as $key) {
            if (!empty($data[$key])) {
                $promotionalCodes->assign(["{$key}" => $data[$key]]);
            }
        }

        if ($promotionalCodes->update()) {
            return[
                'success' => true,
                'message' => 'Promotional codes updated',
                'product' => $promotionalCodes
            ];
        } else {
            return[
                'success' => false,
                'message' => 'Failed to update promotional codes',
                'errors' => $promotionalCodes->getMessages()
            ];
        }

    }

    public function delete(int $id){
        $promotionalCode = PromotionalCodes::findFirst($id);

        if(empty($promotionalCode)){
            return[
                'success' => false,
                'message' => "Promotional codes not found with id {$id}",
            ];
        }

        if ($promotionalCode->delete()) {
            return[
                'success' => true,
                'message' => 'Promotional codes deleted',
                'product' => $promotionalCode
            ];
        } else {
            return[
                'success' => false,
                'message' => 'Failed to delete promotional codes',
                'errors' => $promotionalCode->getMessages()
            ];
        }
    }

    public function activate(){
        $data = $this->request->getJsonRawBody(true);

        $promotionalCode = PromotionalCodes::findFirst([
            "conditions"=> "code = :code:",
            "bind" => [
            'code'=> $data['code'],
        ],]);
        
        if(empty($promotionalCode)){
            return[
                'success' => false,
                'message' => "Not found promotional code with code: {$data['code']}"
            ];
        }

        $today = date("Y-m-d H:i:s");
    
        if($today > $promotionalCode->valid_until){
            return[
                'success' => false,
                'message' => "Promotional сode expired"
            ];
        }
        if($promotionalCode->is_active==0){
            return[
                'success' => false,
                'message' => "Promotional сode not active"
            ];
        }

        return[
            'success' => true,
            'message' => "discount actived",
            'discount' => $promotionalCode->discount_percentage
        ];
       
    }
}
