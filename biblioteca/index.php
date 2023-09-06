<?php

require_once __DIR__ . './vendor/autoload.php';

const VIEW_PATH = __DIR__ . '/src/views';

use Inifap\Biblioteca\App;
use Inifap\Biblioteca\RouterManager;

$router = new RouterManager();
$router->addRoute("/biblioteca")->get(function () {
    include VIEW_PATH . '/home/index.php';
    // echo "Hola mundo";
});
$router->addRoute("/biblioteca/users/:id/:author")->get(function (array $params) {
    // echo "Hola mundo 3" . $params['id'] . " " . $params['author'];
    // include VIEW_PATH . '/home/index.php';
});


$app = new App($router);
$app->run();
