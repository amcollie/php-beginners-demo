<?php

declare(strict_types=1);

namespace Core;

use Core\Middleware\Middleware;

class Router
{

    private array $routes = [];

    public function get(string $uri, string $controller): self
    {
        return $this->addRoute('GET', $uri, $controller);
    }

    public function post(string $uri, string $controller): self
    {
        return $this->addRoute('POST', $uri, $controller);
    }

    public function patch(string $uri, string $controller): self
    {
        return $this->addRoute('PATCH', $uri, $controller);
    }

    public function put(string $uri, string $controller): self
    {
        return $this->addRoute('PUT', $uri, $controller);
    }

    public function delete(string $uri, string $controller): self
    {
        return $this->addRoute('DELETE', $uri, $controller);
    }

    public function dispatch(string $uri, string $method = 'GET'): void
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);

                require basePath('Http/controllers/' . $route['controller']);
                return;
            }
        }

        $this->abort(Response::HTTP_NOT_FOUND);
    }

    public function only(string $key): self
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'] ?? '/';
    }

    private function addRoute(string $method,string $uri, string $controller): self
    {
        $middleware = null;
        $this->routes[] = compact('method', 'uri', 'controller', 'middleware');

        return $this;
    }

    private function abort(Response $code):void
    {
        http_response_code($code->value);
        require basePath("views/{$code->value}.view.php");
        exit();
    }

}