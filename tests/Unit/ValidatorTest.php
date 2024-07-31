<?php

use Core\Validator;

it('validates a string', function () {
    expect(Validator::string('foobar'))->toBeTrue();
    expect(Validator::string(false))->toBeFalse();
    expect(Validator::string(''))->toBeFalse();
});

it('validates string with a minimum length', function () {
    expect(Validator::string('foobar', 20))->toBeFalse();
});

it('validates an email', function () {
    expect(Validator::email('foo@bar.eu'))->toBeTrue();
    expect(Validator::email('foo@bar.'))->toBeFalse();
    expect(Validator::email('foo@bar.123'))->toBeFalse();
});