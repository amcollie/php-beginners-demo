<?php

declare(strict_types= 1);

namespace Core\Middleware;

use Core\Response;

class Auth
{
    public function handle()
    {
        if (!$_SESSION['user'] ?? false) {
            http_response_code(Response::HTTP_UNAUTHORIZED->value);
            redirect('/');
        }
    }
}