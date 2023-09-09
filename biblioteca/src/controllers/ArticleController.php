<?php

namespace Inifap\Biblioteca\Controllers;

class ArticleController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function create(?array $params, ?array $body, ?array $query): void
    {
        header('Content-Type: application/json; charset=utf-8');
        header('status: 201');
        echo json_encode([
            'status' => 'success',
            'message' => 'Article created successfully'
        ]);
    }
    public function findOne(?array $params, ?array $body, ?array $query): void
    {
    }

    public function findMany(?array $params, ?array $body, ?array $query): void
    {
        $app = \Inifap\Biblioteca\App::getInstance();
        $pdo = $app->getPdo();
        $stmt = $pdo->prepare("SELECT * FROM public.pub_cientificas");
        $stmt->execute();
        $result = $stmt->fetchAll();
        header('Content-Type: application/json; charset=utf-8');
        header('status: 200');
        echo json_encode($result);
    }

    public function update(?array $params, ?array $body, ?array $query): void
    {
        echo json_encode([
            'status' => 'success',
            'message' => 'Article updated successfully'
        ]);
    }
    public function delete(?array $params, ?array $body, ?array $query): void
    {
        echo json_encode([
            'status' => 'success',
            'message' => 'Article created successfully'
        ]);
    }
}
