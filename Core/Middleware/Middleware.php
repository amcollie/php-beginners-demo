<?php

declare(strict_types=1);

namespace Core\Middleware;

use Exception;

class Middleware
{
    private const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class,
    ];

    public static function resolve(?string $key): void
    {
        if (is_null($key)) {
            return;
        }

        if (!array_key_exists($key, static::MAP)) {
            throw new Exception("No middleware found for key '{$key}'.");
        }

        $middleware = static::MAP[$key];

        (new $middleware())->handle();
    }
}