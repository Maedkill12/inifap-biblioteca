<?php

namespace Inifap\Biblioteca;

class Router
{

    /** @var Route[] */
    private array $routes = [];

    public function route(string $path): Route
    {
        if (!isset($this->routes[$path])) {
            $this->routes[$path] = new Route($path);
        }
        return $this->routes[$path];
    }

    public function getRoute(string $path): ?Route
    {
        if (!isset($this->routes[$path])) {
            return null;
        }
        return $this->routes[$path];
    }
}
