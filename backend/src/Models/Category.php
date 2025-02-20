<?php

declare(strict_types=1);

namespace App\Models;

class Category extends BaseModel
{
    public ?int $id = null;
    public ?string $name;
    public ?string $anchorRef;
    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function initialize(): void
    {
        $this->setSource("Category");
    }
}
