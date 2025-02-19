<?php

declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

class BaseModel extends Model
{
    public function beforeCreate():void
    {
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function beforeUpdate():void
    {
        $this->updated_at = date('Y-m-d H:i:s');
    }
}
