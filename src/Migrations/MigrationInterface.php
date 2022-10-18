<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Migrations;

use Igor\ConsultantTest\Database\DatabaseInterface;

interface MigrationInterface
{
    public function migrate();
}