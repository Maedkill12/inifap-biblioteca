<?php

require_once __DIR__ . './vendor/autoload.php';

const VIEW_PATH = __DIR__ . '/src/views';
const CONTROLELRS_PATH = __DIR__ . '/src/controllers';
const MODULES_PATH = __DIR__ . '/src/modules';

use Inifap\Biblioteca\App;

$app = new App();

$app->run();
