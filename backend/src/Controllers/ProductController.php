<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Products;

class ProductController extends ControllerBase
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
        }

        echo gettype($data['isNew']);
        $product->assign(['name' => $data['name']]);
        $product->assign(['isNew' => $data['isNew']]);
        $product->assign(['desc' => $data['desc']]);
        $product->assign(['price' => $data['price']]);

        echo json_encode($data['img']);

        // echo json_encode('\n');
        if ($this->request->hasFiles()) {
            [$file] = $this->request->getUploadedFiles();
            
            if(empty($file)) return;
            
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
}