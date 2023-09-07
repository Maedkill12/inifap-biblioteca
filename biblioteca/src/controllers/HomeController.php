<?php

namespace Inifap\Biblioteca\Controllers;

class HomeController extends Controller
{

    public function __construct()
    {
        parent::__construct();
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
    public function render(?array $params): void
    {
        include VIEW_PATH . '/home/index.php';
    }
}
