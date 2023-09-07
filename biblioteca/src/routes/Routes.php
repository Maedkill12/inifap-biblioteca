<?php

namespace Inifap\Biblioteca\Routes;

use Inifap\Biblioteca\Controllers\Controller;
use Inifap\Biblioteca\RouterManager;

abstract class Routes
{
    protected  RouterManager $routerManager;
    protected Controller $controller;

    public function __construct(RouterManager $routerManager, Controller $controller)
    {
        $this->routerManager = $routerManager;
        $this->controller = $controller;
        $this->setupRoutes();
    }

    abstract public function setupRoutes(): void;
}
