<?php

namespace Inifap\Biblioteca\Controllers;

use Inifap\Biblioteca\Models\ScientificArticle;

class ArticleController extends Controller
{
    private ScientificArticle $scientificArticle;

    public function __construct()
    {
        parent::__construct();
        $this->scientificArticle = new ScientificArticle();
    }

    public function create(?array $params, ?array $body, ?array $query): void
    {
        header('Content-Type: application/json; charset=utf-8');
        header('status: 201');
        // We need to check if the body has the required fields, we need to specify the missing fields in the response
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
        $result = $this->scientificArticle->create($body);
        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Article created successfully',
                'data' => $result
            ]);
            return;
        }
        echo json_encode([
            'status' => 'error',
            'message' => 'Error creating article'
        ]);
    }
    public function findOne(?array $params, ?array $body, ?array $query): void
    {
    }

    public function findMany(?array $params, ?array $body, ?array $query): void
    {
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
