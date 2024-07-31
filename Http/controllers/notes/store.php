<?php

declare(strict_types= 1);

use Core\App;
use Core\Database;
use Core\Validator;

require basePath('Core/Validator.php');

$errors = [];

$db = App::resolve(Database::class);


if (!Validator::string($_POST['note-body'], max: 1000)) {
    $errors['note-body'] = 'A body of no more than 1000 characters is required';
}

if (!empty($errors)) {
    return view('/notes/create.view.php', [
        'heading' => 'Create Note', 
        'errors' => $errors
    ]);
}

$db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
    'body' => htmlspecialchars($_POST['note-body']),
    'user_id' => 1
]);

redirect('/notes');
