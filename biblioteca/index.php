<?php

require_once __DIR__ . './vendor/autoload.php';

use Inifap\Biblioteca\Router;
use Inifap\Biblioteca\App;

$router = new Router();
$router->addRoute("/biblioteca")->get(function () {
    include __DIR__ . './src/views/home/index.php';
});
$router->addRoute("/biblioteca/users/:id")->get(function () {
    echo "Hola mundo 3";
});


$app = new App($router);
$app->run();
