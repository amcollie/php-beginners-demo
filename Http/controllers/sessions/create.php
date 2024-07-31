<?php

declare(strict_types=1);

use Core\Session;

view('sessions/create.view.php', [
    'errors' => Session::get('errors')
]);