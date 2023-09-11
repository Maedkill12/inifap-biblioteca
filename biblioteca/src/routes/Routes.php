<?php

namespace Inifap\Biblioteca\Routes;

use Inifap\Biblioteca\Controllers\Controller;
use Inifap\Biblioteca\RouterManager;

abstract class Routes
{
    protected  RouterManager $routerManager;

    public function __construct(RouterManager $routerManager)
    {
        $this->routerManager = $routerManager;
        $this->setupRoutes();
    }

    abstract public function setupRoutes(): void;
}
