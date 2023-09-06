<?php

namespace Inifap\Biblioteca;

class Route
{
    private string $path;
    private array $methods = [];

    public function __construct(string $path)
    {
        $this->path = $path;
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

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMethods(): array
    {
        return $this->methods;
    }
}
