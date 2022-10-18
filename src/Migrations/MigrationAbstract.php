<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Migrations;

use Igor\ConsultantTest\Database\DatabaseInterface;

abstract class MigrationAbstract implements MigrationInterface
{
    protected DatabaseInterface $database;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    public abstract function migrate();
}