<?php

namespace Inifap\Biblioteca\Controllers;

abstract class Controller
{
    public function __construct()
    {
    }

    public function create(?array $params, ?array $body): void
    {
    }
    public function find(?array $params, ?array $body): void
    {
    }
    public function update(?array $params, ?array $body): void
    {
    }
    public function delete(?array $params, ?array $body): void
    {
    }

    public function render(?array $params, $dirName): void
    {
        include VIEW_PATH . "/$dirName/index.php";
    }
}
