<?php

declare(strict_types=1);

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
    'email' => filter_has_var(INPUT_POST, 'email') ? filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) : null,
    'password' => filter_has_var(INPUT_POST, 'password') ? htmlspecialchars($_POST['password']) : null
]);

$signedIn = (new Authenticator())->attempt(
    $attributes['email'], 
    $attributes['password']
);

if (!$signedIn) {
    $form
        ->addError('errors', 'No matching account found')
        ->throw();
}

redirect('/notes');