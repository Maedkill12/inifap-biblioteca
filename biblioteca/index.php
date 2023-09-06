<?php

require_once __DIR__ . './vendor/autoload.php';

use Inifap\Biblioteca\Router;
use Inifap\Biblioteca\App;

$router = new Router();
$router->route("/biblioteca")->get(function () {
    include __DIR__ . './src/views/home/index.php';
});
$router->route("/biblioteca/users/:id")->get(function () {
    echo "Hola mundo 2";
});


$app = new App($router);
$app->run();
