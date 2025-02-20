<?php

declare(strict_types=1);

namespace App\Models;

/**
 * @property Category $category
 */
class Products extends BaseModel
{
    public ?int $id = null;
    public ?string $img;
    public ?string $name;
    public ?string $description;
    public ?int $price;
    public ?int $isNew;
    public ?int $id_category;
    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function initialize(): void
    {
        $this->setSource("Products");

        $this->hasOne('id_category',Category::class,'id',[
            'alias' =>  'category'
        ]);
    }
}
