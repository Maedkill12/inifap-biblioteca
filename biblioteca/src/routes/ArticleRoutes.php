<?php

namespace Inifap\Biblioteca\Routes;

use Inifap\Biblioteca\Controllers\ScientificArticleController;
use Inifap\Biblioteca\Controllers\TechnicalArticleController;
use Inifap\Biblioteca\RouterManager;

class ArticleRoutes extends Routes
{
    private ScientificArticleController $scientificArticleController;
    private TechnicalArticleController $technicalArticleController;

    public function __construct(RouterManager $routerManager)
    {
        parent::__construct($routerManager);
        $this->scientificArticleController = new ScientificArticleController();
        $this->technicalArticleController = new TechnicalArticleController();
    }

    public function setupRoutes(): void
    {
        // Scientific Article Routes
        $this->routerManager->addRoute("/articulo/cientifico/:id")
            ->get(function (array $params) {
                $this->scientificArticleController->render($params, "article");
            });

        $this->routerManager->addRoute("/api/articulo/cientifico")
            ->get(function (array $params, array $body, array $query) {
                $this->scientificArticleController->findMany($params, $body, $query);
            })
            ->post(function (array $params, array $body, array $query) {
                $this->scientificArticleController->create($params, $body, $query);
            });


        $this->routerManager->addRoute("/api/articulo/cientifico/:id")
            ->get(function (array $params, array $body, array $query) {
                $this->scientificArticleController->findOne($params, $body, $query);
            })
            ->patch(function (array $params, array $body, array $query) {
                $this->scientificArticleController->update($params, $body, $query);
            })
            ->delete(function (array $params, array $body, array $query) {
                $this->scientificArticleController->delete($params, $body, $query);
            });

        // Technical Article Routes
        $this->routerManager->addRoute("/articulo/tecnico/:id")
            ->get(function (array $params) {
                $this->technicalArticleController->render($params, "article");
            });

        $this->routerManager->addRoute("/api/articulo/tecnico")
            ->get(function (array $params, array $body, array $query) {
                $this->technicalArticleController->findMany($params, $body, $query);
            })
            ->post(function (array $params, array $body, array $query) {
                $this->technicalArticleController->create($params, $body, $query);
            });


        $this->routerManager->addRoute("/api/articulo/tecnico/:id")
            ->get(function (array $params, array $body, array $query) {
                $this->technicalArticleController->findOne($params, $body, $query);
            })
            ->patch(function (array $params, array $body, array $query) {
                $this->technicalArticleController->update($params, $body, $query);
            })
            ->delete(function (array $params, array $body, array $query) {
                $this->technicalArticleController->delete($params, $body, $query);
            });
    }
}
