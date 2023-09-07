<?php

namespace Inifap\Biblioteca\Routes;

use Inifap\Biblioteca\Controllers\Controller;
use Inifap\Biblioteca\RouterManager;

class HomeRoutes extends Routes
{

    public function __construct(RouterManager $routerManager, Controller $controller)
    {
        parent::__construct($routerManager, $controller);
    }
    public function setupRoutes(): void
    {
        $this->routerManager->addRoute("/biblioteca")->get(function (array $params) {
            $this->controller->render($params);
        });
    }
}
