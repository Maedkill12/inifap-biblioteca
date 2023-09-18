<?php

require_once __DIR__ . './vendor/autoload.php';

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 60 * 60,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    // 'secure' => true,
    'httponly' => true,
    // 'samesite' => 'Strict'
]);

session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('ROOT_PATH', substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))));

const VIEW_PATH = __DIR__ . '/src/views';
const CONTROLELRS_PATH = __DIR__ . '/src/controllers';
const MODULES_PATH = __DIR__ . '/src/modules';


header("Access-Control-Allow-Origin: *");

$app = new Inifap\Biblioteca\App();
$app->run();
