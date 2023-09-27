<?php

namespace Inifap\Biblioteca;

use Inifap\Biblioteca\Controllers\AdminController;
use Inifap\Biblioteca\Controllers\HomeController;
use Inifap\Biblioteca\Controllers\ScientificArticleController;
use Inifap\Biblioteca\Controllers\TechnicalArticleController;

class App
{
    private static App $appInstance;

    private HomeController $homeController;
    private ScientificArticleController $scientificArticleController;
    private TechnicalArticleController $technicalArticleController;
    private AdminController $adminController;



    public function __construct()
    {
        static::$appInstance = $this;

        $this->homeController = new HomeController();
        $this->scientificArticleController = new ScientificArticleController();
        $this->technicalArticleController = new TechnicalArticleController();
        $this->adminController = new AdminController();
    }

    public function run(): void
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            // Home Routes
            $r->addRoute('GET', ROOT_PATH . '/', function ($params, $body, $query) {
                $this->homeController->render($params, "home");
            });

            // Scientific Article Routes
            $r->addRoute('GET', ROOT_PATH . '/articulo/cientifico/{id:\d+}', function ($params, $body, $query) {
                $this->scientificArticleController->render($params, "article");
            });
            $r->addRoute("GET", ROOT_PATH . "/api/articulo/cientifico", function ($params, $body, $query) {
                $this->scientificArticleController->findMany($params, $body, $query);
            });
            $r->addRoute("POST", ROOT_PATH . "/api/articulo/cientifico", function ($params, $body, $query) {
                $this->scientificArticleController->create($params, $body, $query);
            });
            $r->addRoute("GET", ROOT_PATH . "/api/articulo/cientifico/{id:\d+}", function ($params, $body, $query) {
                $this->scientificArticleController->findOne($params, $body, $query);
            });
            $r->addRoute("PATCH", ROOT_PATH . "/api/articulo/cientifico/{id:\d+}", function ($params, $body, $query) {
                $this->scientificArticleController->update($params, $body, $query);
            });
            $r->addRoute("DELETE", ROOT_PATH . "/api/articulo/cientifico/{id:\d+}", function ($params, $body, $query) {
                $this->scientificArticleController->delete($params, $body, $query);
            });

            // Technical Article Routes
            $r->addRoute('GET', ROOT_PATH . '/articulo/tecnico/{id:\d+}', function ($params, $body, $query) {
                $this->technicalArticleController->render($params, "article");
            });
            $r->addRoute("GET", ROOT_PATH . "/api/articulo/tecnico", function ($params, $body, $query) {
                $this->technicalArticleController->findMany($params, $body, $query);
            });
            $r->addRoute("POST", ROOT_PATH . "/api/articulo/tecnico", function ($params, $body, $query) {
                $this->technicalArticleController->create($params, $body, $query);
            });
            $r->addRoute("GET", ROOT_PATH . "/api/articulo/tecnico/{id:\d+}", function ($params, $body, $query) {
                $this->technicalArticleController->findOne($params, $body, $query);
            });
            $r->addRoute("PATCH", ROOT_PATH . "/api/articulo/tecnico/{id:\d+}", function ($params, $body, $query) {
                $this->technicalArticleController->update($params, $body, $query);
            });
            $r->addRoute("DELETE", ROOT_PATH . "/api/articulo/tecnico/{id:\d+}", function ($params, $body, $query) {
                $this->technicalArticleController->delete($params, $body, $query);
            });

            // Admin Routes
            $r->addRoute("POST", ROOT_PATH . "/api/admin/login", function ($params, $body, $query) {
                $this->adminController->login($body["API_KEY"] ?? "");
            });
            $r->addRoute('GET', ROOT_PATH . '/admin', function ($params, $body, $query) {
                $this->adminController->isAuth();
                $this->adminController->render($params, "admin");
            });
            $r->addRoute('GET', ROOT_PATH . '/admin/login', function ($params, $body, $query) {
                $this->adminController->render($params, "admin/login");
            });
            $r->addRoute("POST", ROOT_PATH . "/admin/logout", function ($params, $body, $query) {
                $this->adminController->logout();
            });
            $r->addRoute('GET', ROOT_PATH . '/admin/articulo', function ($params, $body, $query) {
                $this->adminController->isAuth();
                $this->adminController->render($params, "admin/article");
            });
            $r->addRoute('GET', ROOT_PATH . '/admin/articulo/{id:\d+}', function ($params, $body, $query) {
                $this->adminController->isAuth();
                $this->adminController->render($params, "admin/article");
            });
        });

        // Fetch method and URI from somewhere
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $query = [];

        if (strpos($uri, '?') !== false) {
            $query = explode('?', $uri)[1];
            $uri = explode('?', $uri)[0];
            $query = explode('&', $query);
            $query = array_map(function ($item) {
                $item = explode('=', $item);
                return [$item[0] => $item[1]];
            }, $query);
            $query = array_reduce($query, function ($carry, $item) {
                return array_merge($carry, $item);
            }, []);
        };

        $httpMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $body = [];

        if (in_array($httpMethod, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $body = json_decode(file_get_contents('php://input'), true) ?? [];
        }

        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                include VIEW_PATH . '/errors/404.php';
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                var_dump("405 Method Not Allowed");
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                $handler($vars, $body, $query);
                break;
        }
    }


    public static function getInstance(): App
    {
        return static::$appInstance;
    }
}
