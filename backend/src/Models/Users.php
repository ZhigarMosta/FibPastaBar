<?php

declare(strict_types=1);

namespace App\Models;

class Users extends BaseModel
{
    public ?int $id = null;
    public ?string $email;
    public ?string $password;
    public ?string $name;
    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function initialize(): void
    {
        $this->setSource("Users");
    }
}
