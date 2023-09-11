<?php

namespace Inifap\Biblioteca\Routes;

use Inifap\Biblioteca\Controllers\AdminController;
use \Inifap\Biblioteca\RouterManager;
use \Inifap\Biblioteca\Controllers\Controller;

class AdminRoutes extends Routes
{
    private AdminController $controller;
    public function __construct(RouterManager $routerManager)
    {
        parent::__construct($routerManager);
        $this->controller = new AdminController();
    }

    public function setupRoutes(): void
    {
        $this->routerManager->addRoute("/admin")->get(function (array $params) {
            $this->controller->render($params, "admin");
        });
        $this->routerManager->addRoute("/admin/login")->get(function (array $params) {
            $this->controller->render($params, "admin/login");
        });
        $this->routerManager->addRoute("/admin/articulo")->get(function (array $params) {
            $this->controller->render($params, "admin/article");
        });
        $this->routerManager->addRoute("/admin/articulo/:id")->get(function (array $params) {
            $this->controller->render($params, "admin/article");
        });
    }
}
