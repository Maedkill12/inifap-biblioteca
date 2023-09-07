<?php

namespace Inifap\Biblioteca\Controllers;

abstract class Controller
{
    public function __construct()
    {
    }

    abstract public function create(?array $params, ?array $body): void;
    abstract public function find(?array $params, ?array $body): void;
    abstract public function update(?array $params, ?array $body): void;
    abstract public function delete(?array $params, ?array $body): void;

    abstract public function render(?array $params): void;
}
