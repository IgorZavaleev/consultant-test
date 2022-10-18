<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Model;

use Igor\ConsultantTest\Database\DatabaseInterface;

interface ChessRepositoryInterface
{
    public function __construct(DatabaseInterface $database);

    public function createAndSavePosition(string $positionName, ChessPosition $position): void;

    public function loadAllPositions(): array;
}