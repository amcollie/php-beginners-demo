<?php

declare(strict_types=1);

use Core\App;
use Core\Database;

$db =App::resolve(Database::class);

$notes = $db->query('SELECT * FROM notes WHERE user_id = :user_id', ['user_id' => 1])->all();


view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes
]);