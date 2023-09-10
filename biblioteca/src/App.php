<?php

namespace Inifap\Biblioteca;

use Inifap\Biblioteca\Controllers\AdminController;
use Inifap\Biblioteca\Routes\AdminRoutes;
use Inifap\Biblioteca\Routes\HomeRoutes;
use Inifap\Biblioteca\Controllers\HomeController;
use Inifap\Biblioteca\Controllers\ArticleController;
use Inifap\Biblioteca\Routes\ArticleRoutes;
use PDO;

class App
{
    private static App $appInstance;

    private RouterManager $routerManager;
    private HomeRoutes $homeRoutes;
    private ArticleRoutes $articleRoutes;


    public function __construct()
    {
        $this->routerManager = new RouterManager();
        $this->homeRoutes = new HomeRoutes($this->routerManager, new HomeController());
        $this->articleRoutes = new ArticleRoutes($this->routerManager, new ArticleController());
        new AdminRoutes($this->routerManager, new AdminController());
        static::$appInstance = $this;
    }

    public function run(): void
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $query = [];

        if (strpos($path, '?') !== false) {
            $query = explode('?', $path)[1];
            $path = explode('?', $path)[0];
            $query = explode('&', $query);
            $query = array_map(function ($item) {
                $item = explode('=', $item);
                return [$item[0] => $item[1]];
            }, $query);
            $query = array_reduce($query, function ($carry, $item) {
                return array_merge($carry, $item);
            }, []);
        };

        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $body = [];

        if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $body = json_decode(file_get_contents('php://input'), true) ?? [];
        }
        $this->routerManager->resolve($path, $method, $body, $query);
    }


    public static function getInstance(): App
    {
        return static::$appInstance;
    }
}
