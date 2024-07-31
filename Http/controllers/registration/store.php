<?php

declare(strict_types=1);

use Core\App;
use Core\Database;
use Core\Validator;

$errors = [];

$email = filter_has_var(INPUT_POST, 'email') ? filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) : null;
$password = filter_has_var(INPUT_POST, 'password') ? htmlspecialchars($_POST['password']) : null;

if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email address';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Password must be at least 7 characters with a maximum of 255';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'email' => $email,
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

if ($user) {
    redirect('/');
}

$db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
    'email' => $email,
    'password' => password_hash($password, PASSWORD_DEFAULT)
]);

$user_id = $db->lastInsertId();

session_regenerate_id();

$_SESSION['user'] = [
    'id' => $user_id,
    'email' => $email
];

redirect('/notes');