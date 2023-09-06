<?php

namespace Inifap\Biblioteca;

class App
{

    private RouterManager $routerManager;

    public function __construct(RouterManager $routerManager)
    {
        $this->routerManager = $routerManager;
    }

    public function run(): void
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->routerManager->resolve($path, $method);
    }
}
