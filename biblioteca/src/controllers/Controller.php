<?php

namespace Inifap\Biblioteca\Controllers;

abstract class Controller
{
    public function __construct()
    {
    }

    public function create(?array $params, ?array $body, ?array $query): void
    {
    }
    public function findOne(?array $params, ?array $body, ?array $query): void
    {
    }

    public function findMany(?array $params, ?array $body, ?array $query): void
    {
    }

    public function update(?array $params, ?array $body, ?array $query): void
    {
    }
    public function delete(?array $params, ?array $body, ?array $query): void
    {
    }

    public function render(?array $params, $dirName): void
    {
        include VIEW_PATH . "/$dirName/index.php";
    }
}
