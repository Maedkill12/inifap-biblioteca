<?php

namespace Inifap\Biblioteca\Controllers;

use Inifap\Biblioteca\Models\ScientificArticle;

class ScientificArticleController extends ArticleController
{

    public function __construct()
    {
        parent::__construct(new ScientificArticle());
    }

    public function create(?array $params, ?array $body, ?array $query): void
    {
        header('Content-Type: application/json; charset=utf-8');
        if (!isset($body['publicacion'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing publicacion field'
            ]);
            return;
        }
        if (!isset($body['liga'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing liga field'
            ]);
            return;
        }
        if (!isset($body['muestra'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing muestra field'
            ]);
            return;
        }
        if (!isset($body['cuenta'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing cuenta field'
            ]);
            return;
        }
        if (!isset($body['ano'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing ano field'
            ]);
            return;
        }
        if (!isset($body['mensaje'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing mensaje field'
            ]);
            return;
        }
        if (!isset($body['publicacionot'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Missing publicacionot field'
            ]);
            return;
        }
        parent::create($params, $body, $query);
    }
}
