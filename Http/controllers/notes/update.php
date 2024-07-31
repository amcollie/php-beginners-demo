<?php

declare(strict_types=1);

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;

$currentUserId = Session::get('user')['id'];

$db = App::resolve(Database::class);
$note = $db->query('SELECT * FROM notes WHERE id = :id', ['id' => $_POST['id']])->findOrFail();

authorize($note['user_id'] === $currentUserId);


$errors = [];

if (!Validator::string($_POST['note-body'], max: 1000)) {
    $errors['note-body'] = 'A body of no more than 1000 characters is required';
}

if (count($errors) > 0) {
    return view('/notes/edit.view.php', [
        'heading' => 'Edit Note', 
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query('UPDATE notes SET body = :body WHERE id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['note-body']
]);

redirect('/notes');