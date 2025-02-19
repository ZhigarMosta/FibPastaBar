<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\BaseModel;

class Products extends BaseModel
{
    public ?int $id = null;
    public ?string $img;
    public ?string $name;
    public ?string $desc;
    public ?int $price;
    public ?int $isNew;
    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function initialize(): void
    {
        $this->setSource("Products");
    }
}
