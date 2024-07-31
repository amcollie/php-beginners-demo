<?php

declare(strict_types=1);

use Core\Response;
use Core\Session;

/**
 * Checks if the given URL matches the current request URL.
 *
 * @param string $url The URL to compare against.
 * @return bool True if the URLs match, false otherwise.
 */
function urlIs(string $url): bool {
    return $_SERVER['REQUEST_URI'] === $url;
}

/**
 * Dump and die - Print human-readable information about a variable and end the script.
 *
 * @param mixed ...$value The variable(s) to dump.
 * @return void
 */
function dd(mixed ...$values): void {
    foreach ($values as $value) {
        echo '<pre>';
        var_dump($value);
        echo '</pre>';
    }
    die();
}

/**
 * Aborts the script with the given status code and message.
 *
 * @param int $status The HTTP status code.
 * @param string $message The error message.
 */
function abort(Response $status = Response::HTTP_NOT_FOUND, string $message = null): void {
    http_response_code($status->value);
    require basePath("views/{$status->value}.view.php"); 
}


/**
 * Check if the given condition is true, otherwise abort with the given status code.
 *
 * @param bool $condition The condition to check
 * @param int $status The HTTP status code to use for the abort
 */
function authorize(bool $condition, Response $status = Response::HTTP_FORBIDDEN): void 
{
    if (!$condition) {
        abort($status);
    }
}

/**
 * Returns the base path concatenated with the provided path.
 *
 * @param string $path The path to be appended to the base path.
 * @return string The concatenated path.
 */
function basePath(string $path = ''): string
{
    return BASE_PATH . $path;
}

/**
 * Render a view file
 *
 * @param string $path The path to the view file, relative to the views directory
 * @param array $data An array of data that should be available in the view
 */
function view(string $path, array $data = []): void
{
    extract($data);
    require BASE_PATH . 'views/' . $path;
}

/**
 * Redirects the user to the specified URL.
 *
 * @param string $path The URL to redirect to.
 * @throws None
 * @return void
 */
function redirect(string $path): void
{
    header("Location: {$path}");
    exit();
}

function old(string $key, mixed $default = ''): mixed
{
    return Session::get('old')[$key] ?? $default;
}
