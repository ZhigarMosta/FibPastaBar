<?php

declare(strict_types=1);

namespace App\Models;

class PromotionalCodes extends BaseModel
{
    public ?int $id = null;
    public ?string $code = null;
    public ?string $valid_until;
    public ?int $discount_percentage;
    public ?int $is_acive = null;

    public function initialize(): void
    {
        $this->setSource("PromotionalCodes");
    }

    public function beforeCreate():void
    {
        parent::beforeCreate();
    }
}
