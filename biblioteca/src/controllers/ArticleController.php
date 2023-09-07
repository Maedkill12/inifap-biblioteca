<?php

namespace Inifap\Biblioteca\Controllers;

class ArticleController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function create(?array $params, ?array $body): void
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($body);
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
        include VIEW_PATH . '/article/index.php';
    }
}
