<?php

namespace Inifap\Biblioteca;

class App
{

    private Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run(): void
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $route = $this->router->getRoute($path);

        if ($route) {
            $callback = $route->getMethods()[$method];

            if ($callback) {
                $callback();
            } else {
                echo "Method not allowed";
            }
        } else {
            echo "Not found";
        }
    }
}
