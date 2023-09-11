<?php

namespace Inifap\Biblioteca\Models;

abstract class Model
{
    protected \PDO $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO("pgsql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    abstract public function create(array $body): array;
    abstract public function findOne(array $body): array;
    abstract public function findMany(array $body): array;
    abstract public function update(array $body): array;
    abstract public function delete(array $body): array;
}
