<?php

declare(strict_types=1);

namespace Core;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private PDO $conn;
    private PDOStatement $stmt;

    public function __construct($config, string $username = 'root', string $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $options = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $this->conn = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function query(string $sql, array $params = []): self
    {
        $this->stmt = $this->conn->prepare($sql);
        $this->stmt->execute($params);

        return $this;
    }

    public function find(): array|false
    {
        return $this->stmt->fetch();
    }

    public function findOrFail(string $message = 'Note not found' ): array|false
    {
        $data = $this->stmt->fetch();

        if (!$data) {
            abort(Response::HTTP_NOT_FOUND, message: $message);
        }

        return $data;
    }

    public function all(): array
    {
        return $this->stmt->fetchAll();
    }
}