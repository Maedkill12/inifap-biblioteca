<?php

require_once __DIR__ . './vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('ROOT_PATH', substr(str_replace('\\', '/', realpath(dirname(__FILE__))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])))));

const VIEW_PATH = __DIR__ . '/src/views';
const CONTROLELRS_PATH = __DIR__ . '/src/controllers';
const MODULES_PATH = __DIR__ . '/src/modules';



$app = new Inifap\Biblioteca\App();
$app->run();
