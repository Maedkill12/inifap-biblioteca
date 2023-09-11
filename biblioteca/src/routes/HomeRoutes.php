<?php

namespace Inifap\Biblioteca\Routes;

use Inifap\Biblioteca\Controllers\Controller;
use Inifap\Biblioteca\Controllers\HomeController;
use Inifap\Biblioteca\RouterManager;

class HomeRoutes extends Routes
{

    private HomeController $controller;
    public function __construct(RouterManager $routerManager)
    {
        parent::__construct($routerManager);
        $this->controller = new HomeController();
    }
    public function setupRoutes(): void
    {
        $this->routerManager->addRoute("/")->get(function (array $params) {
            $this->controller->render($params, "home");
        });
    }
}
