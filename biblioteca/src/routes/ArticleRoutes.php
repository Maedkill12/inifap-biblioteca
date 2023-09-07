<?php

namespace Inifap\Biblioteca\Routes;

use Inifap\Biblioteca\Controllers\Controller;
use Inifap\Biblioteca\RouterManager;

class ArticleRoutes extends Routes
{
    public function __construct(RouterManager $routerManager, Controller $controller)
    {
        parent::__construct($routerManager, $controller);
    }

    public function setupRoutes(): void
    {
        $this->routerManager->addRoute("/articulo/:id")->get(function (array $params) {
            $this->controller->render($params, "article");
        });

        $this->routerManager->addRoute("/articulo")
            ->post(function (array $params, array $body) {
                $this->controller->create($params, $body);
            })
            ->put(function (array $params, array $body) {
                $this->controller->update($params, $body);
            })
            ->delete(function (array $params, array $body) {
                $this->controller->delete($params, $body);
            });
    }
}
