<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Database;

use PDO;
use PDOStatement;

class Mysql implements DatabaseInterface
{
    // TODO убрать отсюда параметры подключения
    const DSN = 'mysql:dbname=chess;host=database';
    const USER = 'root';
    const PASS = 'pass';

    private PDO $db;
    private ?PDOStatement $statement;

    public function __construct()
    {
        $this->db = new PDO(self::DSN, self::USER, self::PASS);
        $this->statement = null;
    }

    public function executeQuery(string $query, array $parameters = []): void
    {
        $this->statement = $this->db->prepare($query);
        $this->statement->execute($parameters);
    }

    public function fetchLastResult(): ?array
    {
        return $this->statement?->fetchAll();
    }

    public function lastInsertId(): ?string
    {
        return $this->db->lastInsertId();
    }
}