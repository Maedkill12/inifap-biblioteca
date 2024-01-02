<?php

namespace Inifap\Biblioteca\Controllers;

use Inifap\Biblioteca\Models\Model;

abstract class ArticleController extends Controller
{
    protected Model $model;

    public function __construct(Model $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function create(?array $params, ?array $body, ?array $query): void
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(400);
        $result = $this->model->create($body);

        if ($result) {
            http_response_code(201);
            echo json_encode([
                'status' => 'success',
                'message' => 'Article created successfully',
                'data' => $result
            ]);
            return;
        }
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Error creating article'
        ]);
    }
    public function findOne(?array $params, ?array $body, ?array $query): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $result = $this->model->findOne(['id' => $params['id']]);
        if ($result) {
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'Article found successfully',
                'data' => $result
            ]);
            return;
        }
        http_response_code(404);
        echo json_encode([
            'status' => 'error',
            'message' => 'Article not found'
        ]);
    }

    public function findMany(?array $params, ?array $body, ?array $query): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $result = $this->model->findMany($query);
        if ($result) {
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'Articles found successfully',
                'data' => $result
            ]);
            return;
        }
        http_response_code(404);
        echo json_encode([
            'status' => 'error',
            'message' => 'Articles not found'
        ]);
    }

    public function update(?array $params, ?array $body, ?array $query): void
    {
        header('Content-Type: application/json; charset=utf-8');
        ["id" => $id] = $params;
        $result = $this->model->update(array_merge($body, ['id' => $id]));
        if ($result) {
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'Article updated successfully',
                'data' => $result
            ]);
            return;
        }
        http_response_code(404);
        echo json_encode([
            'status' => 'error',
            'message' => 'Article not found'
        ]);
    }
    public function delete(?array $params, ?array $body, ?array $query): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $result = $this->model->delete(['id' => $params['id']]);
        if ($result) {
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'Article deleted successfully',
                'data' => $result
            ]);
            return;
        }
        http_response_code(404);
        echo json_encode([
            'status' => 'error',
            'message' => 'Article not found'
        ]);
    }
}
