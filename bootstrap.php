<?php

declare(strict_types=1);

use Core\App;
use Core\Database;
use DI\Container;

$container = new Container();

$container->set(Database::class, function () {
    $config = require basePath('config.php');

    return new Database($config['db'], password: 'AlphaCharlie73');
});

App::setContainer($container);