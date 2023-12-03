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

    private function getAllArticles($query)
    {
        $type = $query['type'] ?? "todos";
        $articles = [];

        if ($type === "cientifico") {
            $articles = $this->scientificArticleController->getModel()->findMany($query);
        } elseif ($type === "tecnico") {
            $articles = $this->technicalArticleController->getModel()->findMany($query);
        } else {
            $query["limit"] = floor(($query["limit"] ?? 12) / 2);

            $technical = $this->technicalArticleController->getModel()->findMany($query);
            $scientific = $this->scientificArticleController->getModel()->findMany($query);
            $articles = array_merge($technical, $scientific);
            shuffle($articles);
        }

        return $articles;
    }

    private function getRecentArticles()
    {
        $technical = $this->technicalArticleController->getModel()->recents();
        $scientific = $this->scientificArticleController->getModel()->recents();
        $articles = array_merge($technical, $scientific);
        // shuffle($articles);
        return $articles;
    }

    public function run(): void
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            // Home Routes
            $r->addRoute('GET', ROOT_PATH . '/', function ($params, $body, $query) {
                $type = $query['type'] ?? "tecnico";
                $page = $query['page'] ?? 1;
                $articles = $this->getAllArticles($query);
                $recent = $this->getRecentArticles();

                $this->homeController->render(["articles" => $articles, "isScientific" => $type === "cientifico", "page" => $page, "recent" => $recent, ...$params], "home");
            });

            // Scientific Article Routes
            $r->addRoute('GET', ROOT_PATH . '/articulo/cientifico/{id:\d+}', function ($params, $body, $query) {
                $article = $this->scientificArticleController->getModel()->findOne($params);
                if ($article === null) {
                    include_once(VIEW_PATH . '/errors/404.php');
                    exit;
                }
                $this->scientificArticleController->render(["article" => $article], "article");
                // $this->scientificArticleController->render($params, "article");
            });
            $r->addRoute("GET", ROOT_PATH . "/api/articulo/cientifico", function ($params, $body, $query) {
                $this->scientificArticleController->findMany($params, $body, $query);
            });
            $r->addRoute("POST", ROOT_PATH . "/api/articulo/cientifico", function ($params, $body, $query) {
                $this->adminController->isAuth();
                if (isset($body["imagen"])) {
                    // var_dump($body["imagen"]);
                    // exit;
                    $testFolder = $_SERVER['DOCUMENT_ROOT'] . ROOT_PATH . "/public/publicaciones";

                    $file = $body["imagen"];
                    $file_name = $file["name"];
                    $file_tmp = $file["tmp_name"];

                    $name = date("Y-m-d-H-i-s") . "-" . $file_name;
                    move_uploaded_file($file_tmp, "$testFolder/$name");
                    $body["imagen"] = $name;
                }
                if (isset($body["pdf"])) {
                    $testFolder = $_SERVER['DOCUMENT_ROOT'] . ROOT_PATH . "/public/publicaciones";

                    $file = $body["pdf"];
                    $file_name = $file["name"];
                    $file_tmp = $file["tmp_name"];

                    $name = date("Y-m-d-H-i-s") . "-" . $file_name;
                    move_uploaded_file($file_tmp, "$testFolder/$name");
                    $body["liga"] = $name;
                }
                $this->scientificArticleController->create($params, $body, $query);
            });
            $r->addRoute("GET", ROOT_PATH . "/api/articulo/cientifico/{id:\d+}", function ($params, $body, $query) {
                $this->scientificArticleController->findOne($params, $body, $query);
            });
            $r->addRoute("POST", ROOT_PATH . "/api/articulo/cientifico/{id:\d+}", function ($params, $body, $query) {
                $this->adminController->isAuth();
                if (isset($body["pdf"])) {
                    $testFolder = $_SERVER['DOCUMENT_ROOT'] . ROOT_PATH . "/public/publicaciones";

                    $file = $body["pdf"];
                    $file_name = $file["name"];
                    $file_tmp = $file["tmp_name"];

                    $name = date("Y-m-d-H-i-s") . "-" . $file_name;
                    move_uploaded_file($file_tmp, "$testFolder/$name");
                    $body["liga"] = $name;
                }
                $this->scientificArticleController->update($params, $body, $query);
            });
            $r->addRoute("DELETE", ROOT_PATH . "/api/articulo/cientifico/{id:\d+}", function ($params, $body, $query) {
                $this->adminController->isAuth();
                $this->scientificArticleController->delete($params, $body, $query);
            });

            // Technical Article Routes
            $r->addRoute('GET', ROOT_PATH . '/articulo/tecnico/{id:\d+}', function ($params, $body, $query) {
                $article = $this->technicalArticleController->getModel()->findOne($params);
                if ($article === null) {
                    include_once(VIEW_PATH . '/errors/404.php');
                    exit;
                }
                $this->technicalArticleController->render(["article" => $article], "article");
                // $this->technicalArticleController->render($params, "article");
            });
            $r->addRoute("GET", ROOT_PATH . "/api/articulo/tecnico", function ($params, $body, $query) {
                $this->technicalArticleController->findMany($params, $body, $query);
            });
            $r->addRoute("POST", ROOT_PATH . "/api/articulo/tecnico", function ($params, $body, $query) {
                $this->adminController->isAuth();
                if (isset($body["imagen"])) {
                    // var_dump($body["imagen"]);
                    // exit;
                    $testFolder = $_SERVER['DOCUMENT_ROOT'] . ROOT_PATH . "/public/publicaciones";

                    $file = $body["imagen"];
                    $file_name = $file["name"];
                    $file_tmp = $file["tmp_name"];

                    $name = date("Y-m-d-H-i-s") . "-" . $file_name;
                    move_uploaded_file($file_tmp, "$testFolder/$name");
                    $body["imagen"] = $name;
                }
                if (isset($body["pdf"])) {
                    $testFolder = $_SERVER['DOCUMENT_ROOT'] . ROOT_PATH . "/public/publicaciones";

                    $file = $body["pdf"];
                    $file_name = $file["name"];
                    $file_tmp = $file["tmp_name"];

                    $name = date("Y-m-d-H-i-s") . "-" . $file_name;
                    move_uploaded_file($file_tmp, "$testFolder/$name");
                    $body["liga"] = $name;
                }
                $this->technicalArticleController->create($params, $body, $query);
            });
            $r->addRoute("GET", ROOT_PATH . "/api/articulo/tecnico/{id:\d+}", function ($params, $body, $query) {

                $this->technicalArticleController->findOne($params, $body, $query);
            });
            $r->addRoute("POST", ROOT_PATH . "/api/articulo/tecnico/{id:\d+}", function ($params, $body, $query) {
                $this->adminController->isAuth();
                if (isset($body["imagen"])) {
                    // var_dump($body["imagen"]);
                    // exit;
                    $testFolder = $_SERVER['DOCUMENT_ROOT'] . ROOT_PATH . "/public/publicaciones";

                    $file = $body["imagen"];
                    $file_name = $file["name"];
                    $file_tmp = $file["tmp_name"];

                    $name = date("Y-m-d-H-i-s") . "-" . $file_name;
                    move_uploaded_file($file_tmp, "$testFolder/$name");
                    $body["imagen"] = $name;
                }
                if (isset($body["pdf"])) {
                    $testFolder = $_SERVER['DOCUMENT_ROOT'] . ROOT_PATH . "/public/publicaciones";

                    $file = $body["pdf"];
                    $file_name = $file["name"];
                    $file_tmp = $file["tmp_name"];

                    $name = date("Y-m-d-H-i-s") . "-" . $file_name;
                    move_uploaded_file($file_tmp, "$testFolder/$name");
                    $body["liga"] = $name;
                }
                $this->technicalArticleController->update($params, $body, $query);
            });
            $r->addRoute("DELETE", ROOT_PATH . "/api/articulo/tecnico/{id:\d+}", function ($params, $body, $query) {
                $this->adminController->isAuth();
                $this->technicalArticleController->delete($params, $body, $query);
            });

            // All articles
            $r->addRoute("GET", ROOT_PATH . '/api/articulo', function ($params, $body, $query) {
                $query["limit"] = floor(($query["limit"] ?? 10) / 2);
                $technical = $this->technicalArticleController->getModel()->findMany($query);
                $scientific = $this->scientificArticleController->getModel()->findMany($query);
                $result = array_merge($technical, $scientific);
                shuffle($result);
                header('Content-Type: application/json; charset=utf-8');
                header('status: 200');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Article found successfully',
                    'data' => $result
                ]);
                return;
            });

            // Admin Routes
            $r->addRoute("POST", ROOT_PATH . "/api/admin/login", function ($params, $body, $query) {
                $this->adminController->login($body["API_KEY"] ?? "");
            });
            $r->addRoute('GET', ROOT_PATH . '/admin', function ($params, $body, $query) {
                $this->adminController->isAuth();

                $type = $query['type'] ?? "tecnico";
                $page = $query['page'] ?? 1;

                $articles = $this->getAllArticles($query);

                $this->adminController->render(["articles" => $articles, "isScientific" => $type === "cientifico", "page" => $page, ...$params], "admin");
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
            $r->addRoute('GET', ROOT_PATH . '/admin/articulo/{type:\w+}/{id:\d+}', function ($params, $body, $query) {
                $this->adminController->isAuth();
                $type = $params["type"];
                $article = null;
                switch ($type) {
                    case "tecnico":
                        $article = $this->technicalArticleController->getModel()->findOne($params);
                        break;
                    case "cientifico":
                        $article = $this->scientificArticleController->getModel()->findOne($params);
                        break;
                    default:
                        include_once(VIEW_PATH . '/errors/404.php');
                        exit;
                }
                if ($article === null) {
                    include_once(VIEW_PATH . '/errors/404.php');
                    exit;
                }
                $this->adminController->render(["article" => $article], "admin/edit");
            });
            $r->addRoute('GET', ROOT_PATH . '/admin/subir', function ($params, $body, $query) {
                $this->adminController->isAuth();
                $this->adminController->render($params, "admin/subir");
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
        }

        $httpMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $body = [];

        if (in_array($httpMethod, ['POST', 'PUT', 'PATCH', 'DELETE'])) {

            $body = json_decode(file_get_contents('php://input'), true) ?? [];

            if (isset($_POST) && count($_POST) > 0 && count($body) === 0) {
                $body = array_merge($body, $_POST);
            }

            if (isset($_FILES['pdf'])) {
                $body['pdf'] = $_FILES['pdf'];
            }

            if (isset($_FILES['imagen'])) {
                $body['imagen'] = $_FILES['imagen'];
            }
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
