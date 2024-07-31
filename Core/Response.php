<?php

declare(strict_types=1);

namespace Core;

enum Response: int
{
    case HTTP_SUCCESS = 200;
    case HTTP_MOVED_PERMANENTLY = 301;
    case HTTP_MOVED_TEMPORARILY = 302;
    case HTTP_TEMPORARY_REDIRECT = 307;
    case HTTP_PERMANENT_REDIRECT = 308;
    case HTTP_NOT_FOUND = 404;
    case HTTP_FORBIDDEN = 403;
    case HTTP_UNAUTHORIZED = 401;
}