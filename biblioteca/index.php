﻿<?php

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

require_once  './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('ROOT_PATH', substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))));
define('PUBLIC_PATH', "http://" . $_SERVER['HTTP_HOST'] . ROOT_PATH . '/public');
define("URL_BASE", "http://" . $_SERVER['HTTP_HOST'] . ROOT_PATH);
define("API_BASE", "http://" . $_SERVER['HTTP_HOST'] . ROOT_PATH . "/api");

const VIEW_PATH =  './src/views';
const CONTROLLERS_PATH =  './src/controllers';
const MODELS_PATH =  './src/modules';

$app = new Inifap\Biblioteca\App();
$app->run();
