<?php

namespace Inifap\Biblioteca;

class RouterManager
{

    /** @var Route[] */
    private array $routes = [];

    public function addRoute(string $path): Route
    {
        $path = ROOT_PATH . $path;
        if (!isset($this->routes[$path])) {
            $this->routes[$path] = new Route($path);
        }
        return $this->routes[$path];
    }

    public function resolve(string $path, string $method, ?array $body = []): void
    {
        if (substr($path, -1) === '/') {
            $path = rtrim($path, '/');
        }

        foreach ($this->routes as $route) {
            if (preg_match_all('/:(\w+)/', $route->getPath(), $matches, PREG_SET_ORDER)) {
                $regex = str_replace('/', '\/', $route->getPath());
                foreach ($matches as $match) {
                    $regex = str_replace($match[0], '(\w+)', $regex);
                }
                if (preg_match('/^' . $regex . '$/', $path, $params) && $route->hasMethod($method)) {
                    array_shift($params);
                    $route->setParams($params);
                    $this->callback($route, $method, $body);
                    return;
                }
            } else {
                if ($route->getPath() === $path && $route->hasMethod($method)) {
                    $this->callback($route, $method, $body);
                    return;
                }
            }
        }

        // Not found
        include VIEW_PATH . '/errors/404.php';
    }

    private function callback(Route $route, string $method, ?array $body = []): void
    {
        $callback = $route->getMethods()[$method];
        if (is_callable($callback)) {
            $callback($route->getParams(), $body);
            return;
        } else {
            echo "Method not allowed";
        }
    }
}
