<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Category;
use App\Models\Products;

class ProductController extends BaseController
{
    public function index()
    {
        $products = Products::find();
        // $product = Products::findFirst()->category;
        echo json_encode($products);
        return $products;
    }

    public function create()
    {
        $data = $this->request->getPost();
        $product = new Products();

        $category = Category::find(
            [
                "id = :id:",
                "bind" => [
                    'id'=> $data["id_category"],
                ],
            ]
        );


        if($category->count()<=0){
            echo json_encode([
                'success' => false,
                'message' => "category not found with if {$data["id_category"]}",
                'errors' => $product->getMessages()
            ]);
            return;
        }

        foreach (['name', 'isNew', 'description', 'price','id_category'] as $key) {
            if ($data[$key]===null) {
                echo json_encode([
                    'success' => false,
                    'message' => "{$key} can not be null",
                    'errors' => $product->getMessages()
                ]);
                return;
            }
            else{
                $product->assign(["{$key}" => $data[$key]]);
            }
        }
        
        if(!$this->request->hasFiles()) {
            echo json_encode([
                'success' => false,
                'message' => "img can not be null",
                'errors' => $product->getMessages()
            ]);
            return;
        }

        
        if ($this->request->hasFiles()) {
            [$file] = $this->request->getUploadedFiles();
            
            if(empty($file)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'img can not be null',
                    'errors' => $product->getMessages()
                ]);
                return;
            }
            
            $path = 'files/' . time() . $file->getName();
            $file->moveTo(
                $path
            );
                
            $product->assign(['img' => $path]);
        }

        if ($product->create()) {
            echo json_encode([
                'success' => true,
                'message' => 'Product created',
                'product' => $product
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to create product',
                'errors' => $product->getMessages()
            ]);
        }
    }

    public function destroy(int $id)
    {
        $product = Products::findFirstById($id);
        if (!$product) {
            echo json_encode([
                'success' => false,
                'message' => 'Product not found',
            ]);
            return;
        }
    
        if ($product->delete()) {
            echo json_encode([
                'success' => true,
                'message' => 'Product deleted',
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to delete product',
                'errors' => $product->getMessages()
            ]);
        }
    }

    public function update(int $id){
        $data = $this->request->getPut();
        $product = Products::findFirst($id);

        if(empty($product)){
            echo json_encode([
                'success' => false,
                'message' => "category not found with if {$id}",            ]);
            return;
        }

        foreach (['name', 'isNew', 'description', 'price','id_category'] as $key) {
            if ($data[$key]===null) {
                echo json_encode([
                    'success' => false,
                    'message' => "{$key} can not be null",                ]);
                return;
            }
            else{
                $product->assign(["{$key}" => $data[$key]]);
            }
        }

        if ($product->update()) {
            echo json_encode([
                'success' => true,
                'message' => 'Category updated',
                'product' => $product
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to update category',
                'errors' => $product->getMessages()
            ]);
        }
    }
}