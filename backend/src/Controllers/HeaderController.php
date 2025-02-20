<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Category;
use App\Models\Products;

class HeaderController extends BaseController
{
 public function index()
{     
      $categories = Category::find();
      $categoriesNav = [];

      foreach ($categories as $category) {
         $products = Products::find(
            [
               "id_category = :category_id:",
               "bind" => [
                  'category_id'=> $category->id,
               ]
            ]
         );

         if($products->count()>0){
            $categoriesNav[] = [
               'name' => $category->name,
               'anchorRef' => $category->anchorRef,
            ];
         }
      }
      echo json_encode([
         'success' => true,
         'navigation' => $categoriesNav
     ]);
   }   
}
