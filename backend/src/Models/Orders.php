<?php

declare(strict_types=1);

namespace App\Models;

class Orders extends BaseModel
{
    public ?int $id = null;
    public ?int $user_id = null;
    public ?string $products_data;
    public ?int $promotional_code_id = null;
    public ?string $addres_sity = null;
    public ?string $addres_house = null;
    public ?string $addres_entrance = null;
    public ?string $addres_apartment = null;
    public ?string $addres_floor = null;
    public ?string $addres_code = null;
    public ?string $addres_name_addres = null;
    public ?string $addres_comment_addres = null;
    public ?string $status = null;
    public ?int $cost;
    public ?string $time;
    public ?string $buyer_name;
    public ?string $buyer_email;
    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function initialize(): void
    {
        $this->setSource("Orders");
    }
}