<?php

declare(strict_types=1);

namespace App\Request;

abstract class AbstractRequest
{
    private array $errors = [];

    public function getErrors(): array
    {
        return $this->errors;
    }

    protected function addErrors(string $error): void
    {
        $this->errors[] = $error;
    }

    protected function isValid(): bool
    {
        return empty($this->errors);
    }

    abstract public function validate(array $data): bool;
    abstract public function codeGenerate(): string;
}

