<?php

namespace Inifap\Biblioteca;

class Route
{
    private string $path;
    private array $methods = [];
    private array $paramsPosition = [];
    private array $params = [];

    public function __construct(string $path)
    {
        if (substr($path, -1) === '/') {
            $path = rtrim($path, '/');
        }

        $this->path = $path;

        preg_match_all('/:(\w+)/', $path, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $path = str_replace($match[0], '(\w+)', $path);
            $this->paramsPosition[] = $match[1];
            $this->params[$match[1]] = null;
        }
    }

    public function post(callable $callback): self
    {
        $this->methods['POST'] = $callback;
        return $this;
    }

    public function get(callable $callback): self
    {
        $this->methods['GET'] = $callback;
        return $this;
    }

    public function put(callable $callback): self
    {
        $this->methods['PUT'] = $callback;
        return $this;
    }

    public function delete(callable $callback): self
    {
        $this->methods['DELETE'] = $callback;
        return $this;
    }

    public function hasMethod(string $method): bool
    {
        $method = strtoupper($method);
        return isset($this->methods[$method]);
    }

    public function setParams(array $params): void
    {
        foreach ($params as $key => $value) {
            $this->params[$this->paramsPosition[$key]] = $value;
        }
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMethods(): array
    {
        return $this->methods;
    }
}
