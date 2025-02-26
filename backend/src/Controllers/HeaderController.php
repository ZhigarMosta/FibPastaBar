<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Category;
use App\Models\Products;

class HeaderController extends BaseController
{
   public function index()
   {     
      $categories = $this->modelsManager->createBuilder()
         ->from(['c'=>Category::class])
         ->innerJoin(Products::class,
         'c.id = p.id_category',
         'p'
         )
         ->columns(["c.id","c.name","c.anchorRef"])
         ->groupBy("c.name")
         ->getQuery()
         ->execute();

      return[
         'success' => true,
         'navigation' => $categories
      ];
   }   
}
