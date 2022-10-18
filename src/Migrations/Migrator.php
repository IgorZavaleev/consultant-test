<?php
declare(strict_types=1);

namespace Igor\ConsultantTest\Migrations;

class Migrator
{
    static function applyMigrations(array $migrations): void
    {
        foreach ($migrations as $migration) {
            if ($migration instanceof MigrationInterface) {
                $migration->migrate();
            }
        }
    }
}