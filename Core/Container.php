<?php

declare(strict_types=1);

namespace Core;
use Exception;

class Container
{
    private array $bindings = [];

    public function bind(string $key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve(string $key): mixed
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception('No resolver found for ' . $key);
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}