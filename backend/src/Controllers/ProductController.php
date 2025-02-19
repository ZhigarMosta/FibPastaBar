<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Products;

class ProductController extends BaceController
{
    public function index()
    {
        $products = Products::find();
        echo json_encode($products);
        return $products;
    }

    public function create()
    {
        $data = $this->request->getPost();
        $product = new Products();

        foreach (['name', 'isNew', 'desc', 'price'] as $key) {
            if (empty($data[$key])) {
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
            
            echo $file->getName(), ' ', $file->getSize(), '\n';
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

    public function destroy($id)
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

}