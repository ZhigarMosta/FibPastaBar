<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PromotionalCodes;
use App\Request\PromotionalCodesRequest;


class PromotionalCodesController extends BaseController
{
    public function create(){
        $data = $this->request->getPost();
        $promotionalCode = new PromotionalCodes();
        $request = new PromotionalCodesRequest();

        if(!$request->validate($data)){
            return [
                'success' => false,
                'errors' => $request->getErrors()
            ];
        }

        $promotionalCode->assign(['valid_until' => $data['valid_until']]);
        $promotionalCode->assign(['discount_percentage' => $data['discount_percentage']]);


        if($request->validateIsActive($data)){
            $promotionalCode->assign(['is_active' => $data['is_active']]);
        }

        if(!$request->validateCode($data)){
            $promotionalCode->assign(['code' => $request->codeGenerate()]);
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

        $request = new PromotionalCodesRequest();
        if(!$request->promotionalCodeIsFound($promotionalCodes)){
            return[
                'success' => false,
                'message' => $request->getErrors()
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
        $request = new PromotionalCodesRequest();

        if(!$request->promotionalCodeIsFound($promotionalCode)){
            return[
                'success' => false,
                'message' => $request->getErrors()
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
        $request = new PromotionalCodesRequest();

        $promotionalCode = PromotionalCodes::findFirst([
            "conditions"=> "code = :code:",
            "bind" => [
            'code'=> $data['code'],
        ],]);
        
        if(!$request->promotionalCodeIsFound($promotionalCode)){
            return[
                'success' => false,
                'message' => $request->getErrors()
            ];
        }

        $today = strtotime("now");
        $valid_until =strtotime($promotionalCode->valid_until);

        if($today > $valid_until){
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
            'discount' => $promotionalCode->discount_percentage,
            'id' => $promotionalCode->id
        ];
       
    }
}
