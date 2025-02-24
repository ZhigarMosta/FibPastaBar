<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Category;
use App\Models\Products;

class CategoryController extends BaseController
{
    public function getCategoriesWithProducts()
    {
        $categories = Category::find();
        $categoriesWithProducts = [];

        foreach ($categories as $category) {
            $products = Products::find(
                [
                    "id_category = :category_id:",
                    "bind" => [
                        'category_id'=> $category->id,
                    ],
                    "columns" =>["id","img","name","description","isNew",'price'],
                ]
        );

            if($products->count()>0){
                $categoriesWithProducts[] = [
                    'name' => $category->name,
                    'anchorRef' => $category->anchorRef,
                    'list' => $products,
                ];
            }
        }

        $new_products = Products::find(
            [
                "conditions"=> "isNew = :isNew:",
                "bind" => [
                    'isNew'=> 1,
                ],
                'order' => 'updated_at DESC',
                "limit" => 4,
                "columns"=>["img","name","price"]
            ]
        );
        
        echo json_encode([
            'success' => true,
            'block' => [
                "categories"=>$categoriesWithProducts,
                "products_new"=>$new_products
            ]
        ]);
    }

    public function create(){
        $data = $this->request->getPost();
        $category = new Category();

        foreach (['name', 'anchorRef'] as $key) {
            if (empty($data[$key])) {
                echo json_encode([
                    'success' => false,
                    'message' => "{$key} can not be null",
                    'errors' => $category->getMessages()
                ]);
                return;
            }
            else{
                $category->assign(["{$key}" => $data[$key]]);
            }
        }

        if ($category->create()) {
            echo json_encode([
                'success' => true,
                'message' => 'Category created',
                'product' => $category
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to create category',
                'errors' => $category->getMessages()
            ]);
        }
    }

    public function destroy(int $id)
    {
        $category = Category::findFirstById($id);
        if (!$category) {
            echo json_encode([
                'success' => false,
                'message' => 'Product not found',
            ]);
            return;
        }
    
        if ($category->delete()) {
            echo json_encode([
                'success' => true,
                'message' => 'Category deleted',
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to delete category',
                'errors' => $category->getMessages()
            ]);
        }
    }

    public function update(int $id){
        $data = $this->request->getPut();
        $category = Category::findFirst($id);

        if(empty($category)){
            echo json_encode([
                'success' => false,
                'message' => "category not found with if {$id}",            ]);
            return;
        }

        foreach (['name', 'anchorRef'] as $key) {
            if (empty($data[$key])) {
                echo json_encode([
                    'success' => false,
                    'message' => "{$key} can not be null",                ]);
                return;
            }
            else{
                $category->assign(["{$key}" => $data[$key]]);
            }
        }

        if ($category->update()) {
            echo json_encode([
                'success' => true,
                'message' => 'Category updated',
                'product' => $category
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to update category',
                'errors' => $category->getMessages()
            ]);
        }
    }
}
