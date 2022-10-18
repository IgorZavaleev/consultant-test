<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Database;

interface DatabaseInterface
{
    public function executeQuery(string $query, array $parameters = []): void;
    public function fetchLastResult(): ?array;
    public function lastInsertId(): ?string;
}
