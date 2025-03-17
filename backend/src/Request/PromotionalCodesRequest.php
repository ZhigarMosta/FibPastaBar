<?php

declare(strict_types=1);

namespace App\Request;

use Phalcon\Encryption\Security\Random;

class PromotionalCodesRequest extends AbstractRequest
{
    public function validate(array $data): bool{
        foreach (['valid_until','discount_percentage'] as $key) {
            if ($data[$key]===null) {
                $this->addErrors("{$key} can not be null");
            }
        }
        return $this->isValid();
    }


    public function codeGenerate(): string
    {
        $randomCode = new Random();
        return($randomCode->base64Safe(5));
    }

    public function validateIsActive(array $data):bool{
        if($data["is_active"]===null){
            return false;
        }
        return true;
    }
    public function validateCode(array $data):bool{
        if(empty($data["code"])){
            return false;
        }
        return true;
    }

    public function promotionalCodeIsFound($promotionalCode): bool
    {
        if(empty($promotionalCode)){
            $this->addErrors("promotional code no found");
        }

        return $this->isValid();
    }
}
