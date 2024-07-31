<?php

declare(strict_types=1);

namespace Core;

use DI\Container;

class App
{
    private static ?Container $container = null;

    public static function setContainer(Container $container): void
    {
        static::$container = $container;
    }

    public static function container(): Container
    {
        return static::$container;
    }

    public static function bind(string $key, $resolver): void
    {
        static::$container->set($key, $resolver);
    }

    public static function resolve(string $key): mixed
    {
        return static::$container->get($key);
    }
}