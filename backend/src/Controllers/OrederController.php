<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Orders;
use App\Models\Products;
use App\Models\PromotionalCodes;
use App\Models\Users;
use Phalcon\Paginator\Adapter\Model;
class OrederController extends BaseController
{
    public function create(){
        $data = $this->request->getJsonRawBody(true);
        
        $delivery = $data["delivery"];
        $promotionalCodeId = $data["promotionalCode"];
        $user = $data["user"];

        $order = new Orders();
        if($delivery["pickup"]===false){
            foreach (['sity', 'house', 'entrance', 'apartment','floor'] as $key) {
                if (empty($delivery["addres"][$key])) {
                    return[
                        'success' => false,
                        'message' => "{$key} in addres can not be null",
                    ];
                }
            }

            $order->assign(["addres_sity" => $delivery["addres"]["sity"]]);
            $order->assign(["addres_house" => $delivery["addres"]["house"]]);
            $order->assign(["addres_entrance" => $delivery["addres"]["entrance"]]);
            $order->assign(["addres_apartment" => $delivery["addres"]["apartment"]]);
            $order->assign(["addres_floor" => $delivery["addres"]["floor"]]);
            $order->assign(["addres_code" => $delivery["addres"]["code"]]);
            $order->assign(["addres_name_addres" => $delivery["addres"]["nameAddres"]]);
            $order->assign(["addres_comment_addres" => $delivery["addres"]["commentAddres"]]);
        }



        foreach (['email', 'name'] as $key) {
            if (empty($user[$key])) {
                return[
                    'success' => false,
                    'message' => "{$key} in user can not be null",
                ];
            }
        }

        if(empty($data["backet"])){
            return[
                'success' => false,
                'message' => "Order is empty",
            ];
        }

        $cost=0;
        foreach ($data["backet"] as $key) {
            $products_data[] = [
                'id' => $key["id"],
                'count' => $key["count"],
            ];
            $cost = $cost + $key["price"] * $key["count"];
        }

        if(!empty($promotionalCodeId)){
            $promotionalCode = PromotionalCodes::findFirst($promotionalCodeId);
            if(!empty($promotionalCode)){
                $cost = $cost - ($cost * $promotionalCode->discount_percentage * 0.01);
            }
            $order->assign(["promotional_code_id" => $promotionalCode->id]);
        }

        $order->assign(["user_id" => $user["id"]]);
        $order->assign(["products_data" => json_encode($products_data)]);
        $order->assign(["buyer_name" => $user["name"]]);
        $order->assign(["buyer_email" => $user["email"]]);
        $order->assign(["time" => $data["deliveryTime"]]);
        $order->assign(["cost" => $cost]);

        try{
            if ($order->create()) {
                return[
                    'success' => true,
                    'message' => 'Order created',
                    'order' => $order,
                    'promotional_code' =>$promotionalCode,
                    'products' => $data["backet"]
                ];
            } else {
                return[
                    'success' => false,
                    'message' => 'Failed to create order',
                    'order' => $order->getMessages()
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

    public function getOrderListByUserId() {
        $data = $this->request->getJsonRawBody(true);

        // return ($data);

        $user = Users::findFirst($data["userId"]);
    
        if (!$user) {
            return [
                'success' => false,
                'message' => 'User not found',
            ];
        }

        $conditions = "user_id = :user_id:";
        $bind = [
            'user_id' => $user->id,
        ];

        if (!empty($data["orderId"])) {
            $conditions .= " AND id like :id:";
            $bind['id'] = "%".$data["orderId"]."%";
        }
        
        if (!empty($data["orderStatus"])) {
            $conditions .= " AND status = :status:";
            $bind['status'] = $data["orderStatus"];
        }

        $paginator = new Model(
            [
                'model'  => Orders::class,
                "parameters" => [
                    "conditions" => $conditions,
                    "bind" => $bind,
                    "columns" => [
                        "id",
                        "addres_sity",
                        "addres_house",
                        "addres_name_addres",
                        "cost",
                        "buyer_name",
                        "buyer_email",
                        "created_at",
                        "status"
                    ],
                    'order' => 'id DESC'
                ],
                'limit' => 1,
                'page'  => $data["currentPage"],
            ]
        );
        
        $page = $paginator->paginate();
        return [
            'success' => true,
            'orders' => $page,
        ];
    }
    
    public function getOrder($id){
        $order = Orders::findFirst($id);
        $productsData = (json_decode($order->products_data,true));
        
        $products=[];

        foreach ($productsData as $productData){
            $product = Products::findFirst(
                [
                    "conditions"=> "id = :id:",
                    "bind" => [
                    'id'=> $productData["id"],
                    ],
                    "columns" =>[
                        "{$productData["count"]} as count",
                        "id",
                        "img",
                        "name",
                        "description",
                        "price",
                    ]
            ,]);
            array_push($products, $product);
        } 

        if(!empty($order->promotional_code_id)){
            $promotionalCode = PromotionalCodes::findFirst($order->promotional_code_id);
        }

        return[
            'success' => true,
            'order' => $order,
            'products' => $products,
            "promotional_code" => $promotionalCode
        ];
    }
}
