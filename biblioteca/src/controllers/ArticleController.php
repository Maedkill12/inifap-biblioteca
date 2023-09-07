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
        echo json_encode([
            'status' => 'success',
            'message' => 'Article created successfully'
        ]);
    }
    public function find(?array $params, ?array $body): void
    {
    }
    public function update(?array $params, ?array $body): void
    {
        echo json_encode([
            'status' => 'success',
            'message' => 'Article updated successfully'
        ]);
    }
    public function delete(?array $params, ?array $body): void
    {
        echo json_encode([
            'status' => 'success',
            'message' => 'Article created successfully'
        ]);
    }
}
