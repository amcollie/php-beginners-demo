<?php
use DI\Container;


test('it can resolve something from the container', function () {
    ($container = new Container())->set('foo', fn () => 'bar');

    $result = $container->get('foo');

    expect($result)->toBe('bar');
});
