<?php

declare(strict_types=1);

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$currentUserId = Session::get('user')['id'];

$note = $db->query('SELECT * FROM notes WHERE id = :id', ['id' => $_POST['id']])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query('DELETE FROM notes WHERE id = :id', ['id' => $_POST['id']]);

redirect('/notes');                 