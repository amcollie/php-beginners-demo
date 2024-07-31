<?php
declare(strict_types=1);

namespace Core;

use Exception;

class ValidationException extends Exception
{
    private array $errors = [];

    private array $old = [];

    public function getErrors(): array
    {
        return $this->errors;
    }


    public function getOldInput(): array
    {
        return $this->old;
    }

    public static function throw(array $errors = [], array $old = []): void
    {
        $instance = new static();
        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }
}