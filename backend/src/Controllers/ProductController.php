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
        return[
            'success' => true,
            'products' => $products
        ];
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
            return[
                'success' => false,
                'message' => "category not found with if {$data["id_category"]}",
                'errors' => $product->getMessages()
            ];
        }

        foreach (['name', 'isNew', 'description', 'price','id_category'] as $key) {
            if ($data[$key]===null) {
                return[
                    'success' => false,
                    'message' => "{$key} can not be null",
                    'errors' => $product->getMessages()
                ];
            }
            else{
                $product->assign(["{$key}" => $data[$key]]);
            }
        }
        
        if(!$this->request->hasFiles()) {
            return[
                'success' => false,
                'message' => "img can not be null",
                'errors' => $product->getMessages()
            ];
        }

        
        if ($this->request->hasFiles()) {
            [$file] = $this->request->getUploadedFiles();
            
            if(empty($file)) {
                return[
                    'success' => false,
                    'message' => 'img can not be null',
                    'errors' => $product->getMessages()
                ];
            }
            
            $path = 'files/' . time() . $file->getName();
            $file->moveTo(
                $path
            );
                
            $product->assign(['img' => $path]);
        }

        if ($product->create()) {
            return[
                'success' => true,
                'message' => 'Product created',
                'product' => $product
            ];
        } else {
            return[
                'success' => false,
                'message' => 'Failed to create product',
                'errors' => $product->getMessages()
            ];
        }
    }

    public function destroy(int $id)
    {
        $product = Products::findFirstById($id);
        if (!$product) {
            return[
                'success' => false,
                'message' => 'Product not found',
            ];
        }
    
        if ($product->delete()) {
            return[
                'success' => true,
                'message' => 'Product deleted',
            ];
        } else {
            return[
                'success' => false,
                'message' => 'Failed to delete product',
                'errors' => $product->getMessages()
            ];
        }
    }

    public function update(int $id)
    {
        $data = $this->request->getPut();
        $product = Products::findFirst($id);

        if(empty($product)){
            return[
                'success' => false,
                'message' => "category not found with if {$id}",
            ];
        }

        foreach (['name', 'isNew', 'description', 'price','id_category'] as $key) {
            if ($data[$key]===null) {
                return[
                    'success' => false,
                    'message' => "{$key} can not be null",
                ];
            }
            else{
                $product->assign(["{$key}" => $data[$key]]);
            }
        }

        if ($product->update()) {
            return[
                'success' => true,
                'message' => 'Category updated',
                'product' => $product
            ];
        } else {
            return[
                'success' => false,
                'message' => 'Failed to update category',
                'errors' => $product->getMessages()
            ];
        }
    }
    public function getProductById($id)
    {
        $product = Products::findFirst($id);

        if(empty($product)){
            return[
                'success' => false,
                'message' => "product not found with if {$id}",
            ];
        }

        return[
            'success' => true,
            'message' => 'product found',
            'product' => $product
        ];
    }
}