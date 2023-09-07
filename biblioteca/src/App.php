<?php

namespace Inifap\Biblioteca;

use Inifap\Biblioteca\Controllers\AdminController;
use Inifap\Biblioteca\Routes\AdminRoutes;
use Inifap\Biblioteca\Routes\HomeRoutes;
use Inifap\Biblioteca\Controllers\HomeController;
use Inifap\Biblioteca\Controllers\ArticleController;
use Inifap\Biblioteca\Routes\ArticleRoutes;

class App
{

    private RouterManager $routerManager;
    private HomeRoutes $homeRoutes;
    private ArticleRoutes $articleRoutes;

    public function __construct()
    {
        $this->routerManager = new RouterManager();
        $this->homeRoutes = new HomeRoutes($this->routerManager, new HomeController());
        $this->articleRoutes = new ArticleRoutes($this->routerManager, new ArticleController());
        new AdminRoutes($this->routerManager, new AdminController());
    }

    public function run(): void
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $body = [];

        if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $body = json_decode(file_get_contents('php://input'), true) ?? [];
        }
        $this->routerManager->resolve($path, $method, $body);
    }
}
