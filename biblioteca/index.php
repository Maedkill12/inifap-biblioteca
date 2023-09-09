<?php

require_once __DIR__ . './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('ROOT_PATH', substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))));

const VIEW_PATH = __DIR__ . '/src/views';
const CONTROLELRS_PATH = __DIR__ . '/src/controllers';
const MODULES_PATH = __DIR__ . '/src/modules';


use Inifap\Biblioteca\App;

$app = new App();

// echo '<pre>';
// var_dump($_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING'], $_SERVER['REQUEST_METHOD']);
// echo '</pre>';
$app->run();
